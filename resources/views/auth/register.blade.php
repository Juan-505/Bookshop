@php($title = 'Tạo tài khoản')
<x-layouts.app :title="$title">
    <div class="flex items-center justify-center px-4 py-16 sm:py-24 bg-gradient-to-tr from-emerald-50/20 via-slate-50 to-emerald-50/10">
        <div class="mx-auto w-full max-w-md rounded-[2.5rem] border border-slate-100 bg-white p-8 sm:p-12 shadow-[0_8px_30px_rgba(16,185,129,0.03)] transition-all">
            
            <div class="text-center mb-10 flex flex-col items-center">
                <div class="h-16 w-16 bg-emerald-50/80 rounded-2xl flex items-center justify-center mb-6 text-emerald-600 shadow-inner border border-emerald-100/50">
                    <!-- Elegant SVG User Add Icon -->
                    <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <line x1="19" y1="8" x2="19" y2="14"/>
                        <line x1="16" y1="11" x2="22" y2="11"/>
                    </svg>
                </div>
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight mb-2">Tạo tài khoản</h1>
                <p class="text-sm font-medium text-slate-500">Đăng ký để trải nghiệm đặt hàng dễ dàng hơn</p>
            </div>

            @if($errors->any())
                <div class="mb-6 rounded-2xl border border-rose-100 bg-rose-50/50 p-4 text-sm text-rose-700 shadow-sm">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-5" novalidate>
                @csrf
                <div>
                    <label class="mb-2 block text-[11px] font-bold uppercase tracking-widest text-slate-400">Họ và tên</label>
                    <input name="name" value="{{ old('name') }}" type="text" class="w-full rounded-2xl border border-slate-200 bg-white px-5 py-3.5 text-sm outline-none transition-all placeholder:text-slate-400 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10" required>
                </div>
                <div>
                    <label class="mb-2 block text-[11px] font-bold uppercase tracking-widest text-slate-400">Địa chỉ email</label>
                    <input name="email" value="{{ old('email') }}" type="email" class="w-full rounded-2xl border border-slate-200 bg-white px-5 py-3.5 text-sm outline-none transition-all placeholder:text-slate-400 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10" required>
                </div>
                <div>
                    <label class="mb-2 block text-[11px] font-bold uppercase tracking-widest text-slate-400">Mật khẩu</label>
                    <input name="password" type="password" class="w-full rounded-2xl border border-slate-200 bg-white px-5 py-3.5 text-sm outline-none transition-all placeholder:text-slate-400 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10" required>
                </div>
                <div>
                    <label class="mb-2 block text-[11px] font-bold uppercase tracking-widest text-slate-400">Xác nhận mật khẩu</label>
                    <input name="password_confirmation" type="password" class="w-full rounded-2xl border border-slate-200 bg-white px-5 py-3.5 text-sm outline-none transition-all placeholder:text-slate-400 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10" required>
                </div>
                
                <input type="hidden" name="agree_terms" value="on">

                <button type="submit" class="mt-6 w-full rounded-2xl bg-emerald-600 px-5 py-4 text-sm font-bold text-white transition-all shadow-lg shadow-emerald-600/15 hover:bg-emerald-700 hover:shadow-emerald-600/20 active:scale-[0.98]">Tạo tài khoản</button>
            </form>

            <div class="mt-8 relative">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t border-slate-100"></div>
                </div>
                <div class="relative flex justify-center text-xs uppercase font-semibold">
                    <span class="bg-white px-4 text-slate-400">hoặc</span>
                </div>
            </div>

            <div class="mt-6 text-center text-sm text-slate-500">
                Đã có tài khoản? <a href="{{ route('login') }}" class="font-bold text-emerald-600 hover:text-emerald-700 hover:underline transition">Đăng nhập ngay</a>
            </div>
        </div>
    </div>
</x-layouts.app>
