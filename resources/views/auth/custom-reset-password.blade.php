<x-guest-layout>
    <div class="min-h-screen py-10 flex flex-col items-center justify-center relative overflow-hidden">
        <!-- Decorative Background Glows -->
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-purple-500/10 rounded-full blur-[100px] pointer-events-none"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-blue-500/10 rounded-full blur-[100px] pointer-events-none"></div>

        <div class="w-full max-w-md relative z-10 px-4">
            <!-- Header Section -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-3xl bg-gradient-to-br from-blue-500 to-indigo-600 text-white shadow-xl shadow-blue-500/20 mb-4 animate-bounce-slow">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                <h1 class="text-4xl font-extrabold text-slate-800 tracking-tight mb-2">
                    Set New <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">Credentials</span>
                </h1>
                <p class="text-slate-500 font-medium">Resetting password for: <span class="text-slate-700 font-bold underline decoration-blue-200">{{ $request->email }}</span></p>
            </div>

            <!-- Glassmorphism Container -->
            <div class="bg-white/40 backdrop-blur-3xl border border-white/80 rounded-[2.5rem] shadow-[0_50px_100px_-20px_rgba(0,0,0,0.1)] p-10 overflow-hidden relative">
                <!-- Atmospheric light -->
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-blue-400/5 rounded-full blur-3xl pointer-events-none"></div>

                <form method="POST" action="{{ route('custom.password.update') }}" class="space-y-6 relative z-10">
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $token }}">

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 ml-1">Account Identity</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-300 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"></path></svg>
                            </div>
                            <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus readonly
                                class="block w-full pl-11 pr-4 py-4 bg-slate-50/50 border border-slate-100 rounded-2xl text-slate-400 font-medium focus:outline-none cursor-not-allowed shadow-inner transition-all duration-300 ring-0">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs font-bold text-red-500 pr-2" />
                    </div>

                    <!-- New Password -->
                    <div>
                        <label for="password" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 ml-1">New Security Protocol</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-300 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17.012l-2 2H5V16.5l4.757-4.757a6 6 0 011.243-7.743"></path></svg>
                            </div>
                            <input id="password" type="password" name="password" required autocomplete="new-password"
                                class="block w-full pl-11 pr-4 py-4 bg-white/80 border border-slate-200 rounded-2xl text-slate-800 placeholder-slate-300 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all duration-300 shadow-sm"
                                placeholder="New password">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs font-bold text-red-500 pr-2" />
                    </div>

                    <!-- Confirm New Password -->
                    <div>
                        <label for="password_confirmation" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 ml-1">Verify Protocol</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-300 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            </div>
                            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                                class="block w-full pl-11 pr-4 py-4 bg-white/80 border border-slate-200 rounded-2xl text-slate-800 placeholder-slate-300 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all duration-300 shadow-sm"
                                placeholder="Confirm password">
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-xs font-bold text-red-500 pr-2" />
                    </div>

                    <div class="pt-4 mt-2">
                        <button type="submit" class="group w-full py-4.5 bg-gradient-to-r from-blue-600 to-indigo-600 border-none text-white font-black rounded-2xl shadow-[0_20px_40px_-10px_rgba(59,130,246,0.4)] hover:shadow-[0_25px_50px_-12px_rgba(59,130,246,0.5)] active:scale-[0.98] transition-all duration-300 outline-none focus:ring-4 focus:ring-blue-500/30 uppercase text-xs tracking-[0.2em] flex items-center justify-center gap-3">
                            Execute Reset
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    </div>
                </form>
            </div>
            
            <p class="text-center mt-8 text-slate-400 text-xs font-bold uppercase tracking-widest flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Secure Terminal Connection active
            </p>
        </div>
    </div>
</x-guest-layout>
