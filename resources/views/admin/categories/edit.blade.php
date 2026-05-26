<x-layouts.app title="Edit Category">
    <div class="mx-auto max-w-2xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="rounded-3xl border border-emerald-100 bg-white p-8 shadow-[0_12px_40px_rgba(16,185,129,0.08)]">
            <h1 class="text-3xl font-semibold text-slate-900">Cập nhật danh mục</h1>
            @include('admin._nav')

            <form method="POST" action="{{ route('admin.categories.update', $category) }}" class="mt-8 grid gap-4">
                @csrf
                @method('PUT')
                @include('admin.categories._form', ['category' => $category])
                <button class="rounded-2xl bg-emerald-600 px-4 py-3 font-semibold text-white transition hover:bg-emerald-700">Cập nhật</button>
            </form>
        </div>
    </div>
</x-layouts.app>