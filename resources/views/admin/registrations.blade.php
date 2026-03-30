<x-app-layout>
    <div class="p-8 bg-[#f8fafc] min-h-screen font-sans">
        <!-- Spreadsheet Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
            <div>
                <h1 class="text-4xl font-black text-slate-900 tracking-tight flex items-center gap-4">
                    Registry Terminal
                    <span class="text-[10px] uppercase font-black bg-blue-600 text-white px-3 py-1.5 rounded-lg tracking-[0.2em] shadow-lg shadow-blue-500/20">Spreadsheet View</span>
                </h1>
                <p class="text-sm font-bold text-slate-500 mt-2 uppercase tracking-widest flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                    Administrative Data Stream • {{ $registrations->total() }} Entries detected
                </p>
            </div>
            
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.registrations.export') }}" class="flex items-center gap-3 bg-green-600 text-white px-6 py-3.5 rounded-2xl font-black text-xs uppercase tracking-widest shadow-lg hover:bg-green-700 transition-all border border-green-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Export to Excel (.xlsx)
                </a>
            </div>
        </div>

        <!-- Filters Grid -->
        <div class="bg-white/80 backdrop-blur-xl border border-white p-6 rounded-[2.5rem] shadow-[0_30px_60px_-15px_rgba(0,0,0,0.05)] mb-8">
            <form action="{{ route('admin.registrations') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <div class="relative group">
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Search Identifier</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Subject Name..." 
                        class="w-full bg-slate-50 border-none rounded-xl px-4 py-3 text-sm font-bold placeholder-slate-300 focus:ring-2 focus:ring-blue-500/20 group-hover:bg-slate-100 transition-all">
                </div>
                
                <div class="relative group">
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Gender Filter</label>
                    <select name="gender" class="w-full bg-slate-50 border-none rounded-xl px-4 py-3 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-blue-500/20 group-hover:bg-slate-100 transition-all appearance-none cursor-pointer">
                        <option value="">All Genders</option>
                        <option value="Male" {{ request('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ request('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                        <option value="Other" {{ request('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>

                <div class="flex items-end">
                    <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-3.5 rounded-xl font-black text-[10px] uppercase tracking-[0.2em] hover:scale-105 hover:shadow-lg hover:shadow-blue-500/20 transition-all active:scale-95">
                        Filter Matrix
                    </button>
                </div>
            </form>
        </div>

        <!-- Spreadsheet Matrix -->
        <div class="bg-white/40 backdrop-blur-2xl border border-white/70 rounded-[3rem] overflow-hidden shadow-[0_50px_100px_-20px_rgba(30,50,150,0.1)] transition-all hover:shadow-[0_50px_100px_-20px_rgba(30,50,150,0.15)]">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white">
                            <th class="px-6 py-5 text-left text-[10px] font-black uppercase tracking-[0.2em] border-r border-white/10">Index</th>
                            <th class="px-6 py-5 text-left text-[10px] font-black uppercase tracking-[0.2em] border-r border-white/10">Subject Identity</th>
                            <th class="px-6 py-5 text-left text-[10px] font-black uppercase tracking-[0.2em] border-r border-white/10">Email Address</th>
                            <th class="px-6 py-5 text-left text-[10px] font-black uppercase tracking-[0.2em] border-r border-white/10">Target Event</th>
                            <th class="px-6 py-5 text-left text-[10px] font-black uppercase tracking-[0.2em] border-r border-white/10">Gender</th>
                            <th class="px-6 py-5 text-left text-[10px] font-black uppercase tracking-[0.2em] border-r border-white/10">Link Code (Phone)</th>
                            <th class="px-6 py-5 text-left text-[10px] font-black uppercase tracking-[0.2em] border-r border-white/10">Protocol Data</th>
                            <th class="px-6 py-5 text-left text-[10px] font-black uppercase tracking-[0.2em]">Timestamp</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-blue-100/30">
                        @forelse($registrations as $reg)
                            <tr class="hover:bg-blue-600/[0.03] transition-colors group">
                                <td class="px-6 py-4 text-xs font-black text-blue-300 border-r border-blue-50/50 group-hover:text-blue-600">{{ str_pad($reg->id, 5, '0', STR_PAD_LEFT) }}</td>
                                <td class="px-6 py-4 font-bold text-slate-800 border-r border-blue-50/50">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-[10px] font-black text-white shadow-lg shadow-blue-500/20 group-hover:scale-110 transition-all">
                                            {{ strtoupper(substr($reg->user->name, 0, 2)) }}
                                        </div>
                                        {{ $reg->user->name }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm font-medium text-slate-600 border-r border-blue-50/50">{{ $reg->user->email }}</td>
                                <td class="px-6 py-4 border-r border-blue-50/50">
                                    <span class="px-3 py-1.5 bg-blue-100/50 text-blue-700 rounded-lg text-[10px] font-black uppercase tracking-widest border border-blue-100/50">
                                        {{ $reg->event->title }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 border-r border-blue-50/50">
                                    <span class="px-2.5 py-1 bg-indigo-50/50 text-indigo-600 rounded-md text-[9px] font-black uppercase tracking-widest border border-indigo-100/30">
                                        {{ $reg->gender }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm font-black text-slate-700 border-r border-blue-50/50">{{ $reg->phone_number }}</td>
                                <td class="px-6 py-4 border-r border-blue-50/50">
                                    <div class="max-w-[200px] truncate text-[10px] font-medium text-slate-400 font-mono" title="{{ json_encode($reg->responses) }}">
                                        {{ json_encode($reg->responses) }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-xs font-bold text-slate-400">
                                    {{ $reg->created_at->format('M d, H:i') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-20 text-center">
                                    <div class="flex flex-col items-center opacity-20">
                                        <svg class="w-20 h-20 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        <p class="text-xl font-black uppercase tracking-[0.3em]">No data records detected</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($registrations->hasPages())
                <div class="p-8 bg-slate-50/50 border-t border-slate-100">
                    {{ $registrations->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
