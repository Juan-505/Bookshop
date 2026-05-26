@php($currentProduct = $product ?? null)
<div>
    <label class="mb-2 block text-sm text-slate-600">Tên sản phẩm</label>
    <input name="tensach" value="{{ old('tensach', $currentProduct->tensach ?? '') }}" class="w-full rounded-2xl border border-emerald-100 bg-emerald-50 px-4 py-3 outline-none focus:border-emerald-300 focus:bg-white" required>
</div>
<div>
    <label class="mb-2 block text-sm text-slate-600">Ảnh</label>
    <input name="hinh" value="{{ old('hinh', $currentProduct->hinh ?? '') }}" class="w-full rounded-2xl border border-emerald-100 bg-emerald-50 px-4 py-3 outline-none focus:border-emerald-300 focus:bg-white" placeholder="Tên file ảnh trong public/img/books">
</div>
<div>
    <label class="mb-2 block text-sm text-slate-600">Danh mục</label>
    <select name="id_loai" class="w-full rounded-2xl border border-emerald-100 bg-emerald-50 px-4 py-3 outline-none focus:border-emerald-300 focus:bg-white" required>
        <option value="">-- Chọn danh mục --</option>
        @foreach($categories as $category)
            <option value="{{ $category->id_loai }}" @selected((string) old('id_loai', $currentProduct->id_loai ?? '') === (string) $category->id_loai)>{{ $category->ten_loai }}</option>
        @endforeach
    </select>
</div>
<div class="grid gap-4 md:grid-cols-2">
    <div>
        <label class="mb-2 block text-sm text-slate-600">Đơn giá</label>
        <input name="dongia" type="number" min="0" value="{{ old('dongia', $currentProduct->dongia ?? 0) }}" class="w-full rounded-2xl border border-emerald-100 bg-emerald-50 px-4 py-3 outline-none focus:border-emerald-300 focus:bg-white" required>
    </div>
    <div>
        <label class="mb-2 block text-sm text-slate-600">Giảm giá (%)</label>
        <input name="giamgia" type="number" min="0" max="100" value="{{ old('giamgia', $currentProduct->giamgia ?? 0) }}" class="w-full rounded-2xl border border-emerald-100 bg-emerald-50 px-4 py-3 outline-none focus:border-emerald-300 focus:bg-white">
    </div>
</div>
<div class="grid gap-4 md:grid-cols-2">
    <div>
        <label class="mb-2 block text-sm text-slate-600">Tồn kho</label>
        <input name="hangton" type="number" min="0" value="{{ old('hangton', $currentProduct->hangton ?? 0) }}" class="w-full rounded-2xl border border-emerald-100 bg-emerald-50 px-4 py-3 outline-none focus:border-emerald-300 focus:bg-white" required>
    </div>
    <div>
        <label class="mb-2 block text-sm text-slate-600">Đã bán</label>
        <input name="daban" type="number" min="0" value="{{ old('daban', $currentProduct->daban ?? 0) }}" class="w-full rounded-2xl border border-emerald-100 bg-emerald-50 px-4 py-3 outline-none focus:border-emerald-300 focus:bg-white" required>
    </div>
</div>
<div>
    <label class="mb-2 block text-sm text-slate-600">Ngày nhập</label>
    <input name="ngaynhap" type="date" value="{{ old('ngaynhap', optional($currentProduct->ngaynhap ?? null)->format('Y-m-d')) }}" class="w-full rounded-2xl border border-emerald-100 bg-emerald-50 px-4 py-3 outline-none focus:border-emerald-300 focus:bg-white">
</div>
<div class="grid gap-4 md:grid-cols-2">
    <div>
        <label class="mb-2 block text-sm text-slate-600">Nhà cung cấp</label>
        <input name="nhacungcap" value="{{ old('nhacungcap', $currentProduct->nhacungcap ?? '') }}" class="w-full rounded-2xl border border-emerald-100 bg-emerald-50 px-4 py-3 outline-none focus:border-emerald-300 focus:bg-white">
    </div>
    <div>
        <label class="mb-2 block text-sm text-slate-600">Tác giả</label>
        <input name="tacgia" value="{{ old('tacgia', $currentProduct->tacgia ?? '') }}" class="w-full rounded-2xl border border-emerald-100 bg-emerald-50 px-4 py-3 outline-none focus:border-emerald-300 focus:bg-white">
    </div>
</div>
<div class="grid gap-4 md:grid-cols-2">
    <div>
        <label class="mb-2 block text-sm text-slate-600">NXB</label>
        <input name="nxb" value="{{ old('nxb', $currentProduct->nxb ?? '') }}" class="w-full rounded-2xl border border-emerald-100 bg-emerald-50 px-4 py-3 outline-none focus:border-emerald-300 focus:bg-white">
    </div>
    <div>
        <label class="mb-2 block text-sm text-slate-600">Năm XB</label>
        <input name="namxb" type="number" min="0" max="9999" value="{{ old('namxb', $currentProduct->namxb ?? '') }}" class="w-full rounded-2xl border border-emerald-100 bg-emerald-50 px-4 py-3 outline-none focus:border-emerald-300 focus:bg-white">
    </div>
</div>
<div class="grid gap-4 md:grid-cols-2">
    <div>
        <label class="mb-2 block text-sm text-slate-600">Trọng lượng (gr)</label>
        <input name="trongluong" type="number" min="0" value="{{ old('trongluong', $currentProduct->trongluong ?? '') }}" class="w-full rounded-2xl border border-emerald-100 bg-emerald-50 px-4 py-3 outline-none focus:border-emerald-300 focus:bg-white">
    </div>
    <div>
        <label class="mb-2 block text-sm text-slate-600">Số trang</label>
        <input name="sotrang" type="number" min="0" value="{{ old('sotrang', $currentProduct->sotrang ?? '') }}" class="w-full rounded-2xl border border-emerald-100 bg-emerald-50 px-4 py-3 outline-none focus:border-emerald-300 focus:bg-white">
    </div>
</div>
<div>
    <label class="mb-2 block text-sm text-slate-600">Hình thức</label>
    <input name="hinhthuc" value="{{ old('hinhthuc', $currentProduct->hinhthuc ?? '') }}" class="w-full rounded-2xl border border-emerald-100 bg-emerald-50 px-4 py-3 outline-none focus:border-emerald-300 focus:bg-white">
</div>
<div>
    <label class="mb-2 block text-sm text-slate-600">Mô tả</label>
    <textarea name="mota" rows="5" class="w-full rounded-2xl border border-emerald-100 bg-emerald-50 px-4 py-3 outline-none focus:border-emerald-300 focus:bg-white">{{ old('mota', $currentProduct->mota ?? '') }}</textarea>
</div>