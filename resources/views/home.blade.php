<x-layouts.app title="{{ config('shop.name') }}">

    <!-- Main rotating banner under header (banners 2,3,6 cycle here) -->
    <section class="mx-auto max-w-7xl px-4 pt-6 pb-2 sm:px-6 lg:px-8">
        <div>
            <img id="main-banner" src="{{ asset('img/banner/banner2.png') }}" alt="Main banner {{ config('shop.name') }}" class="w-full h-auto rounded-xl object-contain">
        </div>
    </section>

    <section id="categories" class="relative overflow-hidden bg-gradient-to-b from-emerald-50 to-white py-10 sm:py-14 lg:py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid items-center gap-10 lg:grid-cols-[1fr_1.2fr]">
                <div id="hero-left">
                    <span class="inline-flex items-center rounded-full border border-emerald-200 bg-white px-4 py-1.5 text-xs font-semibold uppercase tracking-[0.2em] text-emerald-700">New arrivals</span>
                    <h1 class="mt-5 text-4xl font-extrabold tracking-tight text-slate-900 sm:text-5xl">Sách mới mỗi ngày tại {{ config('shop.name') }}</h1>
                    <p class="mt-4 max-w-xl text-base leading-7 text-slate-600">Chọn nhanh, đặt dễ, giao gọn.</p>
                    <div class="mt-7 flex flex-wrap items-center gap-3">
                        <a href="{{ route('products.index') }}" class="rounded-2xl bg-emerald-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-emerald-700">Mua ngay</a>
                        <a href="{{ route('products.index') }}" class="rounded-2xl border border-emerald-200 px-6 py-3 text-sm font-semibold text-emerald-700 transition hover:bg-emerald-50">Xem danh mục</a>
                    </div>
                </div>

                <div class="sm:p-6 flex justify-center w-full">
                    <img id="side-banner" src="{{ asset('img/banner/banner1.png') }}" alt="Banner vuông {{ config('shop.name') }}" class="w-full max-w-[560px] rounded-2xl object-contain shadow-lg hover:scale-[1.02] transition-all duration-300">
                </div>
            </div>
        </div>
    </section>

    <script>
        (function(){
            const mainImages = [
                "{{ asset('img/banner/banner2.png') }}",
                "{{ asset('img/banner/banner3.png') }}",
            ];
            const sideImages = [
                "{{ asset('img/banner/banner1.png') }}",
                "{{ asset('img/banner/banner4.png') }}",
                "{{ asset('img/banner/banner5.png') }}",
            ];

            let mainIndex = 0;
            let sideIndex = 0;

            function setSideHeight(){
                // Let image preserve natural aspect ratio and grow larger
            }

            function rotate(){
                const mainEl = document.getElementById('main-banner');
                const sideEl = document.getElementById('side-banner');
                if (mainEl) {
                    mainIndex = (mainIndex + 1) % mainImages.length;
                    mainEl.src = mainImages[mainIndex];
                }
                if (sideEl) {
                    sideIndex = (sideIndex + 1) % sideImages.length;
                    sideEl.src = sideImages[sideIndex];
                }
                setSideHeight();
            }

            // Start after a short delay to allow images to load
            window.addEventListener('DOMContentLoaded', () => {
                setSideHeight();
                setInterval(rotate, 4000);
            });
            window.addEventListener('resize', setSideHeight);
        })();
    </script>

    <!-- Best sellers -->
    <section id="best-sellers" class="mx-auto max-w-7xl px-4 pb-16 sm:px-6 lg:px-8">
        <h2 class="text-xl font-semibold text-slate-900">Sản phẩm bán chạy</h2>
        <p class="text-sm text-slate-500">Top 5 sản phẩm được mua nhiều nhất</p>
        <div class="mt-6 grid gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5">
            @foreach($bestSellers as $book)
                <a href="{{ route('products.show', $book->idbook) }}" class="rounded-2xl border border-slate-100 bg-white p-4 text-center">
                    <img src="{{ $book->image_url }}" alt="{{ $book->tensach }}" class="mx-auto h-40 w-28 object-contain">
                    <div class="mt-3 text-sm font-medium text-slate-900">{{ $book->tensach }}</div>
                    <div class="mt-1 text-sm text-slate-600">{{ number_format($book->final_price) }} ₫</div>
                    <div class="mt-1 text-xs text-slate-500">Đã bán: {{ $book->daban }}</div>
                </a>
            @endforeach
        </div>
    </section>

    <section id="featured" class="mx-auto max-w-7xl px-4 pb-16 sm:px-6 lg:px-8">
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-3xl border border-slate-200 bg-white p-6">
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-emerald-600">Catalog</p>
                <p class="mt-3 text-2xl font-bold text-slate-900">500+</p>
                <p class="mt-1 text-sm text-slate-500">Sản phẩm đa dạng</p>
            </div>
            <div class="rounded-3xl border border-slate-200 bg-white p-6">
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-emerald-600">Delivery</p>
                <p class="mt-3 text-2xl font-bold text-slate-900">Toàn quốc</p>
                <p class="mt-1 text-sm text-slate-500">Đóng gói an toàn</p>
            </div>
            <div class="rounded-3xl border border-slate-200 bg-white p-6">
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-emerald-600">Pricing</p>
                <p class="mt-3 text-2xl font-bold text-slate-900">Ưu đãi</p>
                <p class="mt-1 text-sm text-slate-500">Giảm giá mỗi ngày</p>
            </div>
            <a href="{{ route('products.index') }}" class="rounded-3xl bg-emerald-600 p-6 text-white transition hover:bg-emerald-700">
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-emerald-100">Explore</p>
                <p class="mt-3 text-2xl font-bold">Xem tất cả</p>
                <p class="mt-1 text-sm text-emerald-100">Mở danh sách sản phẩm</p>
            </a>
        </div>
    </section>
</x-layouts.app>
