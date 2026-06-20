<x-layouts.app title="Products Admin">
    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="space-y-6 rounded-3xl border border-emerald-100 bg-white p-8 shadow-[0_12px_40px_rgba(16,185,129,0.08)]">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div>
                    <p class="text-sm uppercase tracking-[0.35em] text-emerald-600">Admin panel</p>
                    <h1 class="mt-2 text-3xl font-semibold text-slate-900">Quản lý sản phẩm</h1>
                </div>
                <a href="{{ route('admin.products.create') }}" class="rounded-2xl bg-emerald-600 px-4 py-3 font-semibold text-white transition hover:bg-emerald-700">+ Tạo sản phẩm</a>
            </div>

            @include('admin._nav')

            <div class="overflow-x-auto rounded-2xl border border-slate-100">
                <table class="min-w-full text-left text-sm">
                    <thead class="bg-slate-50 text-slate-500">
                        <tr>
                            <th class="px-4 py-3">Sản phẩm</th>
                            <th class="px-4 py-3">Danh mục</th>
                            <th class="px-4 py-3">Giá</th>
                            <th class="px-4 py-3">Tồn kho</th>
                            <th class="px-4 py-3">Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($products as $product)
                            <tr>
                                <td class="px-4 py-3 font-medium text-slate-900">{{ $product->tensach }}</td>
                                <td class="px-4 py-3 text-slate-600">{{ $product->category?->ten_loai ?? '-' }}</td>
                                <td class="px-4 py-3 text-slate-600">{{ number_format($product->final_price) }} ₫</td>
                                <td class="px-4 py-3 text-slate-600">{{ $product->hangton }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex flex-wrap gap-2">
                                        <a href="{{ route('admin.products.edit', $product) }}" class="rounded-xl border border-emerald-200 px-3 py-2 text-sm font-medium text-emerald-700 transition hover:bg-emerald-50">Sửa</a>
                                        <form method="POST" action="{{ route('admin.products.destroy', $product) }}" data-delete-form>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rounded-xl border border-rose-200 px-3 py-2 text-sm font-medium text-rose-600 transition hover:bg-rose-50">Xóa</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <x-admin.delete-modal
        title="Xác nhận xóa sản phẩm"
        message="Bạn có chắc chắn muốn xóa sản phẩm này không? Hành động này không thể hoàn tác."
    />
</x-layouts.app>