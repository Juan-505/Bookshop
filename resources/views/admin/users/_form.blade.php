@php($currentUser = $user ?? null)
<div>
    <label class="mb-2 block text-sm text-slate-600">Name</label>
    <input name="name" value="{{ old('name', $currentUser->name ?? '') }}" class="w-full rounded-2xl border border-emerald-100 bg-emerald-50 px-4 py-3 outline-none focus:border-emerald-300 focus:bg-white" required>
</div>
<div>
    <label class="mb-2 block text-sm text-slate-600">Email</label>
    <input name="email" type="email" autocomplete="new-email" value="{{ old('email', $currentUser->email ?? '') }}" class="w-full rounded-2xl border border-emerald-100 bg-emerald-50 px-4 py-3 outline-none focus:border-emerald-300 focus:bg-white" required>
</div>
<div>
    <label class="mb-2 block text-sm text-slate-600">Password {{ $currentUser ? '(optional)' : '' }}</label>
    <input name="password" type="password" autocomplete="new-password" class="w-full rounded-2xl border border-emerald-100 bg-emerald-50 px-4 py-3 outline-none focus:border-emerald-300 focus:bg-white" {{ $currentUser ? '' : 'required' }}>
</div>
<div>
    <label class="mb-2 block text-sm text-slate-600">Role</label>
    <select name="role" class="w-full rounded-2xl border border-emerald-100 bg-emerald-50 px-4 py-3 outline-none focus:border-emerald-300 focus:bg-white" required>
        @foreach(config('roles') as $role)
            <option value="{{ $role }}" @selected(old('role', $currentUser->role ?? 'user') === $role)>{{ ucfirst($role) }}</option>
        @endforeach
    </select>
</div>