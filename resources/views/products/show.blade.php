<x-layouts.app title="{{ $product->tensach }}">
    @php
        $discount = (int) ($product->giamgia ?? 0);
        $categoryName = $product->category?->ten_loai ?? 'Sách';
    @endphp

    <section class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="grid gap-6 lg:grid-cols-[420px_minmax(0,1fr)]">
            <aside class="rounded-2xl bg-white p-4 shadow-sm ring-1 ring-slate-200">
                <div class="overflow-hidden rounded-xl bg-white">
                    <img src="{{ $product->image_url }}" alt="{{ $product->tensach }}" class="h-[420px] w-full object-contain">
                </div>

                <div class="mt-4 grid gap-3 sm:grid-cols-2">
                    <button type="button" class="rounded-xl border border-rose-500 px-4 py-3 font-semibold text-rose-600 transition hover:bg-rose-50" data-cart-add="{{ $product->idbook }}" data-cart-name="{{ e($product->tensach) }}" data-cart-price="{{ $product->final_price }}" data-cart-image="{{ $product->image_url }}">Thêm vào giỏ hàng</button>
                    <button type="button" class="rounded-xl bg-rose-600 px-4 py-3 font-semibold text-white transition hover:bg-rose-700" data-cart-buy-now="{{ $product->idbook }}" data-cart-name="{{ e($product->tensach) }}" data-cart-price="{{ $product->final_price }}" data-cart-image="{{ $product->image_url }}">Mua ngay</button>
                </div>

                <div class="mt-5 rounded-xl bg-slate-50 p-4">
                    <h3 class="font-semibold text-slate-900">Chính sách ưu đãi của NewChapter</h3>
                    <ul class="mt-3 space-y-3 text-sm text-slate-600">
                        <li class="flex items-center justify-between gap-3"><span>Thời gian giao hàng</span><span class="text-slate-400">Giao nhanh và uy tín</span></li>
                        <li class="flex items-center justify-between gap-3"><span>Chính sách đổi trả</span><span class="text-slate-400">Đổi trả miễn phí toàn quốc</span></li>
                        <li class="flex items-center justify-between gap-3"><span>Chính sách khách sỉ</span><span class="text-slate-400">Ưu đãi khi mua số lượng lớn</span></li>
                    </ul>
                </div>
            </aside>

            <div class="space-y-6">
                <section class="grid gap-4 rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200 lg:grid-cols-[1fr_280px]">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-[0.3em] text-emerald-600">{{ $categoryName }}</p>
                        <h1 class="mt-2 text-3xl font-bold text-slate-900">{{ $product->tensach }}</h1>

                        <div class="mt-4 flex flex-wrap items-end gap-3">
                            <span class="text-3xl font-extrabold text-slate-900">{{ number_format($product->final_price) }} ₫</span>
                            @if($discount > 0)
                                <span class="text-base text-slate-400 line-through">{{ number_format($product->dongia) }} ₫</span>
                                <span class="rounded-full bg-rose-100 px-3 py-1 text-sm font-semibold text-rose-600">-{{ $discount }}%</span>
                            @endif
                        </div>

                        <div class="mt-5 grid gap-2 text-sm text-slate-600 sm:grid-cols-2">
                            <p><span class="font-semibold text-slate-900">Nhà cung cấp:</span> {{ $product->nhacungcap ?: '-' }}</p>
                            <p><span class="font-semibold text-slate-900">Tác giả:</span> {{ $product->tacgia ?: '-' }}</p>
                            <p><span class="font-semibold text-slate-900">NXB:</span> {{ $product->nxb ?: '-' }}</p>
                            <p><span class="font-semibold text-slate-900">Năm XB:</span> {{ $product->namxb ?: '-' }}</p>
                        </div>
                    </div>

                    <div class="rounded-2xl border border-slate-200 p-4">
                        <div class="grid grid-cols-2 gap-3 text-sm">
                            <div class="rounded-xl bg-slate-50 p-3"><span class="block text-slate-500">Mã hàng</span><span class="mt-1 block font-semibold text-slate-900">{{ $product->idbook }}</span></div>
                            <div class="rounded-xl bg-slate-50 p-3"><span class="block text-slate-500">Hình thức</span><span class="mt-1 block font-semibold text-slate-900">{{ $product->hinhthuc ?: '-' }}</span></div>
                            <div class="rounded-xl bg-slate-50 p-3"><span class="block text-slate-500">Trọng lượng (gr)</span><span class="mt-1 block font-semibold text-slate-900">{{ $product->trongluong ?: '-' }}</span></div>
                            <div class="rounded-xl bg-slate-50 p-3"><span class="block text-slate-500">Số trang</span><span class="mt-1 block font-semibold text-slate-900">{{ $product->sotrang ?: '-' }}</span></div>
                            <div class="rounded-xl bg-slate-50 p-3"><span class="block text-slate-500">Tồn kho</span><span class="mt-1 block font-semibold text-slate-900">{{ $product->hangton }}</span></div>
                            <div class="rounded-xl bg-slate-50 p-3"><span class="block text-slate-500">Đã bán</span><span class="mt-1 block font-semibold text-slate-900">{{ $product->daban }}</span></div>
                        </div>
                    </div>
                </section>

                <section class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                    <h2 class="text-xl font-semibold text-slate-900">Thông tin chi tiết</h2>
                    <div class="mt-4 divide-y divide-slate-100 text-sm">
                        <div class="grid grid-cols-[240px_1fr] gap-4 py-3"><div class="text-slate-500">Mã hàng</div><div class="font-medium text-slate-900">{{ $product->idbook }}</div></div>
                        <div class="grid grid-cols-[240px_1fr] gap-4 py-3"><div class="text-slate-500">Tên Nhà Cung Cấp</div><div class="font-medium text-slate-900">{{ $product->nhacungcap ?: '-' }}</div></div>
                        <div class="grid grid-cols-[240px_1fr] gap-4 py-3"><div class="text-slate-500">Tác giả</div><div class="font-medium text-slate-900">{{ $product->tacgia ?: '-' }}</div></div>
                        <div class="grid grid-cols-[240px_1fr] gap-4 py-3"><div class="text-slate-500">NXB</div><div class="font-medium text-slate-900">{{ $product->nxb ?: '-' }}</div></div>
                        <div class="grid grid-cols-[240px_1fr] gap-4 py-3"><div class="text-slate-500">Năm XB</div><div class="font-medium text-slate-900">{{ $product->namxb ?: '-' }}</div></div>
                        <div class="grid grid-cols-[240px_1fr] gap-4 py-3"><div class="text-slate-500">Trọng lượng (gr)</div><div class="font-medium text-slate-900">{{ $product->trongluong ?: '-' }}</div></div>
                        <div class="grid grid-cols-[240px_1fr] gap-4 py-3"><div class="text-slate-500">Số trang</div><div class="font-medium text-slate-900">{{ $product->sotrang ?: '-' }}</div></div>
                        <div class="grid grid-cols-[240px_1fr] gap-4 py-3"><div class="text-slate-500">Hình thức</div><div class="font-medium text-slate-900">{{ $product->hinhthuc ?: '-' }}</div></div>
                    </div>
                </section>

                <section class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                    <h2 class="text-xl font-semibold text-slate-900">Mô tả sản phẩm</h2>
                    <div class="prose prose-slate mt-4 max-w-none text-sm leading-7 text-slate-700">
                        {!! nl2br(e($product->mota ?: 'Chưa có mô tả cho sản phẩm này.')) !!}
                    </div>
                </section>

                <section class="grid gap-6 lg:grid-cols-2">
                    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                        <h2 class="text-xl font-semibold text-slate-900">Sản phẩm cùng tên</h2>
                        <div class="mt-4 grid gap-4 sm:grid-cols-2">
                            @forelse($sameNameProducts as $item)
                                <a href="{{ route('products.show', $item) }}" class="group rounded-2xl border border-slate-100 p-3 transition hover:border-emerald-200 hover:bg-emerald-50/30">
                                    <img src="{{ $item->image_url }}" alt="{{ $item->tensach }}" class="h-36 w-full object-contain">
                                    <p class="mt-3 line-clamp-2 font-semibold text-slate-900 group-hover:text-emerald-700">{{ $item->tensach }}</p>
                                    <p class="mt-1 text-sm text-slate-500">{{ number_format($item->final_price) }} ₫</p>
                                </a>
                            @empty
                                <p class="text-sm text-slate-500">Chưa có sản phẩm cùng tên.</p>
                            @endforelse
                        </div>
                    </div>

                    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                        <h2 class="text-xl font-semibold text-slate-900">Sản phẩm cùng loại</h2>
                        <div class="mt-4 grid gap-4 sm:grid-cols-2">
                            @forelse($sameCategoryProducts as $item)
                                <a href="{{ route('products.show', $item) }}" class="group rounded-2xl border border-slate-100 p-3 transition hover:border-emerald-200 hover:bg-emerald-50/30">
                                    <img src="{{ $item->image_url }}" alt="{{ $item->tensach }}" class="h-36 w-full object-contain">
                                    <p class="mt-3 line-clamp-2 font-semibold text-slate-900 group-hover:text-emerald-700">{{ $item->tensach }}</p>
                                    <p class="mt-1 text-sm text-slate-500">{{ number_format($item->final_price) }} ₫</p>
                                </a>
                            @empty
                                <p class="text-sm text-slate-500">Chưa có sản phẩm cùng loại.</p>
                            @endforelse
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
</x-layouts.app>