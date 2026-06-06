import './bootstrap';

const storageKey = 'bookshop_guest_cart';

function readGuestCart() {
	try {
		return JSON.parse(localStorage.getItem(storageKey) || '[]');
	} catch {
		return [];
	}
}

function writeGuestCart(items) {
	localStorage.setItem(storageKey, JSON.stringify(items));
	localStorage.removeItem('bookshop_guest_cart_synced');
	updateGuestBadge();
}

function normalizeCartItem(item) {
	return {
		product_id: Number(item.product_id),
		quantity: Number(item.quantity || 1),
		name: item.name || '',
		price: Number(item.price || 0),
		image: item.image || '',
	};
}

function updateGuestBadge() {
	const badge = document.querySelector('[data-cart-badge]');
	if (!badge) {
		return;
	}

	if (document.body.dataset.authenticated === '1') {
		return;
	}

	const count = readGuestCart().reduce((sum, item) => sum + Number(item.quantity || 0), 0);
	badge.textContent = String(count);
}

function setBadgeCount(count) {
	const badge = document.querySelector('[data-cart-badge]');
	if (!badge) {
		return;
	}

	badge.textContent = String(Number(count || 0));
}

async function refreshAuthBadge() {
	if (document.body.dataset.authenticated !== '1') {
		return;
	}

	try {
		const response = await fetch('/cart-count', {
			headers: {
				'Accept': 'application/json',
			},
		});

		const payload = await response.json();
		setBadgeCount(payload.count || 0);
	} catch {
		// Keep existing badge value if the request fails.
	}
}

async function addToAuthCart(productId, quantity = 1) {
	const csrf = document.querySelector('meta[name="csrf-token"]')?.content;
	if (!csrf) {
		return;
	}

	await fetch('/cart/items', {
		method: 'POST',
		headers: {
			'Content-Type': 'application/json',
			'X-CSRF-TOKEN': csrf,
			'Accept': 'application/json',
		},
		body: JSON.stringify({ product_id: Number(productId), quantity: Number(quantity) }),
	});

	await refreshAuthBadge();
}

function upsertGuestItem(productId, quantity = 1, meta = {}) {
	const items = readGuestCart();
	const existing = items.find((item) => Number(item.product_id) === Number(productId));

	if (existing) {
		existing.quantity += quantity;
	} else {
		items.push(normalizeCartItem({ product_id: productId, quantity, ...meta }));
	}

	writeGuestCart(items);
}

async function syncGuestCartToDatabase() {
	if (document.body.dataset.authenticated !== '1') {
		return;
	}

	const items = readGuestCart();
	if (items.length === 0 || localStorage.getItem('bookshop_guest_cart_synced') === '1') {
		return;
	}

	const csrf = document.querySelector('meta[name="csrf-token"]')?.content;
	if (!csrf) {
		return;
	}

	for (const item of items) {
		await fetch('/cart/items', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json',
				'X-CSRF-TOKEN': csrf,
				'Accept': 'application/json',
			},
			body: JSON.stringify({ product_id: item.product_id, quantity: item.quantity }),
		});
	}

	localStorage.removeItem(storageKey);
	localStorage.setItem('bookshop_guest_cart_synced', '1');
	window.location.reload();
}

function renderGuestCartPage() {
	const container = document.querySelector('[data-guest-cart-list]');
	if (!container) {
		return;
	}

	const items = readGuestCart();
	const emptyState = document.getElementById('guest-empty-state');

	if (items.length === 0) {
		container.innerHTML = '';
		if (emptyState) {
			emptyState.classList.remove('hidden');
			emptyState.classList.add('flex');
		}
		updateGuestSummaryTotals(0);
		return;
	}

	if (emptyState) {
		emptyState.classList.add('hidden');
		emptyState.classList.remove('flex');
	}

	const total = items.reduce((sum, item) => sum + (Number(item.price || 0) * Number(item.quantity || 0)), 0);

	container.innerHTML = items.map((item) => {
		const lineTotal = Number(item.price || 0) * Number(item.quantity || 0);
		return `
		<div class="flex items-center gap-4 rounded-2xl border border-slate-100 bg-white p-4 shadow-sm transition hover:border-emerald-100 hover:shadow-md">
			<div class="flex-shrink-0">
				<img src="${item.image || '/img/books/placeholder.png'}" alt="${item.name || ('Mã sản phẩm #' + item.product_id)}"
				     class="h-24 w-16 rounded-xl object-contain bg-slate-50 p-1">
			</div>
			<div class="min-w-0 flex-1">
				<p class="line-clamp-2 text-sm font-semibold text-slate-900">${item.name || ('Mã sản phẩm #' + item.product_id)}</p>
				<p class="mt-2 text-sm font-bold text-slate-800">${item.price ? Number(item.price).toLocaleString('vi-VN') + ' ₫' : ''}</p>
			</div>
			<div class="flex flex-shrink-0 items-center gap-1.5">
				<button type="button"
				        class="flex h-8 w-8 items-center justify-center rounded-xl border border-slate-200 text-slate-500 transition hover:border-emerald-400 hover:text-emerald-600"
				        data-guest-cart-dec="${item.product_id}">
					<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14"/></svg>
				</button>
				<input type="text" readonly value="${item.quantity}"
				       class="h-8 w-10 rounded-xl border border-slate-200 text-center text-sm font-bold text-slate-900"
				       data-guest-cart-qty="${item.product_id}">
				<button type="button"
				        class="flex h-8 w-8 items-center justify-center rounded-xl border border-slate-200 text-slate-500 transition hover:border-emerald-400 hover:text-emerald-600"
				        data-guest-cart-plus="${item.product_id}">
					<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
				</button>
			</div>
			<div class="w-28 flex-shrink-0 text-right">
				<p class="text-sm font-extrabold text-slate-900">${lineTotal.toLocaleString('vi-VN')} ₫</p>
				<button type="button"
				        class="mt-1.5 inline-flex items-center gap-1 text-xs font-semibold text-rose-400 transition hover:text-rose-600"
				        data-guest-cart-remove="${item.product_id}">
					<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 6h18M8 6V4h8v2M19 6l-1 14H6L5 6"/></svg>
					Xóa
				</button>
			</div>
		</div>
	`;
	}).join('');

	updateGuestSummaryTotals(total);
}

function updateGuestSummaryTotals(total) {
	const formatted = total > 0 ? `${total.toLocaleString('vi-VN')} ₫` : '—';
	const cartTotal = document.querySelector('[data-cart-total]');
	const cartTotalDisplay = document.querySelector('[data-cart-total-display]');
	if (cartTotal) cartTotal.textContent = formatted;
	if (cartTotalDisplay) cartTotal.textContent = formatted;
	if (cartTotalDisplay) cartTotalDisplay.textContent = formatted;
}

async function submitCartMutation(url, method, quantity) {
	const csrf = document.querySelector('meta[name="csrf-token"]')?.content;
	if (!csrf) {
		return;
	}

	await fetch(url, {
		method,
		headers: {
			'Content-Type': 'application/json',
			'X-CSRF-TOKEN': csrf,
			'Accept': 'application/json',
		},
		body: JSON.stringify({ quantity }),
	});

	window.location.reload();
}

document.addEventListener('click', (event) => {
	const addButton = event.target.closest('[data-cart-add]');
	if (addButton) {
		event.preventDefault();
		const productId = addButton.getAttribute('data-cart-add');
		if (document.body.dataset.authenticated === '1') {
			addToAuthCart(productId, 1);
		} else {
			upsertGuestItem(productId, 1, {
				name: addButton.getAttribute('data-cart-name') || '',
				price: addButton.getAttribute('data-cart-price') || '0',
				image: addButton.getAttribute('data-cart-image') || '',
			});
		}
	}

	const buyNowButton = event.target.closest('[data-cart-buy-now]');
	if (buyNowButton) {
		event.preventDefault();
		const productId = buyNowButton.getAttribute('data-cart-buy-now');
		if (document.body.dataset.authenticated === '1') {
			addToAuthCart(productId, 1).then(() => {
				window.location.href = '/cart';
			});
		} else {
			upsertGuestItem(productId, 1, {
				name: buyNowButton.getAttribute('data-cart-name') || '',
				price: buyNowButton.getAttribute('data-cart-price') || '0',
				image: buyNowButton.getAttribute('data-cart-image') || '',
			});
			window.location.href = '/cart';
		}
	}

	const plusButton = event.target.closest('[data-guest-cart-plus]');
	if (plusButton) {
		const productId = Number(plusButton.getAttribute('data-guest-cart-plus'));
		const items = readGuestCart();
		const item = items.find((entry) => Number(entry.product_id) === productId);
		if (item) {
			item.quantity += 1;
			writeGuestCart(items);
			renderGuestCartPage();
		}
	}

	const decButton = event.target.closest('[data-guest-cart-dec]');
	if (decButton) {
		const productId = Number(decButton.getAttribute('data-guest-cart-dec'));
		let items = readGuestCart();
		const itemIndex = items.findIndex((entry) => Number(entry.product_id) === productId);
		if (itemIndex !== -1) {
			const item = items[itemIndex];
			if (item.quantity <= 1) {
				items.splice(itemIndex, 1);
			} else {
				item.quantity -= 1;
			}
			writeGuestCart(items);
			renderGuestCartPage();
		}
	}

	const removeButton = event.target.closest('[data-guest-cart-remove]');
	if (removeButton) {
		const productId = Number(removeButton.getAttribute('data-guest-cart-remove'));
		const items = readGuestCart().filter((entry) => Number(entry.product_id) !== productId);
		writeGuestCart(items);
		renderGuestCartPage();
	}

	const authInc = event.target.closest('[data-cart-inc]');
	if (authInc) {
		const itemId = authInc.getAttribute('data-cart-inc');
		const qtyInput = document.querySelector(`[data-cart-qty="${itemId}"]`);
		const current = Number(qtyInput?.value || 0) + 1;
		submitCartMutation(`/cart/items/${itemId}`, 'PATCH', current);
	}

	const authDec = event.target.closest('[data-cart-dec]');
	if (authDec) {
		const itemId = authDec.getAttribute('data-cart-dec');
		const qtyInput = document.querySelector(`[data-cart-qty="${itemId}"]`);
		const currentQty = Number(qtyInput?.value || 1);
		if (currentQty <= 1) {
			submitCartMutation(`/cart/items/${itemId}`, 'DELETE');
		} else {
			submitCartMutation(`/cart/items/${itemId}`, 'PATCH', currentQty - 1);
		}
	}

	const authRemove = event.target.closest('[data-cart-remove]');
	if (authRemove) {
		const itemId = authRemove.getAttribute('data-cart-remove');
		submitCartMutation(`/cart/items/${itemId}`, 'DELETE');
	}
});

document.addEventListener('DOMContentLoaded', () => {
	if (document.body.dataset.authenticated !== '1') {
		updateGuestBadge();
		renderGuestCartPage();
		const checkoutInput = document.querySelector('[data-checkout-items]');
		const checkoutSummary = document.querySelector('[data-checkout-summary]');
		if (checkoutInput && checkoutSummary) {
			const items = readGuestCart();
			checkoutInput.value = JSON.stringify(items);
			if (items.length === 0) {
				checkoutSummary.innerHTML = '<p class="text-sm text-slate-500">Giỏ hàng khách đang trống.</p>';
			} else {
				checkoutSummary.innerHTML = items.map((item) => `
					<div class="rounded-2xl bg-slate-50 p-4 text-sm text-slate-700 flex items-center gap-4">
						<img src="${item.image || '/img/books/placeholder.png'}" alt="${item.name || ('Mã sản phẩm #' + item.product_id)}" class="h-16 w-12 object-contain rounded" />
						<div>
							<div class="font-medium text-slate-900">${item.name || ('Mã sản phẩm #' + item.product_id)}</div>
							<div>Số lượng: ${item.quantity}</div>
							${item.price ? `<div>Tạm tính: ${(Number(item.price) * Number(item.quantity)).toLocaleString('vi-VN')} ₫</div>` : ''}
						</div>
					</div>
				`).join('');
			}
		}
		return;
	}

	refreshAuthBadge();
	syncGuestCartToDatabase();
});
