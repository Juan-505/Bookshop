<x-layouts.app title="Order Detail">
    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="space-y-6 rounded-3xl border border-emerald-100 bg-white p-8 shadow-[0_12px_40px_rgba(16,185,129,0.08)]">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div>
                    <p class="text-sm uppercase tracking-[0.35em] text-emerald-600">Admin panel</p>
                    <h1 class="mt-2 text-3xl font-semibold text-slate-900">Đơn hàng #{{ $order->order_id }}</h1>
                </div>
                <a href="{{ route('admin.orders.index') }}" class="rounded-2xl border border-emerald-200 px-4 py-3 font-semibold text-emerald-700 transition hover:bg-emerald-50">Quay lại</a>
            </div>

            @include('admin._nav')

            <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
                <div class="rounded-2xl border border-slate-100 bg-slate-50 p-5">
                    <p class="text-sm text-slate-500">Khách hàng</p>
                    <p class="mt-2 font-semibold text-slate-900">{{ $order->user?->name ?? 'Khách' }}</p>
                </div>
                <div class="rounded-2xl border border-slate-100 bg-slate-50 p-5">
                    <p class="text-sm text-slate-500">Trạng thái</p>
                    <p class="mt-2 font-semibold text-slate-900">{{ $order->status_label }}</p>
                </div>
                <div class="rounded-2xl border border-slate-100 bg-slate-50 p-5">
                    <p class="text-sm text-slate-500">Tổng tiền</p>
                    <p class="mt-2 font-semibold text-slate-900">{{ number_format((float) $order->total_amount) }} ₫</p>
                </div>
                <div class="rounded-2xl border border-slate-100 bg-slate-50 p-5">
                    <p class="text-sm text-slate-500">Ngày đặt</p>
                    <p class="mt-2 font-semibold text-slate-900">{{ optional($order->order_date)->format('d/m/Y H:i') ?? '-' }}</p>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.orders.status', $order) }}" class="flex flex-wrap items-end gap-3 rounded-2xl border border-slate-100 bg-slate-50 p-4">
                @csrf
                @method('PATCH')
                <div>
                    <label class="mb-2 block text-sm text-slate-600">Cập nhật trạng thái</label>
                    @php
                        $statusLabels = [
                            'pending' => 'Chờ xử lý',
                            'confirmed' => 'Đã xác nhận',
                            'shipping' => 'Đang giao',
                            'completed' => 'Hoàn tất',
                            'cancelled' => 'Đã hủy',
                        ];
                    @endphp
                    <select name="status" class="rounded-2xl border border-emerald-100 bg-white px-4 py-3 outline-none focus:border-emerald-300">
                        @foreach(\App\Models\Order::STATUSES as $status)
                            <option value="{{ $status }}" @selected($order->status === $status)>{{ $statusLabels[$status] ?? $status }}</option>
                        @endforeach
                    </select>
                </div>
                <button class="rounded-2xl bg-emerald-600 px-4 py-3 font-semibold text-white transition hover:bg-emerald-700">Lưu</button>
            </form>

            <div>
                <h2 class="text-xl font-semibold text-slate-900">Sản phẩm trong đơn</h2>
                <div class="mt-4 overflow-x-auto rounded-2xl border border-slate-100">
                    <table class="min-w-full text-left text-sm">
                        <thead class="bg-slate-50 text-slate-500">
                            <tr>
                                <th class="px-4 py-3">Sản phẩm</th>
                                <th class="px-4 py-3">Số lượng</th>
                                <th class="px-4 py-3">Đơn giá</th>
                                <th class="px-4 py-3">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($order->items as $item)
                                <tr>
                                    <td class="px-4 py-3 font-medium text-slate-900">{{ $item->product_name_snapshot }}</td>
                                    <td class="px-4 py-3 text-slate-600">{{ $item->quantity }}</td>
                                    <td class="px-4 py-3 text-slate-600">{{ number_format((float) $item->unit_price) }} ₫</td>
                                    <td class="px-4 py-3 text-slate-600">{{ number_format((float) $item->subtotal) }} ₫</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="rounded-2xl border border-slate-100 bg-slate-50 p-5 text-sm text-slate-600">
                <p><span class="font-semibold text-slate-900">Người nhận:</span> {{ $order->recipient_name_snapshot }}</p>
                <p class="mt-2"><span class="font-semibold text-slate-900">SĐT:</span> {{ $order->phone_number_snapshot }}</p>
                <p class="mt-2"><span class="font-semibold text-slate-900">Địa chỉ:</span> {{ $order->full_address_snapshot }}</p>
                <p class="mt-2"><span class="font-semibold text-slate-900">Ghi chú:</span> {{ $order->notes ?: '-' }}</p>
            </div>
        </div>
    </div>
</x-layouts.app>