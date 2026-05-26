<div class="flex flex-wrap gap-2 rounded-2xl border border-emerald-100 bg-emerald-50 p-3 text-sm font-semibold text-emerald-700">
    <a href="{{ route('admin.dashboard') }}" class="rounded-xl px-3 py-2 transition hover:bg-white">Dashboard</a>
    <a href="{{ route('admin.users.index') }}" class="rounded-xl px-3 py-2 transition hover:bg-white">Users</a>
    <a href="{{ route('admin.categories.index') }}" class="rounded-xl px-3 py-2 transition hover:bg-white">Categories</a>
    <a href="{{ route('admin.products.index') }}" class="rounded-xl px-3 py-2 transition hover:bg-white">Products</a>
    <a href="{{ route('admin.orders.index') }}" class="rounded-xl px-3 py-2 transition hover:bg-white">Orders</a>
</div>