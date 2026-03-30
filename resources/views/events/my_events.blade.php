<x-app-layout>
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">My Registrations</h2>
            <p class="text-gray-500 mt-1">Manage all the events you have registered for.</p>
        </div>
        <a href="{{ route('events.index') }}" class="px-5 py-2.5 bg-white border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 shadow-sm transition-all">
            Browse More Events
        </a>
    </div>

    @if($events->count() > 0)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <ul class="divide-y divide-gray-100">
                @foreach($events as $event)
                    <li class="p-6 hover:bg-gray-50 transition-colors">
                        <div x-data="{ showTicket: false }">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-6 w-full lg:w-2/3">
                                    <!-- Date block -->
                                    <div class="bg-indigo-100 text-indigo-700 px-4 py-3 rounded-xl text-center min-w-[80px] shadow-inner shadow-indigo-200">
                                        <span class="block text-sm font-bold uppercase">{{ $event->date->format('M') }}</span>
                                        <span class="block text-2xl font-black">{{ $event->date->format('d') }}</span>
                                    </div>
                                    
                                    <div class="flex-1">
                                        <div class="flex items-center space-x-2 mb-1">
                                            <h4 class="text-lg font-bold text-gray-900 truncate">
                                                <a href="{{ route('events.show', $event) }}" class="hover:text-indigo-600 focus:outline-none">
                                                    {{ $event->title }}
                                                </a>
                                            </h4>
                                            <span class="px-2 py-0.5 max-w-max text-[10px] font-bold uppercase tracking-wider bg-emerald-100 text-emerald-800 rounded-full">Registered</span>
                                        </div>
                                        <div class="flex flex-col sm:flex-row sm:space-x-4 text-sm text-gray-500 mt-2">
                                            <div class="flex items-center mb-1 sm:mb-0">
                                                <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                                {{ $event->location }}
                                            </div>
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                                                {{ $event->category->name ?? 'Uncategorized' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="hidden lg:flex items-center space-x-4">
                                    <button @click="showTicket = true" class="px-4 py-2 bg-indigo-50 text-indigo-700 border border-indigo-100 rounded-lg text-sm font-bold hover:bg-indigo-100 transition-colors flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 17h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                                        View Ticket
                                    </button>
                                    <form action="{{ route('events.cancel', $event) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel your registration?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-2 border border-red-200 text-red-600 rounded-lg text-sm font-medium hover:bg-red-50 focus:outline-none">
                                            Cancel
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Mobile actions -->
                            <div class="mt-4 flex lg:hidden items-center justify-between border-t border-gray-100 pt-4">
                                <button @click="showTicket = true" class="text-sm font-bold text-indigo-600 hover:text-indigo-900 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 17h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                                    Ticket
                                </button>
                                <form action="{{ route('events.cancel', $event) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel your registration?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-800">
                                        Cancel
                                    </button>
                                </form>
                            </div>

                            <!-- Ticket Modal -->
                            <div x-show="showTicket" 
                                class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0"
                                x-transition:enter-end="opacity-100"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100"
                                x-transition:leave-end="opacity-0"
                                style="display: none;">
                                
                                <div @click.away="showTicket = false" 
                                    class="bg-white rounded-[2.5rem] shadow-2xl max-w-sm w-full overflow-hidden relative"
                                    x-transition:enter="transition ease-out duration-300 transform"
                                    x-transition:enter-start="scale-90 opacity-0"
                                    x-transition:enter-end="scale-100 opacity-100">
                                    
                                    <div class="bg-indigo-600 p-8 text-white text-center relative overflow-hidden">
                                        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white/10 rounded-full blur-2xl"></div>
                                        <div class="absolute bottom-0 left-0 -mb-4 -ml-4 w-24 h-24 bg-white/10 rounded-full blur-2xl"></div>
                                        
                                        <h3 class="text-xl font-black mb-1">Event Ticket</h3>
                                        <p class="text-indigo-100 text-xs font-bold uppercase tracking-widest">{{ $event->category->name ?? 'General' }}</p>
                                    </div>
                                    
                                    <div class="p-8">
                                        <div class="bg-slate-50 rounded-3xl p-6 mb-6 flex flex-col items-center justify-center border-2 border-dashed border-slate-200">
                                            {!! SimpleSoftwareIO\QrCode\Facades\QrCode::size(200)->generate($event->pivot->id) !!}
                                            <p class="mt-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Registration ID: #{{ $event->pivot->id }}</p>
                                        </div>
                                        
                                        <div class="space-y-4">
                                            <div>
                                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-0.5">Event Title</p>
                                                <p class="text-lg font-bold text-slate-800 leading-tight">{{ $event->title }}</p>
                                            </div>
                                            
                                            <div class="grid grid-cols-2 gap-4">
                                                <div>
                                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-0.5">Date</p>
                                                    <p class="text-sm font-bold text-slate-700">{{ $event->date->format('M d, Y') }}</p>
                                                </div>
                                                <div>
                                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-0.5">Attendee</p>
                                                    <p class="text-sm font-bold text-slate-700">{{ Auth::user()->name }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="p-6 pt-0">
                                        <button @click="showTicket = false" class="w-full py-4 bg-slate-100 text-slate-600 font-black rounded-2xl hover:bg-slate-200 transition-colors uppercase text-xs tracking-widest">
                                            Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        
        <div class="mt-8">
            {{ $events->links() }}
        </div>
    @else
        <div class="text-center py-16 bg-white rounded-2xl border border-gray-100 shadow-sm">
            <div class="bg-indigo-50 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="h-8 w-8 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
            </div>
            <h3 class="mt-2 text-lg font-bold text-gray-900">No Registrations</h3>
            <p class="mt-2 text-gray-500 max-w-sm mx-auto">You haven't registered for any events yet. Browse our upcoming events and get involved in campus life!</p>
            <div class="mt-6">
                <a href="{{ route('events.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm shadow-indigo-200 text-sm font-bold rounded-lg text-white bg-indigo-600 hover:bg-indigo-700">
                    Browse Events Now
                </a>
            </div>
        </div>
    @endif
</x-app-layout>
