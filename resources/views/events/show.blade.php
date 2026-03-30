<x-app-layout>
    <div class="mb-6">
        <a href="{{ route('events.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800 flex items-center">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Events
        </a>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden mb-8">
        @if($event->image_path)
            <div class="relative h-64 md:h-96 w-full overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-t from-gray-900/60 to-transparent z-10 transition-opacity group-hover:opacity-40"></div>
                <img src="{{ $event->banner_url }}" 
                     alt="{{ $event->title }}" 
                     class="w-full h-full object-cover transform scale-105 group-hover:scale-100 transition-transform duration-700 ease-out" />
                <div class="absolute bottom-6 left-8 z-20">
                     <span class="inline-flex items-center px-4 py-2 rounded-2xl text-xs font-bold bg-white/20 backdrop-blur-md text-white border border-white/30 uppercase tracking-widest shadow-lg">
                        {{ $event->category->name ?? 'Uncategorized' }}
                    </span>
                </div>
            </div>
        @else
            <div class="h-40 bg-gradient-to-br from-indigo-500 to-blue-600 flex items-center justify-center relative overflow-hidden">
                <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
                <div class="z-10 text-white font-black text-2xl tracking-tight opacity-40 uppercase">{{ $event->category->name ?? 'Event Identity' }}</div>
            </div>
        @endif

        <div class="md:flex">
            <!-- Left Info Panel -->
            <div class="md:w-2/3 p-8 border-b md:border-b-0 md:border-r border-gray-100">
                <div class="flex items-center space-x-3 mb-4">
                    @if(!$event->image_path)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-indigo-50 text-indigo-700 uppercase tracking-wide">
                            {{ $event->category->name ?? 'Uncategorized' }}
                        </span>
                    @endif
                    @if($event->approval_status === 'pending')
                         <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 uppercase tracking-wide">
                             Pending Approval
                         </span>
                    @endif
                </div>

                <h1 class="text-4xl font-black text-gray-900 mb-4">{{ $event->title }}</h1>
                
                <div class="prose max-w-none text-gray-600 mb-8 whitespace-pre-line leading-relaxed">
                    {{ $event->description }}
                </div>

                @can('update', $event)
                    <div class="flex space-x-4 mt-8 pt-6 border-t border-gray-100">
                        <a href="{{ route('events.edit', $event) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 focus:outline-none transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            Edit Event
                        </a>
                        <form action="{{ route('events.destroy', $event) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this event?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-50 border border-transparent rounded-lg font-medium text-red-700 hover:bg-red-100 focus:outline-none transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                Delete
                            </button>
                        </form>
                    </div>
                @endcan
            </div>

            <!-- Right Registration Panel -->
            <div class="md:w-1/3 p-8 bg-gray-50">
                <h3 class="text-lg font-bold text-gray-900 mb-6 pb-4 border-b border-gray-200">Event Details</h3>
                
                <ul class="space-y-6">
                    <li class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-900">Date</p>
                            <p class="mt-1 text-sm text-gray-500">{{ $event->date->format('l, F d, Y') }}</p>
                        </div>
                    </li>

                    <li class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-900">Location</p>
                            <p class="mt-1 text-sm text-gray-500">{{ $event->location }}</p>
                        </div>
                    </li>

                    <li class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-900">Capacity</p>
                            <p class="mt-1 text-sm text-gray-500">
                                {{ $event->participants()->count() }} registered
                                @if($event->max_participants)
                                    / {{ $event->max_participants }} limit
                                @endif
                            </p>
                        </div>
                    </li>
                    
                    <li class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-900">Organizer</p>
                            <p class="mt-1 text-sm text-gray-500">{{ $event->creator->name }}</p>
                        </div>
                    </li>
                </ul>

                <div class="mt-10 pt-6 border-t border-gray-200">
                    @if($event->approval_status !== 'approved')
                        <div class="p-4 bg-amber-50 rounded-xl border border-amber-100 mb-4 text-center">
                            <p class="text-amber-800 text-sm font-medium">This event is awaiting administrative approval before registrations can open.</p>
                        </div>
                    @else
                        @php
                            $isRegistered = $event->participants()->where('user_id', auth()->id())->exists();
                            $isFull = $event->max_participants && $event->participants()->count() >= $event->max_participants;
                        @endphp

                        @if($isRegistered)
                            <div class="p-4 bg-emerald-50 rounded-xl border border-emerald-100 mb-4 text-center">
                                <p class="text-emerald-800 font-bold mb-2">✓ You are registered</p>
                                <form action="{{ route('events.cancel', $event) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs font-medium text-emerald-700 hover:text-red-600 underline">
                                        Cancel Registration
                                    </button>
                                </form>
                            </div>
                        @elseif($isFull)
                            <button disabled class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-gray-400 cursor-not-allowed">
                                Event Full
                            </button>
                        @else
                            <a href="{{ route('events.register.form', $event) }}" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-md text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all transform active:scale-95 text-center">
                                Register Now
                            </a>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Organizers Section -->
    <div class="mt-8">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-8 border-b border-gray-100 bg-gray-50/50">
                <h2 class="text-xl font-black text-gray-900 flex items-center gap-3">
                    <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    Contact the Organizers
                </h2>
            </div>
            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Head Faculty -->
                    @php $headFaculty = $event->team->where('pivot.role', 'head_faculty')->first(); @endphp
                    <div class="space-y-4">
                        <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Head Faculty</p>
                        @if($headFaculty)
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full bg-indigo-600 flex items-center justify-center text-white font-black text-lg shadow-md" title="{{ $headFaculty->name }}">
                                    {{ substr($headFaculty->name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900">{{ $headFaculty->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $headFaculty->department->name ?? 'Faculty' }}</p>
                                    <a href="mailto:{{ $headFaculty->email }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 flex items-center mt-1">
                                        {{ $headFaculty->email }}
                                    </a>
                                </div>
                            </div>
                        @else
                            <p class="text-sm text-gray-400 italic">No head faculty assigned</p>
                        @endif
                    </div>

                    <!-- Co-Organizing Staff -->
                    <div class="space-y-4">
                        <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Co-Organizing Staff</p>
                        <div class="space-y-3">
                            @forelse($event->team->where('pivot.role', 'staff') as $staff)
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-slate-200 flex items-center justify-center text-slate-700 font-bold text-xs">
                                        {{ substr($staff->name, 0, 1) }}
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-sm font-bold text-gray-800 truncate">{{ $staff->name }}</p>
                                        <a href="mailto:{{ $staff->email }}" class="text-[10px] font-bold text-indigo-500 hover:underline inline-block truncate">
                                            {{ $staff->email }}
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <p class="text-sm text-gray-400 italic">No staff members assigned</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Volunteers -->
                    <div class="space-y-4">
                        <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Student Point of Contacts</p>
                        <div class="space-y-3">
                            @forelse($event->team->where('pivot.role', 'volunteer') as $volunteer)
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-700 font-bold text-xs border border-emerald-200">
                                        {{ substr($volunteer->name, 0, 1) }}
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-sm font-bold text-gray-800 truncate">{{ $volunteer->name }}</p>
                                        <a href="mailto:{{ $volunteer->email }}" class="text-[10px] font-bold text-emerald-600 hover:underline inline-block truncate">
                                            {{ $volunteer->email }}
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <p class="text-sm text-gray-400 italic">No student volunteers assigned</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
