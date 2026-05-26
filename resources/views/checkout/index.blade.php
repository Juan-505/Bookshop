<x-layouts.app title="Checkout">
    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="grid gap-6 lg:grid-cols-[1fr_420px]">
            <form method="POST" action="{{ route('checkout.store') }}" class="rounded-3xl border border-emerald-100 bg-white p-8 shadow-[0_12px_40px_rgba(16,185,129,0.08)]">
                @csrf
                <h1 class="text-3xl font-semibold text-slate-900">Checkout</h1>
                <div class="mt-6 grid gap-4">
                    <div>
                        <label class="mb-2 block text-sm text-slate-600">Người nhận</label>
                        <input name="recipient_name" value="{{ old('recipient_name', auth()->user()->name ?? '') }}" class="w-full rounded-2xl border border-emerald-100 bg-emerald-50 px-4 py-3 outline-none focus:border-emerald-300 focus:bg-white" required>
                    </div>
                    <div>
                        <label class="mb-2 block text-sm text-slate-600">Số điện thoại</label>
                        <input name="phone_number" value="{{ old('phone_number') }}" inputmode="numeric" pattern="[0-9]+" class="w-full rounded-2xl border border-emerald-100 bg-emerald-50 px-4 py-3 outline-none focus:border-emerald-300 focus:bg-white" required>
                        <p class="mt-1 text-xs text-slate-500">Chỉ nhập số, không khoảng trắng hoặc ký tự đặc biệt.</p>
                    </div>
                    <div>
                        <label class="mb-2 block text-sm text-slate-600">Địa chỉ</label>
                        <input name="full_address" value="{{ old('full_address') }}" class="w-full rounded-2xl border border-emerald-100 bg-emerald-50 px-4 py-3 outline-none focus:border-emerald-300 focus:bg-white" required>
                    </div>
                    <div>
                        <label class="mb-2 block text-sm text-slate-600">Ghi chú</label>
                        <textarea name="notes" rows="4" class="w-full rounded-2xl border border-emerald-100 bg-emerald-50 px-4 py-3 outline-none focus:border-emerald-300 focus:bg-white">{{ old('notes') }}</textarea>
                    </div>
                    <input type="hidden" name="items_json" data-checkout-items>
                    <button class="rounded-2xl bg-emerald-600 px-4 py-3 font-semibold text-white transition hover:bg-emerald-700">Thanh toán</button>
                </div>
            </form>

            <aside class="rounded-3xl border border-emerald-100 bg-white p-8 shadow-[0_12px_40px_rgba(16,185,129,0.08)]">
                <h2 class="text-xl font-semibold text-slate-900">Đơn hàng</h2>
                <div class="mt-4 space-y-3" data-checkout-summary>
                    @auth
                        @forelse($items as $item)
                            <div class="rounded-2xl bg-slate-50 p-4 text-sm text-slate-700">
                                <div class="font-medium text-slate-900">{{ $item->book?->tensach }}</div>
                                <div>Số lượng: {{ $item->quantity }}</div>
                            </div>
                        @empty
                            <p class="text-sm text-slate-500">Giỏ hàng trống.</p>
                        @endforelse
                        <div class="flex items-center justify-between rounded-2xl bg-slate-50 p-4">
                            <span>Tạm tính</span>
                            <span class="font-semibold text-slate-900">{{ number_format((float) $total) }} ₫</span>
                        </div>
                    @else
                        <p class="text-sm text-slate-500">Danh sách từ localStorage sẽ hiển thị ở đây.</p>
                    @endauth
                </div>
            </aside>
        </div>
    </section>
</x-layouts.app>