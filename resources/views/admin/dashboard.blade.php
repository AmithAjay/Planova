<x-app-layout>
    @if(auth()->user()->isSuperAdmin())
        <!-- SUPER ADMIN DASHBOARD -->
        <div class="mt-4 pl-2 mb-10 hidden lg:block animation-fade-in">
            <h1 class="text-5xl font-extrabold text-slate-800 tracking-tight">
                Control <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-teal-600">Center</span>
            </h1>
            <div class="flex items-center gap-3 mt-3">
                <p class="text-slate-500 font-medium">Welcome back, {{ explode(' ', Auth::user()->name)[0] }}. System operations normal.</p>
            </div>
        </div>

        <!-- Super Admin KPI Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
            <!-- Card 1 -->
            <div class="relative bg-white/40 backdrop-blur-2xl border border-white/60 rounded-[2.5rem] shadow-[0_40px_80px_-20px_rgba(0,0,0,0.08)] p-8 flex flex-col items-center justify-center gap-4 group hover:-translate-y-2 hover:shadow-[0_50px_100px_-20px_rgba(0,0,0,0.12)] transition-all duration-500 overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-emerald-100/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative w-16 h-16 rounded-3xl bg-white/80 shadow-[0_10px_30px_-10px_rgba(16,185,129,0.3)] flex items-center justify-center text-emerald-500 border border-emerald-100/50 group-hover:scale-110 transition-transform duration-500">
                    <svg class="w-8 h-8 drop-shadow-[0_0_8px_rgba(16,185,129,0.8)]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                </div>
                <div class="text-center relative z-10">
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-[0.2em] mb-2">Active Admins</p>
                    <h3 class="text-5xl font-black text-slate-800 tracking-tighter">{{ \App\Models\User::whereIn('role', ['admin', 'super_admin'])->count() }}</h3>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="relative bg-white/40 backdrop-blur-2xl border border-white/60 rounded-[2.5rem] shadow-[0_40px_80px_-20px_rgba(0,0,0,0.08)] p-8 flex flex-col items-center justify-center gap-4 group hover:-translate-y-2 hover:shadow-[0_50px_100px_-20px_rgba(0,0,0,0.12)] transition-all duration-500 overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-100/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative w-16 h-16 rounded-3xl bg-white/80 shadow-[0_10px_30px_-10px_rgba(59,130,246,0.3)] flex items-center justify-center text-blue-500 border border-blue-100/50 group-hover:scale-110 transition-transform duration-500">
                    <svg class="w-8 h-8 drop-shadow-[0_0_8px_rgba(59,130,246,0.8)]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <div class="text-center relative z-10">
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-[0.2em] mb-2">Total Students</p>
                    <h3 class="text-5xl font-black text-slate-800 tracking-tighter">{{ \App\Models\User::where('role', 'student')->count() }}</h3>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="relative bg-white/40 backdrop-blur-2xl border border-white/60 rounded-[2.5rem] shadow-[0_40px_80px_-20px_rgba(0,0,0,0.08)] p-8 flex flex-col items-center justify-center gap-4 group hover:-translate-y-2 hover:shadow-[0_50px_100px_-20px_rgba(0,0,0,0.12)] transition-all duration-500 overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-indigo-100/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative w-16 h-16 rounded-3xl bg-white/80 shadow-[0_10px_30px_-10px_rgba(99,102,241,0.3)] flex items-center justify-center text-indigo-500 border border-indigo-100/50 group-hover:scale-110 transition-transform duration-500">
                    <svg class="w-8 h-8 drop-shadow-[0_0_8px_rgba(99,102,241,0.8)]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <div class="text-center relative z-10">
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-[0.2em] mb-2">System Status</p>
                    <h3 class="text-4xl font-black text-indigo-700 tracking-tighter">OPTIMAL</h3>
                </div>
            </div>
        </div>
        
        <!-- Admin Approval Queue (Super Admin Only) -->
        @if($pendingAdmins->count() > 0)
        <div class="relative bg-white/30 backdrop-blur-3xl border border-white/60 rounded-[3rem] shadow-[0_50px_100px_-20px_rgba(0,10,40,0.12)] p-10 overflow-hidden mb-10">
            <div class="absolute -top-32 -left-32 w-96 h-96 bg-emerald-400/10 rounded-full blur-[100px] pointer-events-none"></div>
            <div class="flex items-center justify-between mb-8 relative z-10 border-b border-white/50 pb-6">
                <div class="flex items-center gap-4">
                    <div class="relative w-12 h-12 rounded-2xl bg-gradient-to-br from-emerald-400 to-teal-500 shadow-[0_10px_20px_-5px_rgba(16,185,129,0.4)] flex items-center justify-center">
                        <svg class="w-6 h-6 text-white drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        <div class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 rounded-full border-2 border-white flex items-center justify-center text-[10px] font-black text-white shadow-sm animate-bounce">{{ $pendingAdmins->count() }}</div>
                    </div>
                    <div>
                        <h2 class="text-2xl font-black text-slate-800 tracking-tight">New Admin Requests</h2>
                        <p class="text-sm font-medium text-slate-500 mt-0.5">Systems awaiting clearance authorization</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 relative z-10">
                @foreach($pendingAdmins as $pAdmin)
                    <div class="p-6 bg-white/50 backdrop-blur-xl border border-white/80 rounded-[2rem] shadow-[0_20px_40px_-10px_rgba(0,0,0,0.06)] hover:shadow-[0_30px_60px_-15px_rgba(16,185,129,0.15)] hover:-translate-y-1 transition-all duration-300 relative group">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-slate-700 font-bold border border-white shadow-sm">{{ substr($pAdmin->name, 0, 1) }}</div>
                            <div>
                                <h4 class="text-sm font-bold text-slate-800">{{ $pAdmin->name }}</h4>
                                <p class="text-[10px] font-semibold text-slate-400 uppercase tracking-widest">{{ $pAdmin->department->name ?? 'No Dept' }}</p>
                            </div>
                        </div>
                        
                        <div class="flex gap-3">
                            <form action="{{ route('admin.users.approve', $pAdmin) }}" method="POST" class="flex-1" onsubmit="return confirm('Grant full admin access to {{ $pAdmin->name }}?');">
                                @csrf
                                <button class="w-full py-2 rounded-xl bg-emerald-500 text-white font-bold text-xs shadow-sm hover:bg-emerald-600 transition-colors flex items-center justify-center gap-2">
                                    Approve
                                </button>
                            </form>
                            <form action="{{ route('admin.users.reject', $pAdmin) }}" method="POST" class="flex-1" onsubmit="return confirm('Reject admin request for {{ $pAdmin->name }}? This will keep them restricted.');">
                                @csrf
                                <button class="w-full py-2 rounded-xl bg-white text-slate-400 font-bold text-xs shadow-sm border border-slate-200 hover:text-red-500 hover:border-red-200 transition-colors flex items-center justify-center gap-2">
                                    Reject
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Master Control Panel -->
        <div class="bg-white/40 backdrop-blur-3xl border border-white/70 rounded-[3rem] shadow-[0_50px_100px_-20px_rgba(0,0,0,0.1)] p-10 relative overflow-hidden">
            <!-- Decorative atmospheric glows -->
            <div class="absolute -top-20 -right-20 w-64 h-64 bg-emerald-300/20 rounded-full blur-[80px] pointer-events-none"></div>
            <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-blue-300/20 rounded-full blur-[80px] pointer-events-none"></div>

            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-8 relative z-10 gap-4">
                <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight shrink-0">System Access Grid</h2>
                
                <!-- Advanced Search Console -->
                <form action="{{ route('admin.dashboard') }}" method="GET" class="w-full sm:w-[450px] relative group">
                    <input type="text" 
                        name="search" 
                        value="{{ request('search') }}" 
                        placeholder="Search Identity by Name or Email..." 
                        class="w-full bg-white/60 backdrop-blur-md border border-slate-200/50 rounded-2xl py-3 pl-12 pr-4 text-sm font-bold text-slate-800 placeholder:text-slate-400 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-400 transition-all shadow-inner group-hover:shadow-md">
                    <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-500 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                </form>
            </div>
            
            <div class="relative z-10 overflow-hidden rounded-[2rem] border border-white/60 bg-white/30 backdrop-blur-xl shadow-inner">
                <table class="min-w-full">
                    <thead class="bg-white/40 border-b border-white/50">
                        <tr>
                            <th class="px-8 py-5 text-left text-xs font-extrabold text-slate-500 uppercase tracking-[0.15em]">Identity Identity</th>
                            <th class="px-8 py-5 text-left text-xs font-extrabold text-slate-500 uppercase tracking-[0.15em]">Clearance Level</th>
                            <th class="px-8 py-5 text-right text-xs font-extrabold text-slate-500 uppercase tracking-[0.15em]">Terminal Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/50">
                        @forelse($allUsers as $u)
                        <tr class="hover:bg-white/50 transition-colors duration-300 group">
                            <td class="px-8 py-5">
                                <div class="flex items-center space-x-5">
                                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-white to-slate-100 flex items-center justify-center text-slate-700 font-bold border border-white shadow-[0_8px_16px_-6px_rgba(0,0,0,0.1)] shrink-0 group-hover:shadow-[0_8px_16px_-4px_rgba(0,0,0,0.15)] transition-shadow">
                                        {{ substr($u->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="text-sm font-bold text-slate-800">{{ $u->name }}</div>
                                        <div class="flex items-center gap-2 mt-0.5">
                                            <div class="text-xs text-slate-500 font-medium">{{ $u->email }}</div>
                                            <span class="text-[9px] font-black text-white px-2 py-0.5 bg-slate-400 rounded-md uppercase tracking-tighter">{{ $u->department->name ?? 'No Dept' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                @if($u->role === 'super_admin')
                                    <span class="px-4 py-1.5 rounded-full bg-emerald-100/80 text-emerald-700 text-[10px] font-black tracking-widest border border-emerald-200/50 shadow-sm backdrop-blur-sm">SUPER ADMIN</span>
                                @elseif($u->role === 'admin')
                                    <span class="px-4 py-1.5 rounded-full bg-blue-100/80 text-blue-700 text-[10px] font-black tracking-widest border border-blue-200/50 shadow-sm backdrop-blur-sm">ADMIN</span>
                                @else
                                    <span class="px-4 py-1.5 rounded-full bg-slate-100/80 text-slate-600 text-[10px] font-black tracking-widest border border-slate-200/50 shadow-sm backdrop-blur-sm">STUDENT</span>
                                @endif
                            </td>
                            <td class="px-8 py-5 text-right">
                                <div class="flex items-center justify-end space-x-4 opacity-70 group-hover:opacity-100 transition-opacity duration-300">
                                    <!-- Elevated Toggles -->
                                    <form action="{{ route('admin.users.toggle', $u) }}" method="POST" class="m-0 p-0" onsubmit="return confirm('Are you sure you want to {{ $u->role === 'admin' ? 'revoke' : 'grant' }} admin clearance for {{ $u->name }}?');">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="flex items-center cursor-pointer focus:outline-none" {{ $u->role === 'super_admin' ? 'disabled' : '' }} title="Toggle Clearance">
                                            <div class="relative">
                                                <div class="block {{ $u->role === 'super_admin' ? 'bg-emerald-400' : ($u->role === 'admin' ? 'bg-blue-500' : 'bg-slate-300') }} w-12 h-6 rounded-full shadow-inner transition-colors duration-300"></div>
                                                <div class="dot absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition-transform duration-300 {{ in_array($u->role, ['admin', 'super_admin']) ? 'translate-x-6' : '' }} {{ $u->role === 'super_admin' ? 'shadow-[0_0_8px_rgba(52,211,153,0.8)]' : ($u->role === 'admin' ? 'shadow-[0_0_8px_rgba(59,130,246,0.8)]' : 'shadow-sm') }}"></div>
                                            </div>
                                        </button>
                                    </form>
                                    
                                    <form action="{{ route('admin.users.delete', $u) }}" method="POST" class="m-0 p-0" onsubmit="return confirm('WARNING: Are you sure you want to permanently delete {{ $u->name }}? This action cannot be undone.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-10 h-10 rounded-2xl bg-white/80 backdrop-blur-sm border border-red-100 shadow-sm flex items-center justify-center text-slate-400 hover:text-red-500 hover:border-red-200 hover:shadow-[0_0_15px_rgba(239,68,68,0.3)] transition-all duration-300 {{ $u->role === 'super_admin' ? 'opacity-50 cursor-not-allowed' : '' }}" title="Delete User" {{ $u->role === 'super_admin' ? 'disabled' : '' }}>
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-8 py-20 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center text-slate-300 mb-4 shadow-inner">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                    </div>
                                    <p class="text-slate-500 font-bold">No identity matches found for "<span class="text-blue-500">{{ request('search') }}</span>"</p>
                                    <a href="{{ route('admin.dashboard') }}" class="mt-4 text-xs font-black uppercase tracking-widest text-blue-600 hover:text-blue-700 underline underline-offset-4">Reset Matrix Search</a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Grid -->
            <div class="mt-6 px-4">
                {{ $allUsers->links() }}
            </div>
        </div>

    @else
        <!-- FACULTY ADMIN DASHBOARD | ANTIGRAVITY AESTHETIC -->
        <div class="mt-4 pl-2 mb-10 hidden lg:block animation-fade-in relative z-10">
            <h1 class="text-5xl font-extrabold text-slate-800 tracking-tight">
                Faculty <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-500 to-indigo-600">Control Center</span>
            </h1>
            <div class="flex items-center gap-3 mt-3">
                <p class="text-slate-500 font-medium">Zero-gravity workspace initialized. Welcome back, {{ explode(' ', Auth::user()->name)[0] }}.</p>
                <span class="px-3 py-1 bg-white/50 backdrop-blur-sm border border-blue-100 text-blue-600 text-[10px] font-black tracking-widest rounded-lg shadow-sm uppercase">
                    {{ Auth::user()->department->name ?? 'No Department' }}
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-10 mb-10">
            
            <!-- Left Column: Primary Working Area (Span 2) -->
            <div class="xl:col-span-2 space-y-10">
                
                <!-- Analytics Chart -->
                <div class="relative bg-white/30 backdrop-blur-3xl border border-white/60 rounded-[3rem] shadow-[0_50px_100px_-20px_rgba(0,10,40,0.12)] p-10 overflow-hidden mb-10">
                    <div class="flex items-center justify-between mb-8 relative z-10">
                        <div>
                            <h2 class="text-2xl font-black text-slate-800 tracking-tight">Registration Trends</h2>
                            <p class="text-sm font-medium text-slate-500 mt-1">Total registrations per event (Top 10)</p>
                        </div>
                    </div>
                    
                    <div class="h-[400px] relative z-10">
                        <canvas id="registrationsChart"></canvas>
                    </div>
                </div>

                <!-- Master Event List Card -->
                <div id="active-events" class="relative bg-white/30 backdrop-blur-3xl border border-white/60 rounded-[3rem] shadow-[0_50px_100px_-20px_rgba(0,10,40,0.12)] p-10 overflow-hidden">
                    <div class="absolute -top-32 -right-32 w-96 h-96 bg-blue-400/10 rounded-full blur-[100px] pointer-events-none"></div>
                    
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 mb-10 relative z-10">
                        <div>
                            <h2 class="text-2xl font-black text-slate-800 tracking-tight">Master Event List</h2>
                            <p class="text-sm font-medium text-slate-500 mt-1">Manage all active and approved deployments</p>
                        </div>
                        <a href="{{ route('events.create') }}" class="group relative px-6 py-3 bg-white/80 backdrop-blur-md rounded-2xl shadow-[0_15px_30px_-5px_rgba(59,130,246,0.3)] border border-white hover:-translate-y-1 hover:shadow-[0_20px_40px_-5px_rgba(59,130,246,0.4)] transition-all duration-300 flex items-center gap-3 overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-indigo-500 opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                            <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 text-white flex items-center justify-center shadow-inner group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-5 h-5 drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                            </div>
                            <span class="font-bold text-sm text-slate-700 group-hover:text-blue-600 transition-colors uppercase tracking-wider">New Event</span>
                        </a>
                    </div>

                    <div class="space-y-4 relative z-10">
                        @php $activeEvents = \App\Models\Event::where('approval_status', 'approved')->latest()->take(5)->get(); @endphp
                        @forelse($activeEvents as $event)
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between p-5 bg-white/40 backdrop-blur-xl border border-white/80 rounded-[2rem] shadow-[0_20px_40px_-10px_rgba(0,0,0,0.05)] hover:shadow-[0_30px_60px_-15px_rgba(0,0,0,0.1)] hover:-translate-y-1 transition-all duration-400 group relative overflow-hidden">
                                <!-- Hover glow effect -->
                                <div class="absolute inset-0 bg-gradient-to-r from-blue-50/0 via-blue-50/50 to-blue-50/0 -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                                
                                <div class="flex items-center space-x-5 relative z-10 mb-4 sm:mb-0">
                                    <div class="relative w-16 h-16 rounded-2xl bg-gradient-to-br from-white to-slate-50 flex flex-col items-center justify-center border border-white shadow-sm shrink-0 overflow-hidden group-hover:border-blue-100 transition-colors">
                                        <span class="block text-[10px] font-black uppercase text-blue-500 tracking-widest">{{ $event->date->format('M') }}</span>
                                        <span class="block text-2xl font-black text-slate-700 leading-none mt-0.5">{{ $event->date->format('d') }}</span>
                                    </div>
                                    <div>
                                        <h4 class="text-base font-bold text-slate-800 group-hover:text-blue-600 transition-colors">{{ $event->title }}</h4>
                                        <div class="flex items-center gap-3 mt-1 opacity-70">
                                            <span class="text-[10px] font-bold uppercase tracking-widest text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded-md">{{ $event->category->name ?? 'Uncategorized' }}</span>
                                            <span class="text-xs font-medium text-slate-500 flex items-center gap-1">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                                {{ $event->registrations()->count() }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3 relative z-10">
                                    <a href="{{ route('events.edit', $event) }}" class="flex items-center justify-center w-10 h-10 rounded-2xl bg-white border border-slate-100 shadow-[0_5px_15px_-5px_rgba(0,0,0,0.05)] text-slate-400 hover:text-blue-500 hover:border-blue-200 hover:shadow-[0_0_15px_rgba(59,130,246,0.3)] transition-all duration-300" title="Edit">
                                        <svg class="w-5 h-5 drop-shadow-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-10">
                                <p class="text-sm font-bold text-slate-400">No active events in the matrix.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Student Requests Queue -->
                <div class="relative bg-white/30 backdrop-blur-3xl border border-white/60 rounded-[3rem] shadow-[0_50px_100px_-20px_rgba(0,10,40,0.12)] p-10 overflow-hidden">
                     <div class="absolute -bottom-32 -left-32 w-96 h-96 bg-amber-400/10 rounded-full blur-[100px] pointer-events-none"></div>

                    <div class="flex items-center justify-between mb-8 relative z-10 border-b border-white/50 pb-6">
                        <div class="flex items-center gap-4">
                            <div class="relative w-12 h-12 rounded-2xl bg-gradient-to-br from-amber-400 to-orange-500 shadow-[0_10px_20px_-5px_rgba(245,158,11,0.4)] flex items-center justify-center">
                                <svg class="w-6 h-6 text-white drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                @if($pendingEvents->count() > 0)
                                    <div class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 rounded-full border-2 border-white flex items-center justify-center text-[10px] font-black text-white shadow-sm animate-bounce">{{ $pendingEvents->count() }}</div>
                                @endif
                            </div>
                            <div>
                                <h2 class="text-2xl font-black text-slate-800 tracking-tight">Student Requests</h2>
                                <p class="text-sm font-medium text-slate-500 mt-0.5">Awaiting authorization protocol</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 relative z-10">
                        @forelse($pendingEvents->take(4) as $event)
                            <div class="p-6 bg-white/50 backdrop-blur-xl border border-white/80 rounded-[2rem] shadow-[0_20px_40px_-10px_rgba(0,0,0,0.06)] hover:shadow-[0_30px_60px_-15px_rgba(245,158,11,0.15)] hover:-translate-y-1 transition-all duration-300 relative group">
                                <div class="absolute top-4 right-4 w-2 h-2 rounded-full bg-amber-400 animate-pulse shadow-[0_0_8px_rgba(245,158,11,0.8)]"></div>
                                
                                <h4 class="text-lg font-bold text-slate-800 pr-6">{{ $event->title }}</h4>
                                <p class="text-xs font-semibold text-slate-500 mt-1 uppercase tracking-widest">By: {{ $event->creator->name }}</p>
                                
                                <div class="flex gap-3 mt-6">
                                    <form action="{{ route('admin.events.approve', $event) }}" method="POST" class="flex-1" onsubmit="return confirm('Confirm deployment authorization for {{ $event->title }}?');">
                                        @csrf
                                        <button class="w-full py-2.5 rounded-xl bg-gradient-to-r from-emerald-400 to-emerald-500 text-white font-bold text-sm shadow-[0_10px_20px_-5px_rgba(16,185,129,0.4)] hover:shadow-[0_15px_25px_-5px_rgba(16,185,129,0.5)] border border-emerald-300/50 transition-all flex items-center justify-center gap-2 group-hover:scale-[1.02]">
                                            <svg class="w-4 h-4 drop-shadow-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                            Approve
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.events.reject', $event) }}" method="POST" class="flex-none" onsubmit="return confirm('Initiate rejection protocol for {{ $event->title }}?');">
                                        @csrf
                                        <button class="w-12 h-10 rounded-xl bg-white text-slate-400 font-bold shadow-sm border border-slate-200 hover:text-red-500 hover:border-red-200 hover:shadow-[0_10px_20px_-5px_rgba(239,68,68,0.2)] transition-all flex items-center justify-center">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-8">
                                <p class="text-sm font-bold text-slate-400">Queue is clear.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>

            <!-- Right Column: Tools & Sidebar (Span 1) -->
            <div class="space-y-10">
                
                <!-- Advanced Tools Palette -->
                <div class="relative bg-white/30 backdrop-blur-3xl border border-white/60 rounded-[3rem] shadow-[0_50px_100px_-20px_rgba(0,10,40,0.12)] p-8 overflow-hidden">
                    <div class="absolute -top-20 -right-20 w-64 h-64 bg-indigo-400/10 rounded-full blur-[80px] pointer-events-none"></div>

                    <h3 class="text-sm font-black text-slate-400 uppercase tracking-[0.2em] mb-6 relative z-10">Toolkit</h3>
                    
                    <div class="grid grid-cols-2 gap-4 relative z-10">
                        <a href="{{ route('events.create') }}" class="flex flex-col items-center justify-center gap-3 p-5 bg-white/60 backdrop-blur-sm border border-white/80 rounded-[1.5rem] shadow-[0_15px_30px_-10px_rgba(0,0,0,0.05)] hover:-translate-y-1 hover:shadow-[0_20px_40px_-10px_rgba(99,102,241,0.2)] hover:border-indigo-100 transition-all duration-300 group">
                            <div class="w-12 h-12 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-500 group-hover:bg-indigo-500 group-hover:text-white transition-colors duration-300 relative">
                                <div class="absolute inset-0 rounded-full bg-indigo-500 blur-md opacity-0 group-hover:opacity-40 transition-opacity duration-300"></div>
                                <svg class="w-6 h-6 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                            </div>
                            <span class="text-[10px] font-bold text-slate-600 uppercase tracking-widest text-center">Upload Poster</span>
                        </a>
                        
                        <a href="{{ route('admin.guidelines') }}" class="flex flex-col items-center justify-center gap-3 p-5 bg-white/60 backdrop-blur-sm border border-white/80 rounded-[1.5rem] shadow-[0_15px_30px_-10px_rgba(0,0,0,0.05)] hover:-translate-y-1 hover:shadow-[0_20px_40px_-10px_rgba(99,102,241,0.2)] hover:border-indigo-100 transition-all duration-300 group">
                            <div class="w-12 h-12 rounded-full bg-purple-50 flex items-center justify-center text-purple-500 group-hover:bg-purple-500 group-hover:text-white transition-colors duration-300 relative">
                                <div class="absolute inset-0 rounded-full bg-purple-500 blur-md opacity-0 group-hover:opacity-40 transition-opacity duration-300"></div>
                                <svg class="w-6 h-6 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                            </div>
                            <span class="text-[10px] font-bold text-slate-600 uppercase tracking-widest text-center">Add Rules</span>
                        </a>
                    </div>

                    <div class="mt-6 space-y-3 relative z-10">
                        <a href="#active-events" class="flex items-center justify-between p-4 bg-white/50 backdrop-blur-xl border border-white/80 rounded-2xl shadow-sm hover:shadow-md hover:border-blue-100 transition-all group">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-blue-100/50 text-blue-600 flex items-center justify-center"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg></div>
                                <span class="text-sm font-bold text-slate-700">Scheduling</span>
                            </div>
                            <svg class="w-4 h-4 text-slate-300 group-hover:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                        <a href="{{ route('admin.registrations') }}" class="flex items-center justify-between p-4 bg-white/50 backdrop-blur-xl border border-white/80 rounded-2xl shadow-sm hover:shadow-md hover:border-blue-100 transition-all group">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-blue-100/50 text-blue-600 flex items-center justify-center"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg></div>
                                <span class="text-sm font-bold text-slate-700">Participants</span>
                            </div>
                            <svg class="w-4 h-4 text-slate-300 group-hover:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>

                <!-- Auxiliary Information Panel (Optional Extension for spacing) -->
                <div class="relative bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700/50 rounded-[3rem] shadow-[0_50px_100px_-20px_rgba(0,0,0,0.3)] p-8 overflow-hidden text-white">
                    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
                    <div class="relative z-10 flex flex-col items-center text-center">
                        <div class="w-16 h-16 rounded-3xl bg-white/10 backdrop-blur-sm border border-white/20 flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-blue-400 drop-shadow-[0_0_8px_rgba(96,165,250,0.6)]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <h4 class="text-lg font-bold mb-2">Faculty Guidelines</h4>
                        <p class="text-xs text-slate-400 font-medium leading-relaxed mb-6">Ensure all event parameters meet institutional safety & spatial requirements before protocol approval.</p>
                        <a href="{{ route('admin.guidelines') }}" class="block px-5 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 border border-white/20 transition-all active:scale-95 text-sm font-bold w-full backdrop-blur-sm text-center">View Manual</a>
                    </div>
                </div>

            </div>
        </div>

    @endif
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('registrationsChart').getContext('2d');
        const chartData = @json($chartData);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: chartData.labels,
                datasets: [{
                    label: 'Registrations',
                    data: chartData.values,
                    backgroundColor: 'rgba(59, 130, 246, 0.5)',
                    borderColor: 'rgb(59, 130, 246)',
                    borderWidth: 2,
                    borderRadius: 12,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(255, 255, 255, 0.9)',
                        titleColor: '#1e293b',
                        bodyColor: '#1e293b',
                        borderColor: '#e2e8f0',
                        borderWidth: 1,
                        padding: 12,
                        boxPadding: 8,
                        usePointStyle: true,
                        callbacks: {
                            label: function(context) {
                                return ' ' + context.parsed.y + ' Registrations';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            display: true,
                            color: 'rgba(0, 0, 0, 0.05)',
                            drawBorder: false
                        },
                        ticks: {
                            font: {
                                size: 11,
                                weight: '600'
                            },
                            color: '#64748b'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 10,
                                weight: '700'
                            },
                            color: '#64748b',
                            autoSkip: false,
                            maxRotation: 45,
                            minRotation: 45
                        }
                    }
                }
            }
        });
    });
</script>
