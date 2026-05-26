<?php
$login = <<<'EOF'
@php($title = 'Đăng nhập')
<x-layouts.app :title="$title">
    <div class="flex items-center justify-center px-4 py-16 sm:py-24 bg-rose-50/30">
        <div class="mx-auto w-full max-w-md rounded-[2rem] border border-orange-100 bg-white p-8 sm:p-10 shadow-[0_8px_30px_rgba(234,88,12,0.04)]">
            
            <div class="text-center mb-10">
                <div class="mx-auto h-16 w-16 bg-orange-100 rounded-2xl flex items-center justify-center mb-6 text-orange-600">
                    <svg width="32" height="32" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-slate-900 mb-2">Đăng nhập</h1>
                <p class="text-sm text-slate-500">Chào mừng trở lại Mono Coffee House</p>
            </div>

            @if($errors->any())
                <div class="mb-6 rounded-xl border border-rose-100 bg-rose-50 p-4 text-sm text-rose-700">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5" novalidate>
                @csrf
                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-slate-500">Địa chỉ email</label>
                    <input name="email" value="{{ old('email') }}" type="email" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3.5 text-sm outline-none transition-all placeholder:text-slate-400 focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10" placeholder="user@example.com">
                </div>
                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-slate-500">Mật khẩu</label>
                    <input name="password" type="password" aria-label="Password" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3.5 text-sm outline-none transition-all placeholder:text-slate-400 focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10" placeholder="••••••••">
                </div>
                
                <div class="flex items-center">
                    <label class="flex items-center gap-3 text-sm font-bold text-slate-900 cursor-pointer">
                        <input type="checkbox" name="remember" value="1" class="h-5 w-5 rounded border-slate-300 text-orange-600 focus:ring-orange-500 focus:ring-offset-0">
                        GHI NHỚ ĐĂNG NHẬP
                    </label>
                </div>
                
                <button type="submit" class="mt-2 w-full rounded-xl bg-[#c2410c] px-4 py-3.5 text-sm font-bold text-white transition hover:bg-[#9a3412] active:scale-[0.98]">Đăng nhập</button>
            </form>

            <div class="mt-8 relative">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t border-slate-100"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="bg-white px-4 text-slate-400">hoặc</span>
                </div>
            </div>

            <div class="mt-6 text-center text-sm text-slate-500">
                Chưa có tài khoản? <a href="{{ route('register.form') }}" class="font-bold text-[#c2410c] hover:underline">Đăng ký ngay</a>
            </div>
        </div>
    </div>
</x-layouts.app>
EOF;

$register = <<<'EOF'
@php($title = 'Tạo tài khoản')
<x-layouts.app :title="$title">
    <div class="flex items-center justify-center px-4 py-16 sm:py-24 bg-rose-50/30">
        <div class="mx-auto w-full max-w-md rounded-[2rem] border border-orange-100 bg-white p-8 sm:p-10 shadow-[0_8px_30px_rgba(234,88,12,0.04)]">
            
            <div class="text-center mb-10">
                <div class="mx-auto h-16 w-16 bg-orange-100 rounded-2xl flex items-center justify-center mb-6 text-orange-600">
                    <svg width="32" height="32" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-slate-900 mb-2">Tạo tài khoản</h1>
                <p class="text-sm text-slate-500">Đăng ký để trải nghiệm đặt hàng dễ dàng hơn</p>
            </div>

            @if($errors->any())
                <div class="mb-6 rounded-xl border border-rose-100 bg-rose-50 p-4 text-sm text-rose-700">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-4" novalidate>
                @csrf
                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-slate-500">Họ và tên</label>
                    <input name="name" value="{{ old('name') }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3.5 text-sm outline-none transition-all placeholder:text-slate-400 focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10" required>
                </div>
                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-slate-500">Địa chỉ email</label>
                    <input name="email" type="email" value="{{ old('email') }}" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3.5 text-sm outline-none transition-all placeholder:text-slate-400 focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10" required>
                </div>
                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-slate-500">Mật khẩu</label>
                    <input name="password" type="password" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3.5 text-sm outline-none transition-all placeholder:text-slate-400 focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10" required>
                </div>
                <div>
                    <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-slate-500">Xác nhận mật khẩu</label>
                    <input name="password_confirmation" type="password" class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3.5 text-sm outline-none transition-all placeholder:text-slate-400 focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10" required>
                </div>
                
                <input type="hidden" name="agree_terms" value="on">

                <button type="submit" class="mt-4 w-full rounded-xl bg-[#c2410c] px-4 py-3.5 text-sm font-bold text-white transition hover:bg-[#9a3412] active:scale-[0.98]">Tạo tài khoản</button>
            </form>

            <div class="mt-8 relative">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t border-slate-100"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="bg-white px-4 text-slate-400">hoặc</span>
                </div>
            </div>

            <div class="mt-6 text-center text-sm text-slate-500">
                Đã có tài khoản? <a href="{{ route('login.form') }}" class="font-bold text-[#c2410c] hover:underline">Đăng nhập ngay</a>
            </div>
        </div>
    </div>
</x-layouts.app>
EOF;

file_put_contents(__DIR__ . '/resources/views/auth/login.blade.php', $login);
file_put_contents(__DIR__ . '/resources/views/auth/register.blade.php', $register);
echo "Fix applied.";
?>