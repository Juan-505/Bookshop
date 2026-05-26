<x-layouts.app title="Admin Dashboard">
    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="space-y-6 rounded-3xl border border-emerald-100 bg-white p-8 shadow-[0_12px_40px_rgba(16,185,129,0.08)]">
            <div>
                <p class="text-sm uppercase tracking-[0.35em] text-emerald-600">Admin panel</p>
                <h1 class="mt-2 text-3xl font-semibold text-slate-900">Quản lý hệ thống</h1>
            </div>

            @include('admin._nav')

            <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
                <div class="rounded-2xl border border-slate-100 bg-slate-50 p-5">
                    <p class="text-sm text-slate-500">Users</p>
                    <p class="mt-2 text-3xl font-bold text-slate-900">{{ $userCount }}</p>
                </div>
                <div class="rounded-2xl border border-slate-100 bg-slate-50 p-5">
                    <p class="text-sm text-slate-500">Categories</p>
                    <p class="mt-2 text-3xl font-bold text-slate-900">{{ $categoryCount }}</p>
                </div>
                <div class="rounded-2xl border border-slate-100 bg-slate-50 p-5">
                    <p class="text-sm text-slate-500">Products</p>
                    <p class="mt-2 text-3xl font-bold text-slate-900">{{ $productCount }}</p>
                </div>
                <div class="rounded-2xl border border-slate-100 bg-slate-50 p-5">
                    <p class="text-sm text-slate-500">Orders</p>
                    <p class="mt-2 text-3xl font-bold text-slate-900">{{ $orderCount }}</p>
                </div>
            </div>

            <div>
                <h2 class="text-xl font-semibold text-slate-900">Đơn hàng gần đây</h2>
                <div class="mt-4 overflow-x-auto rounded-2xl border border-slate-100">
                    <table class="min-w-full text-left text-sm">
                        <thead class="bg-slate-50 text-slate-500">
                            <tr>
                                <th class="px-4 py-3">Mã</th>
                                <th class="px-4 py-3">Người đặt</th>
                                <th class="px-4 py-3">Trạng thái</th>
                                <th class="px-4 py-3">Tổng tiền</th>
                                <th class="px-4 py-3">Ngày</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($recentOrders as $order)
                                <tr>
                                    <td class="px-4 py-3 font-medium text-slate-900">#{{ $order->order_id }}</td>
                                    <td class="px-4 py-3 text-slate-600">{{ $order->user?->name ?? 'Khách' }}</td>
                                    <td class="px-4 py-3 text-slate-600">{{ $order->status_label }}</td>
                                    <td class="px-4 py-3 text-slate-600">{{ number_format((float) $order->total_amount) }} ₫</td>
                                    <td class="px-4 py-3 text-slate-600">{{ optional($order->order_date)->format('d/m/Y H:i') ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-6 text-center text-slate-500">Chưa có đơn hàng nào.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>