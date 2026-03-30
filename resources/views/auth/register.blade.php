<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-slate-800">Create an Account</h2>
        <p class="text-slate-500 mt-2">Join the campus event network</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="flex p-1 bg-white/50 border border-slate-200/60 rounded-xl mb-6 shadow-inner">
            <label class="flex-1 text-center cursor-pointer">
                <input type="radio" name="role" value="student" class="peer hidden" checked {{ old('role') === 'student' ? 'checked' : '' }}>
                <div class="py-2 px-4 rounded-lg peer-checked:bg-white peer-checked:shadow-[0_4px_12px_rgba(0,0,0,0.05)] peer-checked:text-blue-600 text-slate-500 font-semibold transition-all">
                    Student
                </div>
            </label>
            <label class="flex-1 text-center cursor-pointer">
                <input type="radio" name="role" value="admin" class="peer hidden" {{ old('role') === 'admin' ? 'checked' : '' }}>
                <div class="py-2 px-4 rounded-lg peer-checked:bg-white peer-checked:shadow-[0_4px_12px_rgba(0,0,0,0.05)] peer-checked:text-blue-600 text-slate-500 font-semibold transition-all">
                    Admin
                </div>
            </label>
        </div>
        <x-input-error :messages="$errors->get('role')" class="mb-4 text-red-500 text-sm" />

        <div class="mb-5">
            <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Full Name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white/50 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all shadow-sm">
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500 text-sm" />
        </div>

        <div class="mb-5">
            <label for="email" class="block text-sm font-medium text-slate-700 mb-1">College Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white/50 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all shadow-sm">
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
        </div>

        <div class="mb-5">
            <label for="department_id" class="block text-sm font-medium text-slate-700 mb-1">Department</label>
            <select id="department_id" name="department_id" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white/50 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all shadow-sm appearance-none cursor-pointer">
                <option value="" disabled {{ old('department_id') ? '' : 'selected' }}>Select your department</option>
                @foreach($departments as $dept)
                    <option value="{{ $dept->id }}" {{ old('department_id') == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('department_id')" class="mt-2 text-red-500 text-sm" />
        </div>

        <div class="mb-5">
            <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Password</label>
            <input id="password" type="password" name="password" required autocomplete="new-password" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white/50 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all shadow-sm">
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
        </div>

        <div class="mb-8">
            <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-1">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white/50 focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all shadow-sm">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500 text-sm" />
        </div>

        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-[0_10px_20px_-10px_rgba(37,99,235,0.5)] text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
            Register Now
        </button>

        <p class="text-center text-sm text-slate-500 mt-6">
            Already have an account? <a href="{{ route('login') }}" class="text-blue-600 font-semibold hover:underline">Log in</a>
        </p>
    </form>
</x-guest-layout>
