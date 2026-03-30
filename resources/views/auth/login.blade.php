<x-guest-layout>
    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-blue-600 text-white shadow-lg shadow-blue-600/30 mb-4">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
        </div>
        <h2 class="text-3xl font-bold text-slate-800">Welcome Back</h2>
        <p class="text-slate-500 mt-2">Log in to your dashboard</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <div class="flex p-1 bg-white/50 border border-slate-200/60 rounded-xl mb-6 shadow-inner">
            <label class="flex-1 text-center cursor-pointer">
                <input type="radio" name="login_role" value="student" class="peer hidden" checked>
                <div class="py-2 px-4 rounded-lg peer-checked:bg-white peer-checked:shadow-[0_4px_12px_rgba(0,0,0,0.05)] peer-checked:text-blue-600 text-slate-500 font-semibold transition-all">
                    Student
                </div>
            </label>
            <label class="flex-1 text-center cursor-pointer">
                <input type="radio" name="login_role" value="admin" class="peer hidden">
                <div class="py-2 px-4 rounded-lg peer-checked:bg-white peer-checked:shadow-[0_4px_12px_rgba(0,0,0,0.05)] peer-checked:text-blue-600 text-slate-500 font-semibold transition-all">
                    Admin
                </div>
            </label>
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-slate-700 mb-1">College Email</label>
            <input id="email" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white/50 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all shadow-sm" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
        </div>

        <div>
            <div class="flex justify-between items-center mb-1">
                <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-xs text-blue-600 hover:underline font-medium">Forgot password?</a>
                @endif
            </div>
            <input id="password" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white/50 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all shadow-sm"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
        </div>

        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500 h-4 w-4" name="remember">
                <span class="ms-2 text-sm text-slate-600">Remember me</span>
            </label>
        </div>

        <div>
            <button type="submit" class="w-full py-3 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl shadow-[0_10px_20px_-10px_rgba(37,99,235,0.5)] transition-all">
                Sign In
            </button>
        </div>
        
        <div class="text-center mt-6">
            <p class="text-sm text-slate-500">
                Don't have an account? 
                <a href="{{ route('register') }}" class="text-blue-600 font-semibold hover:underline">Create one</a>
            </p>
        </div>
    </form>
</x-guest-layout>
