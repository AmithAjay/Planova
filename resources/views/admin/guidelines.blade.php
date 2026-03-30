<x-app-layout>
    <div class="mt-4 pl-2 mb-10 hidden lg:block animation-fade-in relative z-10">
        <h1 class="text-5xl font-extrabold text-slate-800 tracking-tight">
            Faculty <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-500 to-purple-600">Manual</span>
        </h1>
        <p class="text-slate-500 font-medium mt-3">Comprehensive protocols for institutional event management.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-8">
            <div class="relative bg-white/40 backdrop-blur-3xl border border-white/60 rounded-[3rem] shadow-[0_50px_100px_-20px_rgba(0,0,0,0.08)] p-10 overflow-hidden">
                <div class="absolute -top-32 -right-32 w-96 h-96 bg-indigo-400/10 rounded-full blur-[100px] pointer-events-none"></div>
                
                <h2 class="text-2xl font-black text-slate-800 mb-8 flex items-center gap-4">
                    <span class="w-10 h-10 rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center font-black">01</span>
                    Event Creation Protocol
                </h2>
                
                <div class="space-y-6 text-slate-600 leading-relaxed font-medium">
                    <p>To initialize a new event deployment, navigate to the <a href="{{ route('events.create') }}" class="text-indigo-600 font-bold hover:underline">Create Event</a> terminal. You will be required to provide:</p>
                    <ul class="list-disc pl-5 space-y-3">
                        <li><strong class="text-slate-800">Clearance Identity:</strong> A unique title and clear description of the event's objectives.</li>
                        <li><strong class="text-slate-800">Spatial Parameters:</strong> Exact location and capacity limits for resource optimization.</li>
                        <li><strong class="text-slate-800">Temporal Coordinates:</strong> Accurate date and time for system scheduling.</li>
                        <li><strong class="text-slate-800">Visual Identity:</strong> High-resolution banners for the participant matrix.</li>
                    </ul>
                </div>
            </div>

            <div class="relative bg-white/40 backdrop-blur-3xl border border-white/60 rounded-[3rem] shadow-[0_50px_100px_-20px_rgba(0,0,0,0.08)] p-10 overflow-hidden">
                <div class="absolute -bottom-32 -left-32 w-96 h-96 bg-purple-400/10 rounded-full blur-[100px] pointer-events-none"></div>
                
                <h2 class="text-2xl font-black text-slate-800 mb-8 flex items-center gap-4">
                    <span class="w-10 h-10 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center font-black">02</span>
                    Participant Management
                </h2>
                
                <div class="space-y-6 text-slate-600 leading-relaxed font-medium">
                    <p>Faculty members have full oversight of the registration matrix. Access the <a href="{{ route('admin.registrations') }}" class="text-purple-600 font-bold hover:underline">Registration List</a> to:</p>
                    <ul class="list-disc pl-5 space-y-3">
                        <li>Monitor real-time participant inflow.</li>
                        <li>Export registration data in XLSX format for offline verification.</li>
                        <li>Verify student eligibility based on department parameters.</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-8">
            <div class="relative bg-slate-900 rounded-[3rem] p-8 text-white shadow-2xl overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-br from-indigo-600 to-purple-700 opacity-20 group-hover:opacity-30 transition-opacity duration-500"></div>
                <div class="relative z-10 text-center">
                    <div class="w-20 h-20 bg-white/10 rounded-3xl backdrop-blur-md border border-white/20 flex items-center justify-center mx-auto mb-6 shadow-2xl">
                        <svg class="w-10 h-10 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    </div>
                    <h3 class="text-xl font-black mb-4">Ready to start?</h3>
                    <p class="text-slate-400 text-sm mb-8 font-medium">Initialize your event deployment now with full institutional clearance.</p>
                    <a href="{{ route('events.create') }}" class="block w-full py-4 bg-white text-slate-900 font-black rounded-2xl shadow-xl hover:scale-105 active:scale-95 transition-all text-center">CREATE EVENT</a>
                </div>
            </div>

            <div class="bg-white/40 backdrop-blur-3xl border border-white/80 rounded-[2.5rem] p-8 shadow-lg">
                <h4 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-6 border-b border-slate-100 pb-4">Need Support?</h4>
                <div class="space-y-4">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-slate-50 rounded-xl flex items-center justify-center text-slate-500 shadow-inner">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        </div>
                        <span class="text-sm font-bold text-slate-700">+91 9876-PLAN-OVA</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-slate-50 rounded-xl flex items-center justify-center text-slate-500 shadow-inner">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <span class="text-sm font-bold text-slate-700">support@planova.edu</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
