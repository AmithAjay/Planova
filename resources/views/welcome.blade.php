<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Planova | The Ultimate College Event Platform</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .glass-nav {
            background: rgba(255, 255, 255, 0.65);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
            transform: translateY(30px);
        }
        .delay-100 { animation-delay: 100ms; }
        .delay-200 { animation-delay: 200ms; }
        .delay-300 { animation-delay: 300ms; }
        
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .blob-bg {
            animation: blobBounce 20s infinite alternate cubic-bezier(0.4, 0, 0.2, 1);
            transform-origin: center;
        }
        @keyframes blobBounce {
            0% { transform: scale(1) translate(0px, 0px); }
            33% { transform: scale(1.1) translate(30px, -50px); }
            66% { transform: scale(0.9) translate(-20px, 20px); }
            100% { transform: scale(1.05) translate(0px, 0px); }
        }
        
        .hero-img-hover {
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .hero-img-hover:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 30px 60px -15px rgba(59, 130, 246, 0.4);
        }
        .animate-gradient-x {
            background-size: 200% auto;
            animation: gradientX 3s linear infinite;
        }
        @keyframes gradientX {
            0% { background-position: 0% center; }
            50% { background-position: 100% center; }
            100% { background-position: 0% center; }
        }
    </style>
</head>
<body class="font-sans antialiased text-slate-800 bg-[#F8FAFC] selection:bg-blue-600 selection:text-white relative overflow-x-hidden">

    <!-- Ambient background glows -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        <div class="blob-bg absolute -top-[20%] -left-[10%] w-[600px] h-[600px] rounded-full bg-blue-300/20 blur-[100px]"></div>
        <div class="blob-bg absolute top-[20%] -right-[10%] w-[500px] h-[500px] rounded-full bg-purple-300/20 blur-[100px]" style="animation-delay: -5s;"></div>
        <div class="blob-bg absolute -bottom-[20%] left-[20%] w-[700px] h-[700px] rounded-full bg-cyan-300/20 blur-[120px]" style="animation-delay: -10s;"></div>
    </div>

    <!-- Navigation -->
    <nav class="glass-nav sticky top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex-shrink-0 flex items-center gap-3 group translate-y-0 transition-transform hover:-translate-y-0.5">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-blue-600/30 group-hover:shadow-blue-600/50 transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <span class="font-extrabold text-2xl bg-clip-text text-transparent bg-gradient-to-r from-slate-900 to-slate-700 tracking-tight">Planova</span>
                </div>
                <div class="hidden md:flex space-x-10 items-center">
                    <a href="#features" class="font-semibold text-slate-600 hover:text-blue-600 transition-colors relative after:absolute after:bottom-0 after:left-0 after:h-0.5 after:w-0 hover:after:w-full after:bg-blue-600 after:transition-all after:duration-300">Features</a>
                    <a href="#about" class="font-semibold text-slate-600 hover:text-blue-600 transition-colors relative after:absolute after:bottom-0 after:left-0 after:h-0.5 after:w-0 hover:after:w-full after:bg-blue-600 after:transition-all after:duration-300">About Us</a>
                    <a href="#help" class="font-semibold text-slate-600 hover:text-blue-600 transition-colors relative after:absolute after:bottom-0 after:left-0 after:h-0.5 after:w-0 hover:after:w-full after:bg-blue-600 after:transition-all after:duration-300">Help</a>
                    
                    @if (Route::has('login'))
                        <div class="flex items-center gap-5 pl-8 border-l-2 border-slate-200/50">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="font-bold text-blue-600 hover:text-blue-700 transition">Go to Dashboard &rarr;</a>
                            @else
                                <a href="{{ route('login') }}" class="font-bold text-slate-600 hover:text-slate-900 transition">Log in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl font-bold hover:from-blue-700 hover:to-indigo-700 transition-all shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50 hover:-translate-y-0.5">Get Started Free</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative pt-24 pb-32 z-10 min-h-[85vh] flex flex-col justify-center items-center">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center flex flex-col items-center">
            <div class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-white/70 border border-white shadow-sm backdrop-blur-md mb-8 animate-fade-in-up text-sm font-bold text-blue-800">
                <span class="flex h-2.5 w-2.5 relative">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-500 opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-blue-600"></span>
                </span>
                Planova is now live for your campus!
            </div>
            
            <h1 class="text-6xl md:text-8xl font-black tracking-tight text-slate-900 mb-8 animate-fade-in-up delay-100 leading-[1.05]">
                Revolutionize Campus Events at <br class="hidden md:block"/>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 via-indigo-500 to-blue-600 animate-gradient-x">Rajagiri College</span>
            </h1>
            
            <p class="mt-4 max-w-2xl mx-auto text-xl text-slate-600 mb-12 animate-fade-in-up delay-200 font-medium leading-relaxed">
                The smart platform to discover, register, and seamlessly manage college events. Never miss out on tech fests, cultural nights, or symposiums again.
            </p>
            
            <div class="flex flex-col sm:flex-row justify-center gap-5 animate-fade-in-up delay-300 w-full sm:w-auto">
                <a href="{{ route('register') }}" class="px-8 py-4 bg-slate-900 text-white rounded-2xl font-bold text-lg hover:bg-slate-800 transition-all shadow-2xl shadow-slate-900/30 hover:shadow-slate-900/50 hover:-translate-y-1 flex items-center justify-center gap-2 group">
                    Start Exploring Events
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
                <a href="#features" class="px-8 py-4 bg-white/80 backdrop-blur-md text-slate-800 border-2 border-slate-200/60 rounded-2xl font-bold text-lg hover:bg-white transition-all shadow-md hover:shadow-xl hover:-translate-y-1 flex items-center justify-center">
                    See How It Works
                </a>
            </div>
        </div>
        
        <!-- Scrolling abstract indicators -->
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 animate-bounce opacity-60">
            <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-24 relative z-10 bg-white/50 backdrop-blur-md border border-white/60 mx-4 max-w-7xl lg:mx-auto rounded-[3rem] shadow-2xl shadow-slate-200/40">
        <div class="px-4 sm:px-8 lg:px-12">
            <div class="text-center mb-20">
                <h2 class="text-blue-600 font-bold tracking-widest uppercase text-sm mb-4">Powering Your Campus</h2>
                <h3 class="text-4xl md:text-5xl font-black text-slate-900">Features that make a difference</h3>
                <p class="mt-6 text-xl text-slate-600 max-w-2xl mx-auto font-medium">Everything organizers need to host spectacular events, and everything students need to not miss a thing.</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8 relative">
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-40 bg-gradient-to-r from-blue-200/30 via-purple-200/30 to-blue-200/30 blur-3xl rounded-full pointer-events-none -z-10"></div>
                
                <div class="group p-10 rounded-[2.5rem] bg-white border-2 border-slate-100 shadow-xl shadow-slate-200/30 hover:shadow-2xl hover:shadow-blue-500/15 hover:-translate-y-2 transition-all duration-400">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-50 to-blue-100 text-blue-600 rounded-2xl flex items-center justify-center mb-8 group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300 border border-blue-200/50 shadow-md shadow-blue-100">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                    </div>
                    <h4 class="text-2xl font-black text-slate-900 mb-4">1-Click Ticketing</h4>
                    <p class="text-slate-500 leading-relaxed font-semibold text-lg">Say goodbye to confusing forms. Register for any campus event instantly and keep track of everything in a beautiful dashboard.</p>
                </div>
                
                <div class="group p-10 rounded-[2.5rem] bg-white border-2 border-slate-100 shadow-xl shadow-slate-200/30 hover:shadow-2xl hover:shadow-indigo-500/15 hover:-translate-y-2 transition-all duration-400">
                    <div class="w-16 h-16 bg-gradient-to-br from-indigo-50 to-indigo-100 text-indigo-600 rounded-2xl flex items-center justify-center mb-8 group-hover:scale-110 group-hover:rotate-3 transition-transform duration-300 border border-indigo-200/50 shadow-md shadow-indigo-100">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h4 class="text-2xl font-black text-slate-900 mb-4">Smart Club Hub</h4>
                    <p class="text-slate-500 leading-relaxed font-semibold text-lg">Empower student councils to create stunning event pages, enforce department restrictions, and track participation seamlessly.</p>
                </div>
                
                <div class="group p-10 rounded-[2.5rem] bg-white border-2 border-slate-100 shadow-xl shadow-slate-200/30 hover:shadow-2xl hover:shadow-emerald-500/15 hover:-translate-y-2 transition-all duration-400">
                    <div class="w-16 h-16 bg-gradient-to-br from-emerald-50 to-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center mb-8 group-hover:scale-110 group-hover:-rotate-3 transition-transform duration-300 border border-emerald-200/50 shadow-md shadow-emerald-100">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    </div>
                    <h4 class="text-2xl font-black text-slate-900 mb-4">Instant Alerts</h4>
                    <p class="text-slate-500 leading-relaxed font-semibold text-lg">Never miss a venue change again. Get real-time notifications about schedule tweaks, new drops, and critical announcements.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section with Uploaded Image -->
    <section id="about" class="py-32 relative z-10 mt-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center gap-16 md:gap-24 relative">
                
                <div class="md:w-1/2 relative z-10 w-full">
                    <div class="absolute inset-0 bg-blue-600 blur-[80px] opacity-20 transform scale-90 -z-10 rounded-full"></div>
                    <div class="relative rounded-[2.5rem] overflow-hidden shadow-2xl hero-img-hover group ring-4 ring-white">
                        <div class="absolute inset-0 bg-blue-600/10 group-hover:bg-transparent transition-colors z-10 mix-blend-overlay duration-500"></div>
                        <img src="{{ asset('images/campus_events.png') }}" alt="Students happily participating in a vibrant campus event" class="w-full h-[450px] object-cover transform scale-105 group-hover:scale-100 transition-transform duration-700 ease-out" />
                    </div>
                </div>
                
                <div class="md:w-1/2 relative z-10">
                    <h2 class="text-indigo-600 font-bold tracking-widest uppercase text-sm mb-4">Built by students, for students</h2>
                    <h3 class="text-4xl md:text-6xl font-black text-slate-900 mb-8 leading-[1.1]">Empowering your college journey.</h3>
                    
                    <div class="space-y-6">
                        <p class="text-xl text-slate-600 font-medium leading-relaxed">
                            We vividly remember the chaos of tracking club events, department symposiums, and cultural fests. Important details were always lost in WhatsApp and emails formats.
                        </p>
                        <p class="text-xl text-slate-600 font-medium leading-relaxed">
                            Planova bridges the gap between passionate organizers and attendees. Our platform guarantees that every student extracts the maximum value out of their college years.
                        </p>
                    </div>
                    
                    <div class="mt-12">
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center gap-3 px-8 py-4 bg-blue-100 text-blue-700 font-bold text-lg hover:bg-blue-600 hover:text-white rounded-2xl transition-all group shadow-sm">
                            Join the Network
                            <svg class="w-6 h-6 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Support Section -->
    <section id="help" class="py-32 relative overflow-hidden z-10">
        <div class="absolute inset-0 bg-slate-950"></div>
        <div class="absolute inset-0 opacity-20 mix-blend-overlay" style="background-image: radial-gradient(circle at center, #3b82f6 1px, transparent 1px); background-size: 24px 24px;"></div>
        <div class="absolute top-0 transform left-1/2 -translate-x-1/2 w-full max-w-7xl h-px bg-gradient-to-r from-transparent via-blue-500/50 to-transparent"></div>
        
        <div class="max-w-4xl mx-auto px-4 relative z-10 text-center">
            <h2 class="text-5xl md:text-6xl font-black mb-8 text-white tracking-tight">Got questions? <br/><span class="text-blue-400">We're here for you.</span></h2>
            <p class="text-2xl text-slate-400 mb-12 font-medium max-w-3xl mx-auto">Whether you are an organizer architecting a fest or a student facing ticket issues, our support squad has your back.</p>
            
            <div class="flex flex-col sm:flex-row justify-center gap-6">
                <a href="mailto:support@collegeevents.edu" class="px-8 py-4 bg-blue-600 text-white rounded-2xl font-bold text-lg hover:bg-blue-500 transition-all shadow-xl shadow-blue-600/30 hover:-translate-y-1">Contact Support Team</a>
                <a href="#" class="px-8 py-4 bg-white/5 text-white border border-white/10 backdrop-blur-md rounded-2xl font-bold text-lg hover:bg-white/10 transition-all hover:-translate-y-1">Browse FAQ Archive</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black py-12 relative z-10 border-t border-white/10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center gap-8">
                <div class="flex items-center gap-3">
                    <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    <span class="font-black text-2xl text-white tracking-tight">Planova</span>
                </div>
                <div class="text-slate-400 font-medium text-lg">
                    &copy; {{ date('Y') }} Planova. All rights reserved.
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
