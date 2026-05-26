<x-layouts.app title="Products">
    <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <!-- Banner Image -->
        <div class="mb-8 overflow-hidden rounded-2xl shadow-sm">
            <img src="{{ asset('img/banner/banner7.png') }}" alt="Banner sản phẩm" style="width: 100%; height: auto; max-height: 360px; aspect-ratio: 16/5; object-fit: cover; display: block;">
        </div>

        <!-- Active Filters Display -->
        @if($parentId > 0 || $childId > 0)
        <div class="mb-6 flex flex-wrap items-center gap-2">
            @if($parentId > 0)
                <span style="display: inline-flex; align-items: center; gap: 0.375rem; border-radius: 9999px; background-color: #f1f5f9; padding: 0.25rem 0.75rem; font-size: 0.875rem; font-weight: 600; color: #334155;">
                    Danh mục: {{ $parents->firstWhere('id_loai', $parentId)?->ten_loai ?? 'Loại cha' }}
                    @if($childId == 0)
                    <a href="{{ route('products.index', ['q' => $search]) }}" style="margin-left: 0.25rem; color: #94a3b8; text-decoration: none;">&times;</a>
                    @endif
                </span>
            @endif
            @if($childId > 0)
                <span style="display: inline-flex; align-items: center; gap: 0.375rem; border-radius: 9999px; background-color: #ecfdf5; padding: 0.25rem 0.75rem; font-size: 0.875rem; font-weight: 600; color: #059669; border: 1px solid #a7f3d0;">
                    Phân loại: {{ $categoryPaths[$childId] ?? 'Loại con' }}
                    <a href="{{ route('products.index', ['parent' => $parentId, 'q' => $search]) }}" style="margin-left: 0.25rem; color: #34d399; text-decoration: none;">&times;</a>
                </span>
            @endif
        </div>
        @endif

        <!-- Product Grid -->
        <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">
            @forelse($books as $book)
                @php
                    $discount = (int) ($book->giamgia ?? 0);
                    $categoryLabel = $categoryPaths[$book->id_loai] ?? $book->category?->ten_loai ?? 'Sách';
                @endphp
                <article class="group flex flex-col overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-emerald-200 hover:shadow-xl hover:shadow-emerald-100/50">
                    <div class="relative bg-slate-50/50 p-6 transition-colors group-hover:bg-emerald-50/30">
                        @if($discount > 0)
                            <span class="absolute left-4 top-4 z-10 rounded-full bg-rose-500 px-2.5 py-1 text-xs font-bold text-white shadow-sm">
                                -{{ $discount }}%
                            </span>
                        @endif
                        <a href="{{ route('products.show', $book) }}" class="block">
                            <img src="{{ $book->image_url }}" alt="{{ $book->tensach }}" class="mx-auto h-48 w-full object-contain transition-transform duration-500 group-hover:scale-105">
                        </a>
                    </div>
                    <div class="flex flex-1 flex-col p-5">
                        <span class="mb-2 line-clamp-1 text-xs font-semibold uppercase tracking-wider text-emerald-600">{{ $categoryLabel }}</span>
                        <h2 class="mb-3 min-h-[3rem] text-[1.05rem] font-bold leading-snug text-slate-900 transition-colors group-hover:text-emerald-700">
                            <a href="{{ route('products.show', $book) }}" class="line-clamp-2 hover:text-emerald-700">{{ $book->tensach }}</a>
                        </h2>
                        @if($book->tacgia)
                            <p class="-mt-1 mb-3 text-sm text-slate-500">{{ $book->tacgia }}</p>
                        @endif
                        
                        <div class="mt-auto">
                            <div class="mb-4 flex items-end gap-2">
                                <span class="text-lg font-extrabold text-slate-900">{{ number_format($book->final_price) }} ₫</span>
                                @if($discount > 0)
                                    <span class="mb-0.5 text-sm font-medium text-slate-400 line-through">{{ number_format($book->dongia) }} ₫</span>
                                @endif
                            </div>
                            <div class="flex items-center justify-between rounded-xl bg-slate-50 px-3 py-2 text-xs font-medium text-slate-500 ring-1 ring-inset ring-slate-100">
                                <span>Kho: <span class="text-slate-700">{{ $book->hangton }}</span></span>
                                <span>Đã bán: <span class="text-slate-700">{{ $book->daban }}</span></span>
                            </div>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-full flex flex-col items-center justify-center rounded-[2rem] border-2 border-dashed border-slate-200 bg-slate-50 py-20 text-center">
                    <svg class="mb-4 h-16 w-16 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    <h3 class="text-lg font-bold text-slate-900">Không tìm thấy sản phẩm</h3>
                    <p class="mt-2 max-w-sm text-slate-500">Rất tiếc, chúng tôi không tìm thấy sản phẩm nào phù hợp với yêu cầu của bạn. Vui lòng thử lại với từ khóa hoặc danh mục khác.</p>
                    <a href="{{ route('products.index') }}" style="margin-top: 1.5rem; display: inline-block; border-radius: 0.75rem; background-color: #059669; padding: 0.625rem 1.5rem; font-weight: 700; color: white; text-decoration: none;">Xóa bộ lọc</a>
                </div>
            @endforelse
        </div>

        <div class="mt-10">
            {{ $books->links() }}
        </div>
    </section>
</x-layouts.app>