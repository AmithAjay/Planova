<x-app-layout>
    <div class="mt-4 pl-2 mb-8 hidden lg:block">
        <h1 class="text-4xl font-semibold text-slate-800">
            Welcome back, <span class="text-blue-600">{{ explode(' ', Auth::user()->name)[0] }}!</span>
        </h1>
    </div>

    <!-- Analytics Stats Component -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        
        <div class="bg-white/60 backdrop-blur-xl border border-white/80 rounded-[2rem] shadow-[0_25px_50px_-12px_rgba(0,0,0,0.06)] p-6 flex flex-col items-center justify-center gap-3 relative overflow-hidden group hover:bg-white/70 transition-colors">
            <div class="w-14 h-14 rounded-2xl bg-white shadow-sm flex items-center justify-center text-blue-500 border border-blue-50 drop-shadow-sm group-hover:scale-110 transition-transform duration-300">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
            <div class="text-center">
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-1">Upcoming Events</p>
                <h3 class="text-4xl font-black text-slate-800">{{ $upcomingEventsCount }}</h3>
            </div>
        </div>

        <div class="bg-white/60 backdrop-blur-xl border border-white/80 rounded-[2rem] shadow-[0_25px_50px_-12px_rgba(0,0,0,0.06)] p-6 flex flex-col items-center justify-center gap-3 relative overflow-hidden group hover:bg-white/70 transition-colors">
            <div class="w-14 h-14 rounded-2xl bg-white shadow-sm flex items-center justify-center text-emerald-500 border border-emerald-50 drop-shadow-sm group-hover:scale-110 transition-transform duration-300">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
            </div>
            <div class="text-center">
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-1">My Registrations</p>
                <h3 class="text-4xl font-black text-slate-800">{{ $userRegistrationsCount }}</h3>
            </div>
        </div>

        <div class="bg-white/60 backdrop-blur-xl border border-white/80 rounded-[2rem] shadow-[0_25px_50px_-12px_rgba(0,0,0,0.06)] p-6 flex flex-col items-center justify-center gap-3 relative overflow-hidden group hover:bg-white/70 transition-colors">
            <div class="w-14 h-14 rounded-2xl bg-white shadow-sm flex items-center justify-center text-amber-500 border border-amber-50 drop-shadow-sm group-hover:scale-110 transition-transform duration-300">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
            </div>
            <div class="text-center">
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest mb-1">Events Organized</p>
                <h3 class="text-4xl font-black text-slate-800">{{ Auth::user()->createdEvents()->count() }}</h3>
            </div>
        </div>

    </div>

    <!-- Recent Activity Panel -->
    <div class="bg-white/60 backdrop-blur-xl border border-white/80 rounded-[2.5rem] shadow-[0_30px_60px_-15px_rgba(0,0,0,0.08)] p-8">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-xl font-bold text-slate-800">Your Recent Activity</h2>
            <a href="{{ route('events.index') }}" class="px-5 py-2.5 bg-white border border-white/80 text-blue-600 font-bold text-sm rounded-xl shadow-sm hover:shadow-md hover:scale-105 transition-all outline-none focus:ring-2 focus:ring-blue-500/50">
                Browse Events
            </a>
        </div>
        
        <div class="p-2">
            @php
                $recentRegistrations = Auth::user()->registeredEvents()->with('category')->latest()->take(5)->get();
            @endphp

            @if($recentRegistrations->count() > 0)
                <div class="space-y-4">
                    @foreach($recentRegistrations as $event)
                        <div class="flex items-center justify-between p-5 bg-white/50 border border-white rounded-[1.5rem] shadow-sm hover:shadow-md hover:bg-white/80 transition-all duration-300 group">
                            <div class="flex items-center space-x-5">
                                <div class="bg-blue-100/50 text-blue-700 px-4 py-3 rounded-2xl text-center min-w-[70px] border border-blue-50 group-hover:bg-blue-500 group-hover:text-white transition-colors duration-300">
                                    <span class="block text-xs font-extrabold uppercase tracking-wider">{{ $event->date->format('M') }}</span>
                                    <span class="block text-2xl font-black mt-0.5">{{ $event->date->format('d') }}</span>
                                </div>
                                <div>
                                    <h4 class="text-lg font-bold text-slate-800">{{ $event->title }}</h4>
                                    <div class="flex items-center text-sm text-slate-500 mt-1.5 font-medium">
                                        <svg class="w-4 h-4 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        {{ $event->location }}
                                        <span class="mx-3 text-slate-300">&bull;</span>
                                        <span class="text-blue-600 font-bold bg-blue-50 px-2.5 py-0.5 rounded-md text-[10px] uppercase tracking-wider">{{ $event->category->name ?? 'Uncategorized' }}</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <a href="{{ route('events.show', $event) }}" class="w-10 h-10 rounded-full bg-white border border-slate-100 shadow-sm flex items-center justify-center text-slate-400 hover:text-blue-500 hover:border-blue-200 hover:shadow-md transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12 px-6 border-2 border-dashed border-slate-200/60 rounded-[2rem] bg-white/20">
                    <div class="w-16 h-16 rounded-full bg-white shadow-sm flex items-center justify-center mx-auto mb-4 text-slate-300">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h3 class="text-base font-bold text-slate-700">No activity yet</h3>
                    <p class="mt-2 text-sm text-slate-500 max-w-sm mx-auto">You haven't registered for any events. Browse the upcoming activities on campus to get involved.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
