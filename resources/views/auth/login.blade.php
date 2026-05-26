@php($title = 'Đăng nhập')
<x-layouts.app :title="$title">
    <div class="flex items-center justify-center px-4 py-16 sm:py-24 bg-gradient-to-tr from-emerald-50/20 via-slate-50 to-emerald-50/10">
        <div class="mx-auto w-full max-w-md rounded-[2.5rem] border border-slate-100 bg-white p-8 sm:p-12 shadow-[0_8px_30px_rgba(16,185,129,0.03)] transition-all">
            
            <div class="text-center mb-10 flex flex-col items-center">
                <div class="h-16 w-16 bg-emerald-50/80 rounded-2xl flex items-center justify-center mb-6 text-emerald-600 shadow-inner border border-emerald-100/50">
                    <!-- Elegant SVG Book Icon representing NewChapter -->
                    <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"/>
                        <path d="M6 6h10"/>
                        <path d="M6 10h10"/>
                        <path d="M6 14h10"/>
                    </svg>
                </div>
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight mb-2">Đăng nhập</h1>
                <p class="text-sm font-medium text-slate-500">Chào mừng trở lại {{ config('shop.name', 'NewChapter') }}</p>
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

            <form method="POST" action="{{ route('login') }}" class="space-y-6" novalidate>
                @csrf
                <div>
                    <label class="mb-2.5 block text-[11px] font-bold uppercase tracking-widest text-slate-400">Địa chỉ email</label>
                    <input name="email" value="{{ old('email') }}" type="email" class="w-full rounded-2xl border border-slate-200 bg-white px-5 py-4 text-sm outline-none transition-all placeholder:text-slate-400 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10">
                </div>
                <div>
                    <label class="mb-2.5 block text-[11px] font-bold uppercase tracking-widest text-slate-400">Mật khẩu</label>
                    <input name="password" type="password" aria-label="Password" class="w-full rounded-2xl border border-slate-200 bg-white px-5 py-4 text-sm outline-none transition-all placeholder:text-slate-400 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10">
                </div>
                
                <div class="flex items-center">
                    <label class="flex items-center gap-3.5 text-xs font-bold uppercase tracking-wider text-slate-700 cursor-pointer select-none">
                        <input type="checkbox" name="remember" value="1" class="h-5 w-5 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500 focus:ring-offset-0 transition">
                        Ghi nhớ đăng nhập
                    </label>
                </div>
                
                <button type="submit" class="mt-4 w-full rounded-2xl bg-emerald-600 px-5 py-4 text-sm font-bold text-white transition-all shadow-lg shadow-emerald-600/15 hover:bg-emerald-700 hover:shadow-emerald-600/20 active:scale-[0.98]">Đăng nhập</button>
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
                Chưa có tài khoản? <a href="{{ route('register.form') }}" class="font-bold text-emerald-600 hover:text-emerald-700 hover:underline transition">Đăng ký ngay</a>
            </div>
        </div>
    </div>
</x-layouts.app>
