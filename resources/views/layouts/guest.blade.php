<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Campus Events') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-800 antialiased bg-slate-50 relative overflow-x-hidden">
        
        <!-- Decorative Background -->
        <div class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] rounded-full bg-blue-100/60 blur-3xl pointer-events-none z-0"></div>
        <div class="absolute bottom-[-10%] right-[-5%] w-[600px] h-[600px] rounded-full bg-indigo-50/60 blur-3xl pointer-events-none z-0"></div>

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative z-10">
            <div class="mb-8">
                <a href="/" class="flex flex-col items-center gap-3 hover:opacity-80 transition-opacity">
                    <div class="w-16 h-16 bg-white rounded-2xl shadow-sm border border-slate-100 flex items-center justify-center text-blue-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <span class="font-bold text-2xl text-slate-900 tracking-tight">Planova</span>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-2 px-8 py-10 bg-white/80 backdrop-blur-xl shadow-[0_20px_40px_-15px_rgba(0,0,0,0.05)] border border-white rounded-[2rem]">
                {{ $slot }}
            </div>
            
            <div class="mt-8 text-sm text-slate-500">
                &copy; {{ date('Y') }} Planova.
            </div>
        </div>
    </body>
</html>
