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
                        <p class="text-2xl font-bold text-orange-600 truncate" title="{{ number_format($totalSpent) }} ₫">
                            {{ $totalSpent > 0 ? number_format($totalSpent) . ' ₫' : '0 ₫' }}
                        </p>
                        <p class="text-xs font-semibold text-slate-500 mt-3 uppercase tracking-widest">Tổng chi tiêu</p>
                    </div>
                </div>

                <!-- Account Info -->
                <div class="rounded-2xl border border-slate-100 bg-white shadow-sm p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-base font-bold text-slate-900 flex items-center gap-2">
                            <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="text-orange-600">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Thông tin tài khoản
                        </h3>
                        <button onclick="toggleEditProfile()" id="btn-edit-profile" class="text-xs font-bold text-orange-600 hover:text-orange-700 bg-orange-50 hover:bg-orange-100 px-3.5 py-2 rounded-xl transition duration-150 flex items-center gap-1">
                            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            <span>Sửa thông tin</span>
                        </button>
                    </div>
                    
                    <!-- View Mode -->
                    <div id="profile-view-mode" class="space-y-4">
                        <div class="flex flex-col sm:flex-row sm:items-center py-3 border-b border-slate-50">
                            <span class="text-xs font-semibold text-slate-500 w-32 uppercase tracking-wider mb-1 sm:mb-0">Họ và tên</span>
                            <span class="text-sm font-medium text-slate-900">{{ auth()->user()->name }}</span>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:items-center py-3 border-b border-slate-50">
                            <span class="text-xs font-semibold text-slate-500 w-32 uppercase tracking-wider mb-1 sm:mb-0">Email</span>
                            <span class="text-sm font-medium text-slate-900">{{ auth()->user()->email }}</span>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:items-center py-3 border-b border-slate-50">
                            <span class="text-xs font-semibold text-slate-500 w-32 uppercase tracking-wider mb-1 sm:mb-0">Số điện thoại</span>
                            <span class="text-sm font-medium text-slate-900">{{ auth()->user()->phone_number ?? auth()->user()->sdt ?? 'Chưa cập nhật' }}</span>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:items-center py-3 border-b border-slate-50">
                            <span class="text-xs font-semibold text-slate-500 w-32 uppercase tracking-wider mb-1 sm:mb-0">Vai trò</span>
                            <span class="inline-block rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600 uppercase tracking-widest">{{ auth()->user()->role }}</span>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:items-center py-3">
                            <span class="text-xs font-semibold text-slate-500 w-32 uppercase tracking-wider mb-1 sm:mb-0">Ngày sinh</span>
                            <span class="text-sm font-medium text-slate-900">
                                {{ auth()->user()->ngay_sinh ? auth()->user()->ngay_sinh->format('d/m/Y') : 'Chưa cập nhật' }}
                            </span>
                        </div>
                    </div>

                    <!-- Edit Mode -->
                    <form id="profile-edit-mode" action="{{ route('profile.update') }}" method="POST" class="hidden space-y-4" autocomplete="off">
                        @csrf
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Họ và tên</label>
                            <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Địa chỉ email</label>
                            <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Số điện thoại</label>
                            <input type="text" name="phone_number" value="{{ old('phone_number', auth()->user()->phone_number ?? auth()->user()->sdt) }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Ngày sinh</label>
                            <input type="date" name="ngay_sinh" value="{{ old('ngay_sinh', auth()->user()->ngay_sinh ? auth()->user()->ngay_sinh->format('Y-m-d') : '') }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10">
                        </div>
                        <div class="border-t border-slate-100 pt-4">
                            <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider mb-3">Thay đổi mật khẩu (Không bắt buộc)</h4>
                            <div class="grid gap-4 sm:grid-cols-2">
                                <div>
                                    <label class="block text-xs font-medium text-slate-500 mb-1.5">Mật khẩu mới</label>
                                    <input type="password" name="password" autocomplete="new-password" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-slate-500 mb-1.5">Xác nhận mật khẩu mới</label>
                                    <input type="password" name="password_confirmation" autocomplete="new-password" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10">
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-50">
                            <button type="button" onclick="toggleEditProfile()" class="rounded-xl border border-slate-200 px-5 py-2.5 text-sm font-semibold text-slate-600 hover:bg-slate-50 transition">Hủy</button>
                            <button type="submit" class="rounded-xl bg-orange-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-orange-700 transition shadow-md shadow-orange-600/10">Lưu thay đổi</button>
                        </div>
                    </form>
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
                                <div class="rounded-xl border border-slate-100 p-5 hover:border-orange-100 transition duration-200">
                                    <div class="flex flex-col sm:flex-row justify-between sm:items-start md:items-center gap-4">
                                        <div class="space-y-1">
                                            <p class="text-sm font-bold text-slate-900">
                                                {{ $order->name_order ?? ('Đơn hàng #' . $order->order_id) }}
                                            </p>
                                            <div class="flex flex-wrap items-center gap-x-2 gap-y-1 text-xs text-slate-500">
                                                <span class="font-semibold text-slate-700">Mã đơn: #{{ $order->order_id }}</span>
                                                <span class="text-slate-300">•</span>
                                                <span>{{ \Carbon\Carbon::parse($order->order_date)->format('d/m/Y H:i') }}</span>
                                            </div>
                                        </div>
                                        <div class="flex items-center justify-between sm:justify-end gap-6 w-full sm:w-auto">
                                            <div class="text-left sm:text-right">
                                                <p class="text-sm font-extrabold text-orange-600">{{ number_format($order->total_amount) }} ₫</p>
                                                <button type="button" onclick="toggleOrderDetails({{ $order->order_id }})" class="mt-1 text-xs font-semibold text-emerald-600 hover:text-emerald-700 transition flex items-center gap-0.5">
                                                    <span>Xem chi tiết</span>
                                                    <svg id="arrow-{{ $order->order_id }}" class="w-3.5 h-3.5 transform transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="px-3 py-1 rounded-full text-xs font-semibold
                                                {{ $order->status === 'completed' ? 'bg-emerald-100 text-emerald-700' : '' }}
                                                {{ $order->status === 'pending' ? 'bg-amber-100 text-amber-700' : '' }}
                                                {{ $order->status === 'cancelled' ? 'bg-rose-100 text-rose-700' : '' }}
                                                {{ in_array($order->status, ['confirmed', 'shipping']) ? 'bg-blue-100 text-blue-700' : '' }}
                                            ">
                                                {{ $order->status_label }}
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Collapsible Order Details -->
                                    <div id="details-{{ $order->order_id }}" class="hidden border-t border-slate-100 mt-4 pt-4 space-y-4">
                                        <!-- Books List -->
                                        <div class="space-y-3">
                                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Sản phẩm đã mua</p>
                                            @foreach($order->items as $item)
                                                <div class="flex items-center gap-4 rounded-xl bg-slate-50/50 p-2.5 border border-slate-100/50">
                                                    <img src="{{ $item->book?->image_url ?? asset('img/books/placeholder.png') }}" alt="{{ $item->product_name_snapshot }}" class="h-14 w-10 object-contain rounded bg-white p-0.5 border border-slate-100">
                                                    <div class="min-w-0 flex-1">
                                                        <p class="text-sm font-semibold text-slate-800 line-clamp-1" title="{{ $item->product_name_snapshot }}">{{ $item->product_name_snapshot }}</p>
                                                        <p class="text-xs text-slate-500 mt-0.5">Số lượng: <span class="font-bold text-slate-700">{{ $item->quantity }}</span> × {{ number_format($item->unit_price) }} ₫</p>
                                                    </div>
                                                    <div class="text-right">
                                                        <p class="text-sm font-extrabold text-slate-900">{{ number_format($item->subtotal) }} ₫</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        <!-- Delivery & Shipping snapshot Info -->
                                        <div class="grid gap-4 md:grid-cols-2 pt-2">
                                            <!-- Shipping Details -->
                                            <div class="rounded-xl border border-slate-100 bg-slate-50/20 p-4 space-y-2">
                                                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-3">Thông tin nhận hàng</p>
                                                <div class="text-xs text-slate-600 space-y-1.5">
                                                    <div class="flex"><span class="w-24 text-slate-400 font-medium flex-shrink-0">Người nhận:</span> <span class="font-semibold text-slate-800">{{ $order->recipient_name_snapshot }}</span></div>
                                                    <div class="flex"><span class="w-24 text-slate-400 font-medium flex-shrink-0">Điện thoại:</span> <span class="font-semibold text-slate-800">{{ $order->phone_number_snapshot }}</span></div>
                                                    <div class="flex"><span class="w-24 text-slate-400 font-medium flex-shrink-0">Địa chỉ:</span> <span class="font-medium text-slate-800">{{ $order->full_address_snapshot }}</span></div>
                                                </div>
                                            </div>
                                            <!-- Payment Summary -->
                                            <div class="rounded-xl border border-slate-100 bg-slate-50/20 p-4 flex flex-col justify-between">
                                                <div>
                                                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-3">Tóm tắt đơn hàng</p>
                                                    <div class="text-xs text-slate-600 space-y-1.5">
                                                        <div class="flex justify-between"><span>Tạm tính:</span> <span class="font-semibold text-slate-800">{{ number_format($order->total_amount + $order->discount_amount - $order->shipping_fee) }} ₫</span></div>
                                                        @if($order->shipping_fee > 0)
                                                            <div class="flex justify-between"><span>Phí vận chuyển:</span> <span class="font-semibold text-slate-800">+{{ number_format($order->shipping_fee) }} ₫</span></div>
                                                        @endif
                                                        @if($order->discount_amount > 0)
                                                            <div class="flex justify-between text-emerald-600 font-medium"><span>Giảm giá:</span> <span>-{{ number_format($order->discount_amount) }} ₫</span></div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="border-t border-slate-100 pt-3 mt-3 flex justify-between items-center">
                                                    <span class="text-xs font-bold text-slate-700">Tổng thanh toán:</span>
                                                    <span class="text-base font-black text-orange-600">{{ number_format($order->total_amount) }} ₫</span>
                                                </div>
                                            </div>
                                        </div>
                                        @if($order->notes)
                                            <div class="rounded-xl bg-amber-50/40 border border-amber-100/50 p-3 text-xs text-amber-800 flex gap-2">
                                                <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                                </svg>
                                                <div>
                                                    <span class="font-bold">Ghi chú:</span> {{ $order->notes }}
                                                </div>
                                            </div>
                                        @endif
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

    <!-- Toggle scripts -->
    <script>
        function toggleEditProfile() {
            const viewMode = document.getElementById('profile-view-mode');
            const editMode = document.getElementById('profile-edit-mode');
            const btnText = document.querySelector('#btn-edit-profile span');

            if (editMode.classList.contains('hidden')) {
                viewMode.classList.add('hidden');
                editMode.classList.remove('hidden');
                btnText.textContent = 'Quay lại';
            } else {
                viewMode.classList.remove('hidden');
                editMode.classList.add('hidden');
                btnText.textContent = 'Sửa thông tin';
            }
        }

        function toggleOrderDetails(orderId) {
            const details = document.getElementById('details-' + orderId);
            const arrow = document.getElementById('arrow-' + orderId);

            if (details.classList.contains('hidden')) {
                details.classList.remove('hidden');
                arrow.classList.add('rotate-180');
            } else {
                details.classList.add('hidden');
                arrow.classList.remove('rotate-180');
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            @if($errors->any() && (old('name') !== null || old('email') !== null))
                toggleEditProfile();
            @endif
        });
    </script>
</x-layouts.app>
