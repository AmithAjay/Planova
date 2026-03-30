<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Planova | Event Management</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-slate-800 bg-slate-50 selection:bg-blue-500 selection:text-white">

    <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex-shrink-0 flex items-center gap-2">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    <span class="font-bold text-xl text-slate-900">Planova</span>
                </div>
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="#features" class="text-slate-600 hover:text-blue-600 transition">Features</a>
                    <a href="#about" class="text-slate-600 hover:text-blue-600 transition">About Us</a>
                    <a href="#help" class="text-slate-600 hover:text-blue-600 transition">Help & Contact</a>
                    
                    @if (Route::has('login'))
                        <div class="flex items-center gap-4 border-l pl-6 border-slate-200">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="font-medium text-blue-600 hover:text-blue-700">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="font-medium text-slate-600 hover:text-blue-600">Log in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition shadow-sm shadow-blue-600/20">Register</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <section class="relative pt-24 pb-32 overflow-hidden flex items-center justify-center min-h-[80vh]">
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 rounded-full bg-blue-100 blur-3xl opacity-50 pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative text-center">
            <h1 class="text-5xl md:text-6xl font-extrabold tracking-tight text-slate-900 mb-6">
                Elevate Campus Life <br class="hidden md:block"/> at <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">Rajagiri</span>
            </h1>
            <p class="mt-4 max-w-2xl mx-auto text-xl text-slate-600 mb-10">
                The all-in-one platform to discover, register, and manage college events. From tech fests to cultural nights, stay connected with what's happening.
            </p>
            <div class="flex justify-center gap-4">
                <a href="{{ route('register') }}" class="px-8 py-3 bg-blue-600 text-white rounded-xl font-semibold text-lg hover:bg-blue-700 transition shadow-lg shadow-blue-600/30">Get Started</a>
                <a href="#features" class="px-8 py-3 bg-white text-slate-700 border border-slate-200 rounded-xl font-semibold text-lg hover:bg-slate-50 transition shadow-sm">Explore Features</a>
            </div>
        </div>
    </section>

    <section id="features" class="py-20 bg-white border-y border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-slate-900">Everything you need to manage events</h2>
                <p class="mt-4 text-slate-600 max-w-2xl mx-auto">Streamlined tools designed specifically for college administrators, club leaders, and students.</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="p-8 rounded-2xl bg-slate-50 border border-slate-100 hover:shadow-lg transition duration-300">
                    <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-900 mb-3">Seamless Ticketing</h3>
                    <p class="text-slate-600">Register for campus events with a single click. Keep track of all your upcoming activities in one clean dashboard.</p>
                </div>
                <div class="p-8 rounded-2xl bg-slate-50 border border-slate-100 hover:shadow-lg transition duration-300">
                    <div class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-900 mb-3">Club Management</h3>
                    <p class="text-slate-600">Empower student organizers to create events, manage attendee lists, and track participation metrics effortlessly.</p>
                </div>
                <div class="p-8 rounded-2xl bg-slate-50 border border-slate-100 hover:shadow-lg transition duration-300">
                    <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-900 mb-3">Real-time Updates</h3>
                    <p class="text-slate-600">Get notified immediately about venue changes, schedule adjustments, or new announcements from event organizers.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center gap-12">
            <div class="md:w-1/2">
                <div class="aspect-video bg-slate-200 rounded-2xl flex items-center justify-center overflow-hidden border border-slate-300">
                    <span class="text-slate-400 font-medium">Campus Image Placeholder</span>
                </div>
            </div>
            <div class="md:w-1/2">
                <h2 class="text-3xl font-bold text-slate-900 mb-6">Empowering Student Life</h2>
                <p class="text-lg text-slate-600 mb-4">
                    Our platform was built by students, for students. We understand the chaos of tracking multiple club events, department symposiums, and cultural fests.
                </p>
                <p class="text-lg text-slate-600">
                    Our mission is to bridge the gap between organizers and attendees, ensuring that every student makes the most out of their college journey without missing out on life-changing experiences.
                </p>
            </div>
        </div>
    </section>

    <section id="help" class="py-20 bg-slate-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-6">Need Help?</h2>
            <p class="text-slate-300 max-w-2xl mx-auto mb-10">Whether you are an organizer struggling to set up an event or a student facing registration issues, our support team is here to assist you.</p>
            <div class="inline-flex flex-col sm:flex-row gap-4">
                <a href="mailto:support@collegeevents.edu" class="px-8 py-3 bg-blue-600 hover:bg-blue-500 rounded-xl font-semibold transition">Contact Support</a>
                <a href="#" class="px-8 py-3 bg-slate-800 hover:bg-slate-700 border border-slate-700 rounded-xl font-semibold transition">View FAQs</a>
            </div>
        </div>
    </section>

    <footer class="bg-slate-950 py-8 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 text-center text-slate-500">
            <p>&copy; {{ date('Y') }} Planova. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
