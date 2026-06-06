<x-layouts.app title="Orders Admin">
    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="space-y-6 rounded-3xl border border-emerald-100 bg-white p-8 shadow-[0_12px_40px_rgba(16,185,129,0.08)]">
            <div>
                <p class="text-sm uppercase tracking-[0.35em] text-emerald-600">Admin panel</p>
                <h1 class="mt-2 text-3xl font-semibold text-slate-900">Quản lý đơn hàng</h1>
            </div>

            @include('admin._nav')

            <div class="overflow-x-auto rounded-2xl border border-slate-100">
                <table class="min-w-full text-left text-sm">
                    <thead class="bg-slate-50 text-slate-500">
                        <tr>
                            <th class="px-4 py-3">Mã</th>
                            <th class="px-4 py-3">Người đặt</th>
                            <th class="px-4 py-3">Trạng thái</th>
                            <th class="px-4 py-3">Tổng tiền</th>
                            <th class="px-4 py-3">Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($orders as $order)
                            <tr>
                                <td class="px-4 py-3 font-medium text-slate-900">#{{ $order->order_id }}</td>
                                <td class="px-4 py-3 text-slate-600">{{ $order->user?->name ?? 'Khách' }}</td>
                                <td class="px-4 py-3 text-slate-600">{{ $order->status_label }}</td>
                                <td class="px-4 py-3 text-slate-600">{{ number_format((float) $order->total_amount) }} ₫</td>
                                <td class="px-4 py-3">
                                    <a href="{{ route('admin.orders.show', $order) }}" class="rounded-xl border border-emerald-200 px-3 py-2 text-sm font-medium text-emerald-700 transition hover:bg-emerald-50">Xem chi tiết</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div>{{ $orders->links('components.pagination') }}</div>
        </div>
    </div>
</x-layouts.app>