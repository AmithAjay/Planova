<x-app-layout>
    <div class="mb-8 bg-white/60 backdrop-blur-xl border border-white/80 rounded-[2rem] shadow-[0_25px_50px_-12px_rgba(0,0,0,0.06)] p-6">
        <form action="{{ route('events.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
            <!-- Search Bar -->
            <div class="flex-grow w-full md:w-auto">
                <label for="search" class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2 ml-1">Search Events</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" name="search" id="search" value="{{ Request::get('search') }}" 
                        class="block w-full pl-11 pr-4 py-3 bg-white border border-slate-200 rounded-2xl text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300" 
                        placeholder="Title, description or location...">
                </div>
            </div>

            <!-- Category Filter -->
            <div class="w-full md:w-64">
                <label for="category_id" class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2 ml-1">Category</label>
                <div class="relative">
                    <select name="category_id" id="category_id" 
                        class="block w-full pl-4 pr-10 py-3 bg-white border border-slate-200 rounded-2xl text-slate-700 appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300">
                        <option value="">All Categories</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ Request::get('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </div>
            </div>

            <!-- Search Button -->
            <div class="w-full md:w-auto">
                <button type="submit" 
                    class="w-full md:w-auto px-8 py-3 bg-blue-600 border border-blue-600 text-white font-bold rounded-2xl shadow-lg shadow-blue-500/30 hover:bg-blue-700 hover:scale-105 transition-all duration-300 outline-none focus:ring-4 focus:ring-blue-500/40">
                    Search
                </button>
            </div>

            <!-- Reset Button (Optional but helpful) -->
            @if(Request::anyFilled(['search', 'category_id']))
                <div class="w-full md:w-auto">
                    <a href="{{ route('events.index') }}" 
                        class="w-full md:w-auto px-6 py-3 bg-white border border-slate-200 text-slate-600 font-bold rounded-2xl hover:bg-slate-50 transition-all duration-300 flex items-center justify-center">
                        Reset
                    </a>
                </div>
            @endif
        </form>
    </div>

    @if($events->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($events as $event)
                <div class="bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-500 flex flex-col overflow-hidden relative group hover:-translate-y-1">
                    <!-- Image Wrapper -->
                    <div class="relative h-48 overflow-hidden">
                        @if($event->image_path)
                            <img src="{{ $event->banner_url }}" 
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" 
                                 alt="{{ $event->title }}">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-indigo-50 to-blue-50 flex items-center justify-center">
                                <svg class="w-12 h-12 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                        
                        <!-- Status Overlays -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                        @if($event->max_participants && $event->participants()->count() >= $event->max_participants)
                            <div class="absolute top-4 right-4 bg-red-500/90 backdrop-blur-md text-white text-[10px] font-black px-3 py-1 rounded-full shadow-lg">FULL</div>
                        @elseif($event->approval_status === 'pending')
                             <div class="absolute top-4 right-4 bg-amber-500/90 backdrop-blur-md text-white text-[10px] font-black px-3 py-1 rounded-full shadow-lg uppercase">Pending Approval</div>
                        @endif
                        
                        <div class="absolute bottom-4 left-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-xl text-[10px] font-black bg-white/90 backdrop-blur-md text-indigo-700 border border-white/50 shadow-sm uppercase tracking-wider">
                                {{ $event->category->name ?? 'Uncategorized' }}
                            </span>
                        </div>
                    </div>

                    <div class="p-6 flex-grow">
                        <h3 class="text-xl font-extrabold text-slate-800 mb-2 group-hover:text-blue-600 transition-colors leading-tight">{{ $event->title }}</h3>
                        <p class="text-slate-500 text-sm line-clamp-2 mb-6 font-medium leading-relaxed">{{ $event->description }}</p>

                        <div class="space-y-2 mt-auto">
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-2 outline-none text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ $event->date->format('F d, Y') }}
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-2 outline-none text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                {{ $event->location }}
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-2 outline-none text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                {{ $event->participants()->count() }} {{ $event->max_participants ? '/ ' . $event->max_participants : '' }} Registered
                            </div>
                        </div>
                    </div>
                    
                    <div class="border-t border-gray-100 p-4 bg-gray-50 flex justify-between items-center group-hover:bg-indigo-50 transition-colors">
                        <div class="text-xs text-gray-500">
                            By {{ $event->creator->name }}
                        </div>
                        <a href="{{ route('events.show', $event) }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-800">
                            View Details &rarr;
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $events->links() }}
        </div>
    @else
        <div class="text-center py-16 bg-white rounded-2xl border border-gray-100 shadow-sm">
            <svg class="mx-auto h-16 w-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
            <h3 class="mt-4 text-lg font-medium text-gray-900">No events found</h3>
            <p class="mt-2 text-gray-500">Try adjusting your filters or check back later for new events.</p>
        </div>
    @endif
</x-app-layout>
