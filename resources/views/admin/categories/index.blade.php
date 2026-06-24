<x-layouts.app title="Categories">
    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="space-y-6 rounded-3xl border border-emerald-100 bg-white p-8 shadow-[0_12px_40px_rgba(16,185,129,0.08)]">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div>
                    <p class="text-sm uppercase tracking-[0.35em] text-emerald-600">Admin panel</p>
                    <h1 class="mt-2 text-3xl font-semibold text-slate-900">Quản lý danh mục</h1>
                </div>
                <a href="{{ route('admin.categories.create') }}" class="rounded-2xl bg-emerald-600 px-4 py-3 font-semibold text-white transition hover:bg-emerald-700">+ Tạo danh mục</a>
            </div>

            @include('admin._nav')

            <div class="overflow-x-auto rounded-2xl border border-slate-100">
                <table class="min-w-full text-left text-sm">
                    <thead class="bg-slate-50 text-slate-500">
                        <tr>
                            <th class="px-4 py-3">Tên danh mục</th>
                            <th class="px-4 py-3">Cha</th>
                            <th class="px-4 py-3">Đường dẫn</th>
                            <th class="px-4 py-3">Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($categories as $category)
                            <tr>
                                <td class="px-4 py-3 font-medium text-slate-900">{{ $category->ten_loai }}</td>
                                <td class="px-4 py-3 text-slate-600">{{ $category->id_cha ? ($paths[$category->id_cha] ?? $category->parent?->ten_loai ?? '-') : '-' }}</td>
                                <td class="px-4 py-3 text-slate-600">{{ $paths[$category->id_loai] }}</td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.categories.edit', $category) }}" class="rounded-xl border border-emerald-200 px-3 py-2 text-sm font-medium text-emerald-700 transition hover:bg-emerald-50">Sửa</a>
                                        <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" class="inline-block" data-delete-form>
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
        title="Xác nhận xóa danh mục"
        message="Bạn có chắc chắn muốn xóa danh mục này không? Hành động này không thể hoàn tác."
    />
</x-layouts.app>