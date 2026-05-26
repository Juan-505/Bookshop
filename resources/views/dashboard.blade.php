<x-layouts.app title="Thông tin tài khoản">
    <div class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="grid gap-6 md:grid-cols-4">
            
            <!-- Sidebar -->
            <div class="md:col-span-1 space-y-6">
                <!-- User Profile Card -->
                <div class="rounded-2xl border border-slate-100 bg-white shadow-sm p-6 text-center">
                    <div class="mx-auto h-20 w-20 flex items-center justify-center rounded-full bg-orange-100 text-orange-600 mb-4">
                        <svg width="40" height="40" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
                            <circle cx="12" cy="7" r="4" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/>
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-slate-900">{{ auth()->user()->name }}</h2>
                    <p class="text-sm text-slate-500 mt-1">{{ auth()->user()->email }}</p>
                    <div class="mt-3 inline-block rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600 uppercase tracking-widest">
                        {{ auth()->user()->role }}
                    </div>
                </div>

                <!-- Navigation -->
                <div class="rounded-2xl border border-slate-100 bg-white shadow-sm p-2 flex flex-col gap-1">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 rounded-xl bg-orange-50 px-4 py-3 text-sm font-medium text-orange-600">
                        <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Tổng quan
                    </a>
                    
                    <a href="{{ route('home') }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-600 hover:bg-slate-50">
                        <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        Tiếp tục mua hàng
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit" class="flex w-full items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-rose-600 hover:bg-rose-50 text-left">
                            <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Đăng xuất
                        </button>
                    </form>
                </div>
            </div>

            <!-- Content Area -->
            <div class="md:col-span-3 space-y-6">
                
                <!-- Stats row -->
                <div class="grid grid-cols-3 gap-4">
                    <div class="rounded-2xl border border-slate-100 bg-white shadow-sm p-6 text-center">
                        <p class="text-3xl font-bold text-orange-600">{{ $totalOrders }}</p>
                        <p class="text-xs font-semibold text-slate-500 mt-2 uppercase tracking-widest">Tổng đơn hàng</p>
                    </div>
                    <div class="rounded-2xl border border-slate-100 bg-white shadow-sm p-6 text-center">
                        <p class="text-3xl font-bold text-orange-600">{{ $completedOrders }}</p>
                        <p class="text-xs font-semibold text-slate-500 mt-2 uppercase tracking-widest">Đã hoàn thành</p>
                    </div>
                    <div class="rounded-2xl border border-slate-100 bg-white shadow-sm p-6 text-center">
                        <p class="text-3xl font-bold text-orange-600">{{ $totalSpent > 0 ? number_format($totalSpent/1000) . 'K' : '0K' }}</p>
                        <p class="text-xs font-semibold text-slate-500 mt-2 uppercase tracking-widest">Tổng chi tiêu</p>
                    </div>
                </div>

                <!-- Account Info -->
                <div class="rounded-2xl border border-slate-100 bg-white shadow-sm p-6">
                    <h3 class="text-base font-bold text-slate-900 mb-6 flex items-center gap-2">
                        <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="text-orange-600">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Thông tin tài khoản
                    </h3>
                    
                    <div class="space-y-4">
                        <div class="flex flex-col sm:flex-row sm:items-center py-3 border-b border-slate-50">
                            <span class="text-xs font-semibold text-slate-500 w-32 uppercase tracking-wider mb-1 sm:mb-0">Họ và tên</span>
                            <span class="text-sm font-medium text-slate-900">{{ auth()->user()->name }}</span>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:items-center py-3 border-b border-slate-50">
                            <span class="text-xs font-semibold text-slate-500 w-32 uppercase tracking-wider mb-1 sm:mb-0">Email</span>
                            <span class="text-sm font-medium text-slate-900">{{ auth()->user()->email }}</span>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:items-center py-3 border-b border-slate-50">
                            <span class="text-xs font-semibold text-slate-500 w-32 uppercase tracking-wider mb-1 sm:mb-0">Vai trò</span>
                            <span class="inline-block rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600 uppercase tracking-widest">{{ auth()->user()->role }}</span>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:items-center py-3">
                            <span class="text-xs font-semibold text-slate-500 w-32 uppercase tracking-wider mb-1 sm:mb-0">Ngày tham gia</span>
                            <span class="text-sm font-medium text-slate-900">
                                {{ \Carbon\Carbon::parse(auth()->user()->created_at ?? now())->format('d/m/Y') }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Order History -->
                <div class="rounded-2xl border border-slate-100 bg-white shadow-sm p-6">
                    <h3 class="text-base font-bold text-slate-900 mb-6 flex items-center gap-2">
                        <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="text-orange-600">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        Lịch sử đơn hàng
                    </h3>

                    @if($orders->count() > 0)
                        <div class="space-y-4">
                            @foreach($orders as $order)
                                <div class="rounded-xl border border-slate-100 p-4 hover:border-orange-100 transition duration-200">
                                    <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4">
                                        <div>
                                            <p class="text-sm font-bold text-slate-900">Đơn hàng #{{ $order->order_id }}</p>
                                            <p class="text-xs text-slate-500 mt-1">{{ \Carbon\Carbon::parse($order->order_date)->format('d/m/Y H:i') }}</p>
                                        </div>
                                        <div class="flex items-center gap-4 text-right">
                                            <div>
                                                <p class="text-sm font-bold text-orange-600">{{ number_format($order->total_amount) }} ₫</p>
                                            </div>
                                            <div class="px-3 py-1 rounded-full text-xs font-semibold
                                                {{ $order->status === 'completed' ? 'bg-emerald-100 text-emerald-700' : '' }}
                                                {{ $order->status === 'pending' ? 'bg-amber-100 text-amber-700' : '' }}
                                                {{ $order->status === 'cancelled' ? 'bg-rose-100 text-rose-700' : '' }}
                                                {{ in_array($order->status, ['confirmed', 'shipping']) ? 'bg-blue-100 text-blue-700' : '' }}
                                            ">
                                                {{ ucfirst($order->status) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="py-12 text-center text-slate-400">
                            <svg width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="mx-auto mb-4 opacity-50">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            <p class="text-sm">Bạn chưa có đơn hàng nào</p>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-layouts.app>
