<x-layouts.app title="Thanh toán thành công">
    <section class="mx-auto max-w-4xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="rounded-3xl border border-emerald-100 bg-white p-8 shadow-[0_12px_40px_rgba(16,185,129,0.08)]">
            <p class="text-sm uppercase tracking-[0.35em] text-emerald-600">Success</p>
            <h1 class="mt-3 text-3xl font-semibold text-slate-900">Đơn hàng #{{ $order->order_id }} đã được tạo</h1>
            <p class="mt-4 text-slate-600">Đơn hàng sẽ xuất hiện trong trang quản lý đơn hàng của admin.</p>
            <a href="{{ route('products.index') }}" class="mt-6 inline-flex rounded-2xl bg-emerald-600 px-4 py-3 font-semibold text-white transition hover:bg-emerald-700">Tiếp tục mua sắm</a>
        </div>
    </section>

    <script>
        localStorage.removeItem('bookshop_guest_cart');
    </script>
</x-layouts.app>