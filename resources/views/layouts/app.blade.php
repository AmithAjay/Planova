<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Planova') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Tailwind CDN (Ensures all utility classes render correctly even without npm run dev) -->
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="font-sans antialiased text-slate-800 bg-gradient-to-br from-[#e0f2fe] via-[#f0f9ff] to-[#e0f2fe] relative overflow-x-hidden min-h-screen">
        
        <!-- Abstract gradient background orbs -->
        <div class="fixed top-[-10%] left-[-10%] w-[500px] h-[500px] rounded-full bg-white/40 blur-3xl pointer-events-none z-0"></div>
        <div class="fixed bottom-[-10%] right-[-5%] w-[600px] h-[600px] rounded-full bg-blue-100/40 blur-3xl pointer-events-none z-0"></div>

        <div class="min-h-screen flex p-6 gap-8 relative z-10 max-w-screen-2xl mx-auto" x-data="{ sidebarOpen: false }">
            
            <!-- Mobile Sidebar Backdrop -->
            <div x-show="sidebarOpen" class="fixed inset-0 z-40 transition-opacity bg-slate-900/20 backdrop-blur-sm lg:hidden" @click="sidebarOpen = false"></div>

            <!-- Sidebar -->
            <aside :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="fixed inset-y-0 left-0 z-50 w-64 lg:w-72 transition duration-300 transform lg:translate-x-0 lg:static lg:inset-0 lg:h-[calc(100vh-3rem)] bg-white/60 backdrop-blur-xl border border-white/80 rounded-[2.5rem] shadow-[0_30px_60px_-15px_rgba(0,0,0,0.08)] flex flex-col m-6 lg:m-0">
                <div class="flex items-center justify-center h-24 border-b border-slate-200/50">
                    <div class="flex items-center space-x-3 text-blue-600">
                        <svg class="w-8 h-8 drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        <span class="text-2xl font-black uppercase tracking-widest bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-500">Planova</span>
                    </div>
                </div>

                <nav class="flex-1 overflow-y-auto overflow-x-hidden mt-6 px-6 space-y-2 pb-6 custom-scrollbar">
                    <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3.5 {{ request()->routeIs('dashboard') ? 'bg-blue-500 text-white shadow-lg shadow-blue-500/30' : 'text-slate-500 hover:text-blue-600 hover:bg-white/50' }} rounded-2xl transition-all font-medium">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        Dashboard
                    </a>
                    
                    <a href="{{ route('events.index') }}" class="flex items-center px-4 py-3.5 {{ request()->routeIs('events.index') ? 'bg-blue-500 text-white shadow-lg shadow-blue-500/30' : 'text-slate-500 hover:text-blue-600 hover:bg-white/50' }} rounded-2xl transition-all font-medium">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Browse Events
                    </a>

                    @if(auth()->user()->isStudent())
                    <a href="{{ route('events.my') }}" class="flex items-center px-4 py-3.5 {{ request()->routeIs('events.my') ? 'bg-blue-500 text-white shadow-lg shadow-blue-500/30' : 'text-slate-500 hover:text-blue-600 hover:bg-white/50' }} rounded-2xl transition-all font-medium">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                        My Registrations
                    </a>
                    @endif

                    <div class="px-5 pt-6 pb-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ auth()->user()->isStudent() ? 'Proposals' : 'Management' }}</div>
                    <a href="{{ route('events.create') }}" class="flex items-center px-4 py-3.5 {{ request()->routeIs('events.create') ? 'bg-blue-500 text-white shadow-lg shadow-blue-500/30' : 'text-slate-500 hover:text-blue-600 hover:bg-white/50' }} rounded-2xl transition-all font-medium">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        {{ auth()->user()->isStudent() ? 'Propose Event' : 'Create Event' }}
                    </a>

                    @if(auth()->user()->isAdmin())
                        <div class="px-5 pt-6 pb-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Administration</div>
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3.5 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-500 text-white shadow-lg shadow-blue-500/30' : 'text-slate-500 hover:text-blue-600 hover:bg-white/50' }} rounded-2xl transition-all font-medium">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                            Admin Center
                        </a>
                        <a href="{{ route('admin.registrations') }}" class="flex items-center px-4 py-3.5 {{ request()->routeIs('admin.registrations') ? 'bg-blue-500 text-white shadow-lg shadow-blue-500/30' : 'text-slate-500 hover:text-blue-600 hover:bg-white/50' }} rounded-2xl transition-all font-medium">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            Registrations
                        </a>
                    @endif
                </nav>
            </aside>

            <!-- Main Content Area -->
            <main class="flex-1 flex flex-col min-w-0 pb-4 lg:pt-0 pt-16">
                <!-- Topbar -->
                <header class="bg-white/60 backdrop-blur-xl border border-white/80 rounded-[2rem] shadow-[0_20px_40px_-10px_rgba(0,0,0,0.05)] px-6 py-4 flex items-center justify-between lg:justify-end gap-6 mb-8 block absolute top-6 right-6 left-6 lg:static z-30">
                    <button @click="sidebarOpen = true" class="text-slate-400 hover:text-blue-500 focus:outline-none lg:hidden">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </button>

                    <div class="flex items-center space-x-6">
                        <!-- Notification Bell (Interactive Dropdown) -->
                        <div class="relative hidden sm:block" x-data="{ notificationsOpen: false }" @click.away="notificationsOpen = false">
                            <button @click="notificationsOpen = !notificationsOpen" class="relative text-slate-400 hover:text-blue-500 transition-colors focus:outline-none flex items-center justify-center p-2 rounded-xl hover:bg-slate-50">
                                @if(auth()->user()->unreadNotifications->count() > 0)
                                    <span class="absolute top-1.5 right-1.5 flex h-2 w-2">
                                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                      <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500 border border-white"></span>
                                    </span>
                                @endif
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                            </button>

                            <!-- Notification Dropdown Panel -->
                            <div x-show="notificationsOpen"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                 x-transition:leave-end="opacity-0 scale-95 translate-y-2"
                                 class="absolute right-0 mt-3 w-80 bg-white/90 backdrop-blur-xl border border-white shadow-[0_30px_60px_-15px_rgba(0,0,0,0.1)] rounded-2xl overflow-hidden z-50 transform origin-top-right display-none" style="display: none;">
                                
                                <div class="px-5 py-4 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                                    <h3 class="text-sm font-black text-slate-800">Notifications</h3>
                                    @if(auth()->user()->unreadNotifications->count() > 0)
                                        <span class="px-2 py-0.5 bg-red-100 text-red-600 text-[10px] font-bold rounded-lg">{{ auth()->user()->unreadNotifications->count() }} New</span>
                                    @endif
                                </div>

                                <div class="max-h-80 overflow-y-auto custom-scrollbar">
                                    @forelse(auth()->user()->unreadNotifications->take(5) as $notification)
                                        @php
                                            $url = '#';
                                            if (isset($notification->data['event_id'])) {
                                                $url = route('events.show', $notification->data['event_id']);
                                            } elseif (isset($notification->data['url'])) {
                                                $url = $notification->data['url'];
                                            }
                                        @endphp
                                        <div class="px-5 py-4 border-b border-slate-50 hover:bg-slate-50 transition-colors flex gap-3 group cursor-pointer" onclick="window.location.href='{{ $url }}'">
                                            <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center shrink-0 mt-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-slate-700 leading-snug group-hover:text-blue-700 transition-colors">
                                                    @if(isset($notification->data['student_name']) && isset($notification->data['event_title']))
                                                        <span class="font-bold">{{ $notification->data['student_name'] }}</span> registered for <span class="font-bold">{{ $notification->data['event_title'] }}</span>
                                                    @elseif(isset($notification->data['message']))
                                                        {{ $notification->data['message'] }}
                                                    @else
                                                        New Notification
                                                    @endif
                                                </p>
                                                <p class="text-[11px] font-bold text-slate-400 mt-1 uppercase tracking-wider">{{ $notification->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="px-5 py-8 text-center flex flex-col items-center justify-center">
                                            <div class="w-12 h-12 bg-slate-50 rounded-full flex items-center justify-center mb-3">
                                                <svg class="w-6 h-6 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                                            </div>
                                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">All caught up!</p>
                                        </div>
                                    @endforelse
                                </div>

                                @if(auth()->user()->unreadNotifications->count() > 0)
                                    <form action="{{ route('notifications.markAllRead') }}" method="POST" class="p-3 bg-slate-50/80 border-t border-slate-100 flex justify-center sticky bottom-0 z-10 backdrop-blur-sm">
                                        @csrf
                                        <button type="submit" class="text-[11px] font-black text-blue-600 hover:text-blue-800 uppercase tracking-wider w-full py-2 hover:bg-blue-50 rounded-lg transition-colors">
                                            Mark all as read
                                        </button>
                                    </form>
                                @endif
                                
                            </div>
                        </div>

                        <div class="flex items-center gap-4 sm:border-l sm:border-slate-200/60 sm:pl-6">
                            <!-- Department Badge -->
                            <div class="hidden md:flex items-center">
                                <span class="px-3 py-1 bg-slate-50/80 border border-slate-200/60 text-slate-500 text-[11px] font-bold uppercase tracking-wider rounded-lg shadow-sm">
                                    {{ Auth::user()->department->name ?? 'No Department' }}
                                </span>
                            </div>

                            <div class="w-10 h-10 rounded-full bg-slate-200 border-2 border-white shadow-sm overflow-hidden flex-shrink-0">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=E0E7FF&color=4F46E5&bold=true" alt="Profile" class="w-full h-full object-cover">
                            </div>
                            <div class="flex flex-col">
                                <span class="text-sm font-bold text-slate-800 leading-tight">{{ Auth::user()->name }}</span>
                                <span class="text-[10px] font-black text-blue-500 tracking-wider uppercase">{{ str_replace('_', ' ', Auth::user()->role) }}</span>
                            </div>
                        </div>
                        
                        <form method="POST" action="{{ route('logout') }}" class="ml-2 hidden sm:block">
                            @csrf
                            <button type="submit" class="flex items-center text-sm font-semibold text-slate-400 hover:text-red-500 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            </button>
                        </form>
                    </div>
                </header>

                <!-- Page Content -->
                <div class="w-full mx-auto relative z-10">
                    @if (session('success'))
                        <div class="px-5 py-4 mb-8 text-sm text-emerald-800 bg-emerald-50/80 backdrop-blur-md border border-emerald-100 rounded-2xl shadow-sm shadow-emerald-100/50 font-medium flex items-center" role="alert">
                            <svg class="w-5 h-5 mr-3 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="px-5 py-4 mb-8 text-sm text-red-800 bg-red-50/80 backdrop-blur-md border border-red-100 rounded-2xl shadow-sm shadow-red-100/50 font-medium flex items-center" role="alert">
                            <svg class="w-5 h-5 mr-3 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ session('error') }}
                        </div>
                    @endif
                    
                    @yield('content')
                    {{ $slot ?? '' }}
                </div>
            </main>
        </div>

        <style>
            .custom-scrollbar::-webkit-scrollbar {
                width: 4px;
            }
            .custom-scrollbar::-webkit-scrollbar-track {
                background: transparent;
            }
            .custom-scrollbar::-webkit-scrollbar-thumb {
                background: rgba(148, 163, 184, 0.3);
                border-radius: 4px;
            }
            .custom-scrollbar:hover::-webkit-scrollbar-thumb {
                background: rgba(148, 163, 184, 0.5);
            }
        </style>
    </body>
</html>
