<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? config('shop.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .category-dropdown-wrapper {
            position: relative;
            display: inline-block;
        }
        .category-dropdown-menu {
            visibility: hidden;
            position: absolute;
            left: 0;
            top: 100%;
            z-index: 50;
            width: 18rem;
            opacity: 0;
            transform: translateY(-0.5rem);
            transition: all 0.2s;
            background-color: white;
            border: 1px solid #f1f5f9;
            border-radius: 1rem;
            padding: 0.5rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            margin-top: 0.5rem;
        }
        .category-dropdown-wrapper:hover .category-dropdown-menu {
            visibility: visible;
            opacity: 1;
            transform: translateY(0);
        }
        .category-dropdown-menu::before {
            content: '';
            position: absolute;
            top: -0.5rem;
            left: 0;
            right: 0;
            height: 0.5rem;
        }
        .category-item {
            position: relative;
        }
        .category-submenu {
            visibility: hidden;
            position: absolute;
            left: 100%;
            top: -0.5rem;
            z-index: 50;
            width: 16rem;
            opacity: 0;
            transform: translateX(-0.5rem);
            transition: all 0.2s;
            background-color: white;
            border: 1px solid #f1f5f9;
            border-radius: 1rem;
            padding: 0.5rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            margin-left: 0.25rem;
        }
        .category-item:hover .category-submenu {
            visibility: visible;
            opacity: 1;
            transform: translateX(0);
        }
        .category-submenu::before {
            content: '';
            position: absolute;
            left: -0.5rem;
            top: 0;
            bottom: 0;
            width: 0.5rem;
        }
        .cat-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            border-radius: 1rem;
            background-color: #059669;
            padding: 0.6rem 1rem;
            font-weight: 700;
            color: white;
            white-space: nowrap;
            transition: all 0.2s;
            box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.2);
            border: none;
            cursor: pointer;
        }
        .cat-btn:hover {
            background-color: #047857;
            box-shadow: 0 10px 15px -3px rgba(16, 185, 129, 0.3);
        }
        .cat-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-radius: 0.75rem;
            padding: 0.625rem 1rem;
            font-size: 0.875rem;
            font-weight: 600;
            color: #334155;
            transition: all 0.2s;
            text-decoration: none;
        }
        .cat-link:hover, .cat-link.active {
            background-color: #ecfdf5;
            color: #059669;
        }
        .subcat-link {
            display: block;
            border-radius: 0.75rem;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            font-weight: 500;
            color: #475569;
            transition: all 0.2s;
            text-decoration: none;
        }
        .subcat-link:hover, .subcat-link.active {
            background-color: #ecfdf5;
            color: #059669;
        }
        .cat-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }
        .subcat-header {
            padding: 0.25rem 0.75rem 0.5rem;
            border-bottom: 1px solid #f8fafc;
            margin-bottom: 0.5rem;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #94a3b8;
        }

        /* ── New Header Styles ── */
        .cat-icon-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            padding: 0.5rem 0.75rem;
            border-radius: 0.75rem;
            border: 1px solid #e2e8f0;
            background: white;
            color: #475569;
            cursor: pointer;
            transition: all 0.2s;
            font-size: 0;
        }
        .cat-icon-btn:hover {
            border-color: #059669;
            color: #059669;
            background-color: #ecfdf5;
        }
        .header-search-wrap {
            position: relative;
            display: flex;
            align-items: center;
            width: 100%;
        }
        .header-search-icon {
            position: absolute;
            left: 0.875rem;
            width: 18px;
            height: 18px;
            color: #94a3b8;
            pointer-events: none;
        }
        .header-search-input {
            width: 100%;
            padding: 0.625rem 3.5rem 0.625rem 2.75rem;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            color: #334155;
            background: #f8fafc;
            outline: none;
            transition: all 0.2s;
        }
        .header-search-input:focus {
            border-color: #059669;
            background: white;
            box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.1);
        }
        .header-search-input::placeholder {
            color: #94a3b8;
        }
        .header-search-btn {
            position: absolute;
            right: 0.375rem;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 2.25rem;
            height: 2.25rem;
            border-radius: 0.5rem;
            border: none;
            background: #059669;
            color: white;
            cursor: pointer;
            transition: all 0.2s;
        }
        .header-search-btn:hover {
            background: #047857;
        }
        .header-icon-btn {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.125rem;
            padding: 0.375rem 0.625rem;
            border-radius: 0.5rem;
            color: #475569;
            font-size: 0.6875rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.15s;
            white-space: nowrap;
        }
        .header-icon-btn:hover {
            color: #059669;
            background-color: #ecfdf5;
        }
        .cart-badge {
            position: absolute;
            top: -6px;
            right: -8px;
            background: #ef4444;
            color: white;
            font-size: 0.625rem;
            font-weight: 700;
            min-width: 16px;
            height: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 999px;
            line-height: 1;
        }
        .header-admin-btn {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 0.5rem;
            background: #059669;
            color: white;
            font-size: 0.75rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
        }
        .header-admin-btn:hover {
            background: #047857;
        }
        .header-logout-btn {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 0.5rem;
            border: 1px solid #e2e8f0;
            background: white;
            color: #64748b;
            font-size: 0.75rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }
        .header-logout-btn:hover {
            border-color: #ef4444;
            color: #ef4444;
            background-color: #fef2f2;
        }
    </style>
</head>
<body class="min-h-screen bg-white text-slate-900 antialiased" data-authenticated="{{ auth()->check() ? '1' : '0' }}">
    <div class="flex min-h-screen flex-col bg-[radial-gradient(circle_at_top,_rgba(16,185,129,0.09),_transparent_35%),linear-gradient(180deg,_#ffffff_0%,_#f7fbf7_100%)]">
        <header class="sticky top-0 z-30 border-b border-emerald-100 bg-white/95 backdrop-blur shadow-sm">
            <div class="mx-auto flex max-w-7xl items-center gap-3 px-4 py-3 sm:px-6 lg:px-8">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex-shrink-0">
                    <img src="{{ asset('img/logo/logo-newchapter.png') }}" alt="{{ config('shop.name') }}" style="height: 56px; width: auto;">
                </a>

                <!-- Category Icon Button + Dropdown -->
                <div class="category-dropdown-wrapper flex-shrink-0">
                    <button class="cat-icon-btn" title="Danh mục sản phẩm">
                        <!-- 4-square grid icon -->
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="1" y="1" width="8" height="8" rx="2" fill="currentColor"/>
                            <rect x="13" y="1" width="8" height="8" rx="2" fill="currentColor"/>
                            <rect x="1" y="13" width="8" height="8" rx="2" fill="currentColor"/>
                            <rect x="13" y="13" width="8" height="8" rx="2" fill="currentColor"/>
                        </svg>
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" style="margin-left:2px; opacity:0.6;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div class="category-dropdown-menu">
                        <ul class="cat-list">
                            <li>
                                <a href="{{ route('products.index') }}" class="cat-link">Tất cả sản phẩm</a>
                            </li>
                            @if(isset($parents) && isset($childrenByParent))
                                @foreach($parents as $parent)
                                    @php
                                        $parentChildren = $childrenByParent->get($parent->id_loai, collect());
                                        $isParentActive = request('parent') == $parent->id_loai;
                                    @endphp
                                    <li class="category-item">
                                        <a href="{{ route('products.index', ['parent' => $parent->id_loai]) }}" class="cat-link {{ $isParentActive ? 'active' : '' }}">
                                            {{ $parent->ten_loai }}
                                            @if($parentChildren->isNotEmpty())
                                                <svg style="width:14px;height:14px;color:#94a3b8;flex-shrink:0;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                                </svg>
                                            @endif
                                        </a>
                                        @if($parentChildren->isNotEmpty())
                                            <div class="category-submenu">
                                                <div class="subcat-header">{{ $parent->ten_loai }}</div>
                                                <ul class="cat-list">
                                                    @foreach($parentChildren as $child)
                                                        @php $isChildActive = request('child') == $child->id_loai; @endphp
                                                        <li>
                                                            <a href="{{ route('products.index', ['parent' => $parent->id_loai, 'child' => $child->id_loai]) }}" class="subcat-link {{ $isChildActive ? 'active' : '' }}">
                                                                {{ $child->ten_loai }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>

                <!-- Search Bar (takes up remaining space) -->
                <form method="GET" action="{{ route('products.index') }}" class="flex-1 max-w-2xl">
                    <div class="header-search-wrap">
                        <svg class="header-search-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input name="q" value="{{ request('q') }}" placeholder="Tìm kiếm sách, vật dụng......" class="header-search-input">
                        <button type="submit" class="header-search-btn">
                            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </button>
                    </div>
                </form>

                <!-- Right: Trang chủ | Products | Cart | Account -->
                <div class="flex items-center gap-1 flex-shrink-0">
                    <a href="{{ route('home') }}" class="header-icon-btn">
                        <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                            <polyline stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" points="9 22 9 12 15 12 15 22"/>
                        </svg>
                        <span>Trang chủ</span>
                    </a>

                    <!-- Giỏ hàng -->
                    <a href="{{ route('cart.index') }}" class="header-icon-btn">
                        <div class="relative">
                            <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            <span class="cart-badge" data-cart-badge>{{ $cartCount ?? 0 }}</span>
                        </div>
                        <span>Giỏ hàng</span>
                    </a>

                    <!-- Tài khoản -->
                    @auth
                        <a href="{{ route('dashboard') }}" class="header-icon-btn">
                            <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
                                <circle cx="12" cy="7" r="4" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"/>
                            </svg>
                            <span>{{ auth()->user()->name }}</span>
                        </a>
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="header-admin-btn">Admin</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                            @csrf
                            <button class="header-logout-btn">Đăng xuất</button>
                        </form>
                    @else
                        <a href="{{ route('login.form') }}" class="header-icon-btn">
                            <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
                                <circle cx="12" cy="7" r="4" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"/>
                            </svg>
                            <span>Tài khoản</span>
                        </a>
                    @endauth
                </div>
            </div>
        </header>

        <main class="flex-1">
            @if(session('status'))
                <div class="mx-auto mt-6 max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-800 shadow-sm">{{ session('status') }}</div>
                </div>
            @endif

            @if($errors->any())
                <div class="mx-auto mt-6 max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-rose-700 shadow-sm">
                        <ul class="list-disc space-y-1 pl-5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            {{ $slot }}
        </main>

        <footer class="border-t border-emerald-100/60 bg-gradient-to-b from-white to-slate-50/50">
            <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 gap-8 md:grid-cols-12">
                    <!-- Brand Section -->
                    <div class="md:col-span-5 flex flex-col gap-5">
                        <a href="{{ route('home') }}" class="flex items-center gap-3">
                            <img src="{{ asset('img/logo/logo-newchapter.png') }}" alt="{{ config('shop.name') }}" class="h-16 w-auto">
                            <div>
                                <p class="text-lg font-bold text-emerald-800 tracking-tight">{{ config('shop.name') }}</p>
                                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">{{ config('shop.tagline', 'Hành Trình Tri Thức Mới') }}</p>
                            </div>
                        </a>
                        <p class="text-sm leading-relaxed text-slate-500 max-w-sm">
                            NewChapter đem đến trải nghiệm tìm kiếm, lựa chọn và mua sắm sách thông minh, nhanh chóng cùng nguồn tri thức đa dạng, phong phú.
                        </p>
                    </div>

                    <!-- Column 2: Quick Links -->
                    <div class="md:col-span-3 flex flex-col gap-4">
                        <h3 class="text-xs font-bold uppercase tracking-widest text-slate-400">Liên kết nhanh</h3>
                        <ul class="space-y-3 text-sm font-semibold text-slate-600">
                            <li><a href="{{ route('home') }}" class="hover:text-emerald-600 transition">Trang chủ</a></li>
                            <li><a href="{{ route('products.index') }}" class="hover:text-emerald-600 transition">Danh mục sách</a></li>
                            <li><a href="{{ auth()->check() ? route('dashboard') : route('login.form') }}" class="hover:text-emerald-600 transition">Trang thông tin</a></li>
                            <li><a href="{{ route('cart.index') }}" class="hover:text-emerald-600 transition">Giỏ hàng của bạn</a></li>
                        </ul>
                    </div>

                    <!-- Column 3: Contact & Verification -->
                    <div class="md:col-span-4 flex flex-col gap-4">
                        <h3 class="text-xs font-bold uppercase tracking-widest text-slate-400">Thông tin liên hệ</h3>
                        <ul class="space-y-3 text-sm text-slate-600">
                            <li class="flex items-start gap-2.5">
                                <svg class="h-5 w-5 text-emerald-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                    <circle cx="12" cy="10" r="3"/>
                                </svg>
                                <span class="text-sm">Số 123 Đường Sách Nguyễn Văn Bình, Quận 1, TP. Hồ Chí Minh</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <svg class="h-5 w-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                                </svg>
                                <span class="text-sm">Hotline: 1900 6482</span>
                            </li>
                            <li class="flex items-center gap-2.5">
                                <svg class="h-5 w-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                    <polyline points="22,6 12,13 2,6"/>
                                </svg>
                                <span class="text-sm">support@newchapter.vn</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Bottom Copyright Bar -->
            <div class="border-t border-slate-200/60 mt-14 pt-8 flex flex-col sm:flex-row items-center justify-end gap-4 text-xs text-slate-500">
                <p class="font-medium text-right sm:ml-auto">
                    &copy; {{ date('Y') }} {{ config('shop.name', 'New Chapter') }}. Tất cả các quyền được bảo lưu.
                </p>
            </div>
        </footer>
    </div>
</body>
</html>
