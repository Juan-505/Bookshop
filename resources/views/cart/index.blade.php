<x-layouts.app title="Giỏ hàng">
    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8" data-cart-page>

        <!-- Page Header -->
        <div class="mb-8 flex items-center gap-3">
            <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600">
                <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/>
                </svg>
            </div>
            <div>
                <p class="text-xs font-bold uppercase tracking-widest text-emerald-600">Shopping cart</p>
                <h1 class="text-2xl font-extrabold text-slate-900">Giỏ hàng của bạn</h1>
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-[1fr_360px] lg:items-start">

            <!-- ── LEFT: Cart Items ── -->
            <div class="space-y-3">

                @auth
                    {{-- ── Authenticated User Cart ── --}}
                    @forelse($items as $item)
                        <div class="flex items-center gap-4 rounded-2xl border border-slate-100 bg-white p-4 shadow-sm transition hover:border-emerald-100 hover:shadow-md">
                            <!-- Book image -->
                            <a href="{{ route('products.show', $item->book->idbook) }}" class="flex-shrink-0">
                                <img src="{{ $item->book?->image_url }}" alt="{{ $item->book?->tensach ?? 'Sản phẩm' }}"
                                     class="h-24 w-16 rounded-xl object-contain bg-slate-50 p-1">
                            </a>
                            <!-- Info -->
                            <div class="min-w-0 flex-1">
                                <a href="{{ route('products.show', $item->book->idbook) }}"
                                   class="line-clamp-2 text-sm font-semibold text-slate-900 hover:text-emerald-600 transition">
                                    {{ $item->book?->tensach ?? 'Sản phẩm' }}
                                </a>
                                <p class="mt-1 text-xs text-slate-400">
                                    {{ $item->book?->category?->ten_loai ?? 'Sách' }}
                                </p>
                                <p class="mt-2 text-sm font-bold text-slate-800"
                                   data-cart-unit-price="{{ $item->book?->final_price ?? 0 }}">
                                    {{ number_format((float)($item->book?->final_price ?? 0)) }} ₫
                                </p>
                            </div>
                            <!-- Qty control -->
                            <div class="flex flex-shrink-0 items-center gap-1.5" data-auth-cart-row="{{ $item->id }}">
                                <button type="button"
                                        class="flex h-8 w-8 items-center justify-center rounded-xl border border-slate-200 text-slate-500 transition hover:border-emerald-400 hover:text-emerald-600"
                                        data-cart-dec="{{ $item->id }}">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14"/></svg>
                                </button>
                                <input type="text" readonly value="{{ $item->quantity }}"
                                       class="h-8 w-10 rounded-xl border border-slate-200 text-center text-sm font-bold text-slate-900"
                                       data-cart-qty="{{ $item->id }}">
                                <button type="button"
                                        class="flex h-8 w-8 items-center justify-center rounded-xl border border-slate-200 text-slate-500 transition hover:border-emerald-400 hover:text-emerald-600"
                                        data-cart-inc="{{ $item->id }}">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
                                </button>
                            </div>
                            <!-- Line total -->
                            <div class="w-28 flex-shrink-0 text-right">
                                <p class="text-sm font-extrabold text-slate-900"
                                   data-cart-line-total="{{ $item->id }}">
                                    {{ number_format((float)((int)$item->quantity * (int)($item->book?->final_price ?? 0))) }} ₫
                                </p>
                                <button type="button"
                                        class="mt-1.5 inline-flex items-center gap-1 text-xs font-semibold text-rose-400 transition hover:text-rose-600"
                                        data-cart-remove="{{ $item->id }}">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 6h18M8 6V4h8v2M19 6l-1 14H6L5 6"/></svg>
                                    Xóa
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="flex flex-col items-center justify-center rounded-2xl border-2 border-dashed border-slate-200 bg-slate-50/50 py-20 text-center">
                            <svg class="mb-4 h-14 w-14 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
                                <line x1="3" y1="6" x2="21" y2="6" stroke-linecap="round" stroke-width="1.5"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 10a4 4 0 0 1-8 0"/>
                            </svg>
                            <h3 class="text-base font-bold text-slate-700">Giỏ hàng đang trống</h3>
                            <p class="mt-1 text-sm text-slate-400">Thêm sách yêu thích vào giỏ để tiếp tục mua sắm!</p>
                            <a href="{{ route('products.index') }}"
                               class="mt-6 inline-flex items-center gap-2 rounded-2xl bg-emerald-600 px-6 py-3 text-sm font-bold text-white shadow-md shadow-emerald-600/20 transition hover:bg-emerald-700">
                                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
                                Khám phá sách ngay
                            </a>
                        </div>
                    @endforelse

                @else
                    {{-- ── Guest Cart — rendered by JS into data-guest-cart-list ── --}}
                    <div data-guest-cart-list></div>

                    {{-- Empty state shown when JS cart renders empty (hidden by default, shown by JS) --}}
                    <div id="guest-empty-state" class="hidden flex-col items-center justify-center rounded-2xl border-2 border-dashed border-slate-200 bg-slate-50/50 py-20 text-center">
                        <svg class="mb-4 h-14 w-14 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
                            <line x1="3" y1="6" x2="21" y2="6" stroke-linecap="round" stroke-width="1.5"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 10a4 4 0 0 1-8 0"/>
                        </svg>
                        <h3 class="text-base font-bold text-slate-700">Giỏ hàng đang trống</h3>
                        <p class="mt-1 text-sm text-slate-400">Thêm sách yêu thích vào giỏ để tiếp tục mua sắm!</p>
                        <a href="{{ route('products.index') }}"
                           class="mt-6 inline-flex items-center gap-2 rounded-2xl bg-emerald-600 px-6 py-3 text-sm font-bold text-white shadow-md shadow-emerald-600/20 transition hover:bg-emerald-700">
                            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
                            Khám phá sách ngay
                        </a>
                    </div>
                @endauth

                <!-- Continue Shopping Link -->
                <div class="pt-2">
                    <a href="{{ route('products.index') }}"
                       class="inline-flex items-center gap-1.5 text-sm font-semibold text-emerald-600 hover:text-emerald-700 transition">
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                        </svg>
                        Tiếp tục mua sắm
                    </a>
                </div>
            </div>

            <!-- ── RIGHT: Order Summary Sticky Card ── -->
            <div class="lg:sticky lg:top-24">
                <div class="rounded-2xl border border-emerald-100 bg-white p-6 shadow-[0_8px_30px_rgba(16,185,129,0.06)]">
                    <h2 class="mb-5 text-base font-extrabold text-slate-900">Tóm tắt đơn hàng</h2>

                    <div class="space-y-3 text-sm">
                        <div class="flex items-center justify-between text-slate-600">
                            <span>Tạm tính</span>
                            <span class="font-semibold text-slate-900" data-cart-total>
                                @auth{{ number_format((float)$total) }} ₫@else&mdash;@endauth
                            </span>
                        </div>
                        <div class="flex items-center justify-between text-slate-600">
                            <span>Phí vận chuyển</span>
                            <span class="font-semibold text-emerald-600">Miễn phí</span>
                        </div>
                        <div class="my-3 border-t border-slate-100"></div>
                        <div class="flex items-center justify-between">
                            <span class="text-base font-bold text-slate-900">Tổng cộng</span>
                            <span class="text-xl font-extrabold text-emerald-700" data-cart-total-display>
                                @auth{{ number_format((float)$total) }} ₫@else&mdash;@endauth
                            </span>
                        </div>
                    </div>

                    <!-- Checkout Button -->
                    <a href="{{ route('checkout.index') }}"
                       id="checkout-btn"
                       class="mt-6 flex w-full items-center justify-center gap-2 rounded-2xl bg-emerald-600 px-5 py-4 text-sm font-bold text-white shadow-lg shadow-emerald-600/20 transition hover:bg-emerald-700 hover:shadow-emerald-600/30 active:scale-[0.98]">
                        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Tiến hành thanh toán
                    </a>

                    <!-- Guest: Login hint (soft, non-blocking) -->
                    @guest
                        <p class="mt-4 text-center text-xs text-slate-400">
                            <a href="{{ route('login.form') }}" class="font-semibold text-emerald-600 hover:underline">Đăng nhập</a>
                            để lưu giỏ hàng vào tài khoản của bạn
                        </p>
                    @endguest

                    <!-- Trust badges -->
                    <div class="mt-5 flex flex-wrap items-center justify-center gap-3 border-t border-slate-100 pt-4 text-xs text-slate-400">
                        <span class="flex items-center gap-1">
                            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                            Thanh toán an toàn
                        </span>
                        <span class="flex items-center gap-1">
                            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg>
                            Giao hàng toàn quốc
                        </span>
                        <span class="flex items-center gap-1">
                            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/></svg>
                            Đổi trả dễ dàng
                        </span>
                    </div>
                </div>
            </div>

        </div>
    </section>
</x-layouts.app>