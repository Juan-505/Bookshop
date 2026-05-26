@php($currentCategory = $category ?? null)
<div>
    <label class="mb-2 block text-sm text-slate-600">Tên danh mục</label>
    <input name="ten_loai" value="{{ old('ten_loai', $currentCategory->ten_loai ?? '') }}" class="w-full rounded-2xl border border-emerald-100 bg-emerald-50 px-4 py-3 outline-none focus:border-emerald-300 focus:bg-white" required>
</div>
<div>
    <label class="mb-2 block text-sm text-slate-600">Danh mục cha</label>
    <select name="id_cha" class="w-full rounded-2xl border border-emerald-100 bg-emerald-50 px-4 py-3 outline-none focus:border-emerald-300 focus:bg-white">
        <option value="">-- Không có --</option>
        @foreach($parents as $parent)
            <option value="{{ $parent->id_loai }}" @selected((string) old('id_cha', $currentCategory->id_cha ?? '') === (string) $parent->id_loai)>{{ $parent->ten_loai }}</option>
        @endforeach
    </select>
</div>