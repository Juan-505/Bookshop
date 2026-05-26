<x-layouts.app title="Admin Users">
    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-4 rounded-3xl border border-emerald-100 bg-white p-8 shadow-[0_12px_40px_rgba(16,185,129,0.08)]">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <p class="text-sm uppercase tracking-[0.35em] text-emerald-600">Admin panel</p>
                <h1 class="mt-2 text-3xl font-semibold text-slate-900">Quản lý user</h1>
            </div>
            <a href="{{ route('admin.users.create') }}" class="rounded-2xl bg-emerald-600 px-4 py-3 font-semibold text-white transition hover:bg-emerald-700">+ Create user</a>
        </div>

        @include('admin._nav')

        <div class="overflow-x-auto">
            <table class="min-w-full text-left">
                <thead class="text-sm text-slate-500">
                    <tr>
                        <th class="py-3 pr-4">Name</th>
                        <th class="py-3 pr-4">Email</th>
                        <th class="py-3 pr-4">Role</th>
                        <th class="py-3 pr-4">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-emerald-100">
                    @foreach($users as $user)
                        <tr>
                            <td class="py-4 pr-4 font-medium text-slate-900">{{ $user->name }}</td>
                            <td class="py-4 pr-4 text-slate-600">{{ $user->email }}</td>
                            <td class="py-4 pr-4">
                                <form method="POST" action="{{ route('admin.users.role', $user) }}" class="inline-flex">
                                    @csrf
                                    @method('PATCH')
                                    <select name="role" onchange="this.form.submit()" class="rounded-xl border border-emerald-100 bg-emerald-50 px-3 py-2 text-slate-700">
                                        @foreach(config('roles') as $role)
                                            <option value="{{ $role }}" @selected($user->role === $role)>{{ ucfirst($role) }}</option>
                                        @endforeach
                                    </select>
                                </form>
                            </td>
                            <td class="py-4 pr-4">
                                <div class="flex flex-wrap gap-2">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="rounded-xl border border-emerald-200 px-3 py-2 text-sm font-medium text-emerald-700 transition hover:bg-emerald-50">Edit</a>
                                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Xóa user này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="rounded-xl border border-rose-200 px-3 py-2 text-sm font-medium text-rose-600 transition hover:bg-rose-50">Delete</button>
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
</x-layouts.app>
