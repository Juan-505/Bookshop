<x-layouts.app title="Create User">
    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="rounded-3xl border border-emerald-100 bg-white p-8 shadow-[0_12px_40px_rgba(16,185,129,0.08)]">
            <h1 class="text-3xl font-semibold text-slate-900">Tạo user mới</h1>
            @include('admin._nav')
            <form method="POST" action="{{ route('admin.users.store') }}" class="mt-8 grid gap-4">
                @csrf
                @include('admin.users._form')
                <button class="rounded-2xl bg-emerald-600 px-4 py-3 font-semibold text-white transition hover:bg-emerald-700">Save</button>
            </form>
        </div>
    </div>
</x-layouts.app>
