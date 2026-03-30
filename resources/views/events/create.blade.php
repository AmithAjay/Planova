<x-app-layout>
    <div x-data="eventForm()" class="min-h-screen font-sans text-slate-800 relative z-10 w-full animate-fade-in pb-16">
        
        <!-- Animated Premium Background Elements -->
        <div class="fixed top-0 left-0 w-full h-full overflow-hidden pointer-events-none z-0">
            <div class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] rounded-full bg-indigo-300/20 blur-[120px] mix-blend-multiply"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-[600px] h-[600px] rounded-full bg-purple-300/20 blur-[120px] mix-blend-multiply"></div>
            <div class="absolute top-[30%] left-[60%] w-[400px] h-[400px] rounded-full bg-blue-300/20 blur-[120px] mix-blend-multiply"></div>
        </div>

        <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data" class="max-w-5xl mx-auto relative z-10 p-4 lg:p-0">
            @csrf
            
            <header class="mb-12 flex flex-col md:flex-row justify-between items-start md:items-end gap-6 pt-10">
                <div>
                    <nav class="flex text-[11px] font-bold text-slate-500 mb-3 gap-3 uppercase tracking-widest items-center">
                        <a href="{{ route('events.index') }}" class="hover:text-indigo-600 cursor-pointer flex items-center gap-1 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            Events
                        </a>
                        <span class="text-slate-300">/</span>
                        <span class="text-indigo-600">Create New Event</span>
                    </nav>
                    <h1 class="text-5xl font-extrabold tracking-tight text-slate-900">Event <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-blue-600 to-purple-600">Details</span></h1>
                </div>
                <div class="flex gap-4 w-full md:w-auto">
                    <a href="{{ route('events.index') }}" class="flex-1 md:flex-none text-center px-6 py-3.5 bg-white border border-slate-200 rounded-2xl font-bold text-slate-600 hover:text-slate-900 hover:bg-slate-50 hover:border-slate-300 hover:shadow-sm transition-all duration-300">Cancel</a>
                    <button type="submit" class="flex-1 md:flex-none text-center px-8 py-3.5 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl font-bold shadow-md transition-all duration-300 flex items-center justify-center gap-2 group border border-blue-700">
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                        {{ auth()->user()->isStudent() ? 'Submit Proposal' : 'Publish Event' }}
                    </button>
                </div>
            </header>

            <div class="space-y-8">
                <!-- Section 1: Basic Information -->
                <section class="bg-white/60 backdrop-blur-3xl border border-white/80 rounded-[2.5rem] p-8 lg:p-12 shadow-[0_20px_80px_-20px_rgba(0,0,0,0.05)] relative overflow-hidden group">
                    <div class="absolute -top-32 -right-32 w-64 h-64 bg-gradient-to-br from-indigo-200/40 to-purple-200/40 rounded-full blur-[80px] pointer-events-none group-hover:from-indigo-300/40 group-hover:to-purple-300/40 transition-colors duration-700"></div>
                    
                    <div class="flex items-center gap-5 mb-10 relative z-10">
                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 shadow-lg shadow-indigo-500/30 flex items-center justify-center text-white font-extrabold text-xl">1</div>
                        <div>
                            <h2 class="text-2xl font-black text-slate-900 tracking-tight">Basic Information</h2>
                            <p class="text-sm font-medium text-slate-500 mt-0.5">Define the core details of your event.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 relative z-10">
                        <div class="col-span-1 md:col-span-2 space-y-2">
                            <label for="title" class="block text-xs font-black text-slate-500 uppercase tracking-widest pl-1">Event Title <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <input type="text" name="title" id="title" value="{{ old('title') }}" placeholder="e.g. Annual Tech Fest 2026" required class="w-full bg-white/80 backdrop-blur-md border border-slate-200/60 shadow-[inset_0_2px_4px_rgba(0,0,0,0.02)] rounded-2xl px-6 py-4 focus:ring-4 focus:ring-indigo-500/15 focus:border-indigo-400 focus:bg-white transition-all outline-none text-xl font-bold text-slate-800 placeholder-slate-400">
                            </div>
                            @error('title') <p class="mt-2 text-sm text-red-500 font-medium pl-1 flex items-center gap-1"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>{{ $message }}</p> @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="category_id" class="block text-xs font-black text-slate-500 uppercase tracking-widest pl-1">Category <span class="text-slate-400 font-medium normal-case tracking-normal">(Optional)</span></label>
                            <div class="relative">
                                <select name="category_id" id="category_id" class="w-full bg-white/80 backdrop-blur-md border border-slate-200/60 shadow-[inset_0_2px_4px_rgba(0,0,0,0.02)] rounded-2xl px-6 py-4 focus:ring-4 focus:ring-indigo-500/15 focus:border-indigo-400 focus:bg-white transition-all outline-none text-slate-800 font-bold cursor-pointer appearance-none">
                                    <option value="" selected>Select a category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-6 text-slate-400">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                            @error('category_id') <p class="mt-2 text-sm text-red-500 font-medium pl-1 flex items-center gap-1"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>{{ $message }}</p> @enderror
                        </div>
                        
                        <div class="space-y-2">
                            <label for="date" class="block text-xs font-black text-slate-500 uppercase tracking-widest pl-1">Date & Time <span class="text-red-500">*</span></label>
                            <input type="datetime-local" name="date" id="date" value="{{ old('date') }}" required class="w-full bg-white/80 backdrop-blur-md border border-slate-200/60 shadow-[inset_0_2px_4px_rgba(0,0,0,0.02)] rounded-2xl px-6 py-4 focus:ring-4 focus:ring-indigo-500/15 focus:border-indigo-400 focus:bg-white transition-all outline-none text-slate-700 font-medium font-mono">
                            @error('date') <p class="mt-2 text-sm text-red-500 font-medium pl-1 flex items-center gap-1"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>{{ $message }}</p> @enderror
                        </div>

                        <div class="col-span-1 md:col-span-2 space-y-2">
                            <label for="location" class="block text-xs font-black text-slate-500 uppercase tracking-widest pl-1">Venue Location <span class="text-red-500">*</span></label>
                            <input type="text" name="location" id="location" value="{{ old('location') }}" placeholder="Main Auditorium" required class="w-full bg-white/80 backdrop-blur-md border border-slate-200/60 shadow-[inset_0_2px_4px_rgba(0,0,0,0.02)] rounded-2xl px-6 py-4 focus:ring-4 focus:ring-indigo-500/15 focus:border-indigo-400 focus:bg-white transition-all outline-none text-slate-700 font-medium placeholder-slate-400">
                            @error('location') <p class="mt-2 text-sm text-red-500 font-medium pl-1 flex items-center gap-1"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>{{ $message }}</p> @enderror
                        </div>



                    </div>
                </section>

                <!-- Section 2: Additional Settings -->
                <section class="bg-white/60 backdrop-blur-3xl border border-white/80 rounded-[2.5rem] p-8 lg:p-12 shadow-[0_20px_80px_-20px_rgba(0,0,0,0.05)] relative overflow-hidden group">
                     <div class="absolute -bottom-32 -left-32 w-64 h-64 bg-gradient-to-br from-blue-200/40 to-cyan-200/40 rounded-full blur-[80px] pointer-events-none group-hover:from-blue-300/40 group-hover:to-cyan-300/40 transition-colors duration-700"></div>

                    <div class="flex items-center gap-5 mb-10 relative z-10">
                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-blue-500 to-cyan-500 shadow-lg shadow-blue-500/30 flex items-center justify-center text-white font-extrabold text-xl">2</div>
                        <div>
                            <h2 class="text-2xl font-black text-slate-900 tracking-tight">Additional Details</h2>
                            <p class="text-sm font-medium text-slate-500 mt-0.5">Control access, ticketing, and event formats.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 relative z-10">
                        
                        <!-- Organizing Departments -->
                        <div class="col-span-1 md:col-span-2 space-y-3" x-data="{
                            allSelected: false,
                            departments: {{ json_encode($departments->pluck('name')) }},
                            selected: {{ json_encode(old('organizing_departments', [])) }},
                            toggleAll() {
                                this.selected = this.allSelected ? [...this.departments] : [];
                            },
                            updateAllSelected() {
                                this.allSelected = this.departments.length > 0 && this.selected.length === this.departments.length;
                            }
                        }" x-init="updateAllSelected()">
                            <div class="flex items-center justify-between pl-1">
                                <label class="block text-xs font-black text-slate-500 uppercase tracking-widest">Organizing Departments <span class="text-slate-400 font-medium normal-case tracking-normal">(Optional)</span></label>
                                <label class="flex items-center cursor-pointer group">
                                    <input type="checkbox" x-model="allSelected" @change="toggleAll()" class="w-4 h-4 text-blue-600 border-slate-300 rounded focus:ring-blue-500 transition-colors">
                                    <span class="ml-2 text-[10px] font-black uppercase tracking-widest text-slate-400 group-hover:text-blue-600 transition-colors">Select All</span>
                                </label>
                            </div>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                                @foreach($departments as $department)
                                    <label class="flex items-center p-3 bg-white/50 border rounded-xl cursor-pointer hover:bg-white transition-all shadow-sm" :class="selected.includes('{{ $department->name }}') ? 'border-blue-400 ring-1 ring-blue-100 bg-blue-50/50' : 'border-slate-200 hover:border-blue-300'">
                                        <input type="checkbox" x-model="selected" @change="updateAllSelected()" name="organizing_departments[]" value="{{ $department->name }}" class="w-4 h-4 text-blue-600 border-slate-300 rounded focus:ring-blue-500">
                                        <span class="ml-2 text-sm font-bold text-slate-700">{{ $department->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                            @error('organizing_departments') <p class="mt-2 text-sm text-red-500 font-medium pl-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Audience Eligibility -->
                        <div class="col-span-1 md:col-span-2 space-y-4" x-data="{ openToAll: '{{ old('is_open_to_all', '1') }}' }">
                            <label class="block text-xs font-black text-slate-500 uppercase tracking-widest pl-1">Audience & Eligibility <span class="text-red-500">*</span></label>
                            
                            <div class="flex flex-col sm:flex-row gap-4">
                                <label class="flex-1 flex items-center p-4 bg-white/50 border rounded-2xl cursor-pointer transition-all" :class="openToAll === '1' ? 'border-blue-400 ring-2 ring-blue-100 bg-blue-50/50' : 'border-slate-200 hover:border-blue-200'">
                                    <input type="radio" name="is_open_to_all" value="1" x-model="openToAll" class="w-5 h-5 text-blue-600 focus:ring-blue-500 border-slate-300">
                                    <div class="ml-3">
                                        <span class="block text-sm font-black text-slate-800">Open to All College</span>
                                        <span class="block text-xs text-slate-500 font-medium mt-0.5">Any student can register</span>
                                    </div>
                                </label>
                                
                                <label class="flex-1 flex items-center p-4 bg-white/50 border rounded-2xl cursor-pointer transition-all" :class="openToAll === '0' ? 'border-blue-400 ring-2 ring-blue-100 bg-blue-50/50' : 'border-slate-200 hover:border-blue-200'">
                                    <input type="radio" name="is_open_to_all" value="0" x-model="openToAll" class="w-5 h-5 text-blue-600 focus:ring-blue-500 border-slate-300">
                                    <div class="ml-3">
                                        <span class="block text-sm font-black text-slate-800">Specific Departments Only</span>
                                        <span class="block text-xs text-slate-500 font-medium mt-0.5">Restrict registration access</span>
                                    </div>
                                </label>
                            </div>
                            
                            <div x-show="openToAll === '0'" x-transition.opacity.duration.300ms style="display: none;">
                                <div class="mt-4 p-5 bg-white/60 border border-slate-200 rounded-2xl shadow-inner" x-data="{
                                    allSelected: false,
                                    departments: {{ json_encode($departments->pluck('name')) }},
                                    selected: {{ json_encode(old('eligible_departments', [])) }},
                                    toggleAll() {
                                        this.selected = this.allSelected ? [...this.departments] : [];
                                    },
                                    updateAllSelected() {
                                        this.allSelected = this.departments.length > 0 && this.selected.length === this.departments.length;
                                    }
                                }" x-init="updateAllSelected()">
                                    <div class="flex flex-wrap gap-3 items-center justify-between mb-4">
                                        <p class="text-xs font-black text-slate-500 uppercase tracking-widest">Select Eligible Departments</p>
                                        <label class="flex items-center cursor-pointer group">
                                            <input type="checkbox" x-model="allSelected" @change="toggleAll()" class="w-4 h-4 text-emerald-500 border-slate-300 rounded focus:ring-emerald-500 transition-colors">
                                            <span class="ml-2 text-[10px] font-black uppercase tracking-widest text-slate-400 group-hover:text-emerald-500 transition-colors">Select All</span>
                                        </label>
                                    </div>
                                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                                        @foreach($departments as $department)
                                            <label class="flex items-center p-2 bg-white border rounded-lg cursor-pointer transition-all shadow-sm" :class="selected.includes('{{ $department->name }}') ? 'border-emerald-400 ring-1 ring-emerald-100 bg-emerald-50/50' : 'border-slate-100 hover:border-emerald-300'">
                                                <input type="checkbox" x-model="selected" @change="updateAllSelected()" name="eligible_departments[]" value="{{ $department->name }}" class="w-4 h-4 text-emerald-500 border-slate-300 rounded focus:ring-emerald-500">
                                                <span class="ml-2 text-xs font-bold text-slate-700">{{ $department->name }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                    @error('eligible_departments') <p class="mt-2 text-sm text-red-500 font-medium pl-1">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Event Formats & Ticket -->
                        <div class="space-y-2">
                            <label for="event_type" class="block text-xs font-black text-slate-500 uppercase tracking-widest pl-1">Event Format <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <select name="event_type" id="event_type" required class="w-full bg-white/70 backdrop-blur-md border border-white shadow-inner rounded-2xl px-6 py-4 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-300 focus:bg-white transition-all outline-none text-slate-800 font-bold cursor-pointer">
                                    <option value="Offline" selected>Offline (In-Person)</option>
                                    <option value="Online">Online (Virtual)</option>
                                    <option value="Hybrid">Hybrid</option>
                                </select>
                            </div>
                            @error('event_type') <p class="mt-2 text-sm text-red-500 font-medium pl-1 flex items-center gap-1"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>{{ $message }}</p> @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="ticket_price" class="block text-xs font-black text-slate-500 uppercase tracking-widest pl-1">Ticket Price <span class="text-slate-400 font-medium normal-case tracking-normal">(Leave 0 for Free)</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none text-slate-400 font-bold">$</div>
                                <input type="number" name="ticket_price" id="ticket_price" value="{{ old('ticket_price', 0) }}" min="0" step="0.01" class="w-full pl-12 bg-white/70 backdrop-blur-md border border-white shadow-inner rounded-2xl pr-6 py-4 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-300 focus:bg-white transition-all outline-none text-slate-700 font-bold font-mono">
                            </div>
                            @error('ticket_price') <p class="mt-2 text-sm text-red-500 font-medium pl-1 flex items-center gap-1"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>{{ $message }}</p> @enderror
                        </div>



                        <div class="space-y-2">
                            <label for="max_participants" class="block text-xs font-black text-slate-500 uppercase tracking-widest pl-1">Capacity <span class="text-slate-400 font-medium normal-case tracking-normal">(Optional)</span></label>
                            <input type="number" name="max_participants" id="max_participants" value="{{ old('max_participants') }}" min="1" placeholder="Leave empty for unlimited" class="w-full bg-white/70 backdrop-blur-md border border-white shadow-inner rounded-2xl px-6 py-4 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-300 focus:bg-white transition-all outline-none text-slate-700 font-medium placeholder-slate-400 font-mono">
                            @error('max_participants') <p class="mt-2 text-sm text-red-500 font-medium pl-1 flex items-center gap-1"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>{{ $message }}</p> @enderror
                        </div>

                        <div class="col-span-1 md:col-span-2 space-y-2">
                            <label for="description" class="block text-xs font-black text-slate-500 uppercase tracking-widest pl-1">Description / Brief <span class="text-red-500">*</span></label>
                            <textarea name="description" id="description" rows="5" required placeholder="Outline the event protocol, agenda, and requirements..." class="w-full bg-white/70 backdrop-blur-md border border-white shadow-inner rounded-2xl px-6 py-5 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-300 focus:bg-white transition-all outline-none text-slate-700 font-medium placeholder-slate-400 resize-y min-h-[150px] leading-relaxed">{{ old('description') }}</textarea>
                            @error('description') <p class="mt-2 text-sm text-red-500 font-medium pl-1 flex items-center gap-1"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>{{ $message }}</p> @enderror
                        </div>
                    </div>
                </section>

                <!-- Section 3: Media Assets -->
                <section class="bg-white/60 backdrop-blur-3xl border border-white/80 rounded-[2.5rem] p-8 lg:p-12 shadow-[0_20px_80px_-20px_rgba(0,0,0,0.05)] relative overflow-hidden group">
                    <div class="absolute -top-32 -left-32 w-64 h-64 bg-gradient-to-br from-pink-200/40 to-rose-200/40 rounded-full blur-[80px] pointer-events-none group-hover:from-pink-300/40 group-hover:to-rose-300/40 transition-colors duration-700"></div>
                    
                    <div class="flex items-center gap-5 mb-10 relative z-10">
                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-pink-500 to-rose-600 shadow-lg shadow-pink-500/30 flex items-center justify-center text-white font-extrabold text-xl">3</div>
                        <div>
                            <h2 class="text-2xl font-black text-slate-900 tracking-tight">Media Assets</h2>
                            <p class="text-sm font-medium text-slate-500 mt-0.5">Upload a cover image and promotional video.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 relative z-10">
                        <!-- Image Upload -->
                        <div class="space-y-4" x-data="{ 
                            preview: null,
                            handleFile(e) {
                                const file = e.target.files[0];
                                if (file) {
                                    const reader = new FileReader();
                                    reader.onload = (e) => this.preview = e.target.result;
                                    reader.readAsDataURL(file);
                                }
                            }
                        }">
                            <label class="block text-xs font-black text-slate-500 uppercase tracking-widest pl-1">Event Cover Image <span class="text-slate-400 font-medium normal-case tracking-normal">(Max 5MB)</span></label>
                            
                            <div class="relative group/img">
                                <template x-if="preview">
                                    <div class="relative w-full aspect-video rounded-3xl overflow-hidden border-2 border-slate-200 shadow-xl group/preview">
                                        <img :src="preview" class="w-full h-full object-cover">
                                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover/preview:opacity-100 transition-opacity flex items-center justify-center">
                                            <button type="button" @click="preview = null; $refs.imageInput.value = ''" class="px-4 py-2 bg-white text-red-600 rounded-xl font-bold text-xs shadow-lg hover:bg-red-50 transition-colors">Remove Image</button>
                                        </div>
                                    </div>
                                </template>
                                
                                <template x-if="!preview">
                                    <div @click="$refs.imageInput.click()" class="w-full aspect-video rounded-3xl border-2 border-dashed border-slate-300 bg-slate-50/50 hover:bg-white hover:border-pink-400 transition-all cursor-pointer flex flex-col items-center justify-center gap-4 group/box">
                                        <div class="w-14 h-14 rounded-2xl bg-white shadow-sm border border-slate-200 flex items-center justify-center text-slate-400 group-hover/box:text-pink-500 group-hover/box:scale-110 transition-all duration-300">
                                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                        <div class="text-center">
                                            <p class="text-sm font-black text-slate-700">Click to upload image</p>
                                            <p class="text-[10px] text-slate-400 font-bold uppercase mt-1 tracking-widest">PNG, JPG or WebP</p>
                                        </div>
                                    </div>
                                </template>
                                
                                <input type="file" name="image" x-ref="imageInput" @change="handleFile" accept="image/*" class="hidden">
                            </div>
                            @error('image') <p class="mt-2 text-sm text-red-500 font-medium pl-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Video Upload -->
                        <div class="space-y-4" x-data="{ 
                            videoName: null,
                            handleFile(e) {
                                const file = e.target.files[0];
                                if (file) this.videoName = file.name;
                            }
                        }">
                            <label class="block text-xs font-black text-slate-500 uppercase tracking-widest pl-1">Event Video <span class="text-slate-400 font-medium normal-case tracking-normal">(Max 20MB)</span></label>
                            
                            <div class="relative group/vid">
                                <template x-if="videoName">
                                    <div class="relative w-full aspect-video rounded-3xl overflow-hidden border-2 border-slate-200 bg-slate-900 shadow-xl flex items-center justify-center p-8 text-center group/preview">
                                        <div class="space-y-4">
                                            <div class="w-16 h-16 rounded-full bg-blue-600/20 text-blue-400 flex items-center justify-center mx-auto">
                                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                            </div>
                                            <p class="text-blue-200 font-bold text-sm truncate max-w-xs" x-text="videoName"></p>
                                            <button type="button" @click="videoName = null; $refs.videoInput.value = ''" class="px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-xl font-bold text-xs shadow-lg backdrop-blur-md transition-colors border border-white/20">Replace Video</button>
                                        </div>
                                    </div>
                                </template>
                                
                                <template x-if="!videoName">
                                    <div @click="$refs.videoInput.click()" class="w-full aspect-video rounded-3xl border-2 border-dashed border-slate-300 bg-slate-50/50 hover:bg-white hover:border-blue-400 transition-all cursor-pointer flex flex-col items-center justify-center gap-4 group/box">
                                        <div class="w-14 h-14 rounded-2xl bg-white shadow-sm border border-slate-200 flex items-center justify-center text-slate-400 group-hover/box:text-blue-500 group-hover/box:scale-110 transition-all duration-300">
                                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                        </div>
                                        <div class="text-center">
                                            <p class="text-sm font-black text-slate-700">Click to upload video</p>
                                            <p class="text-[10px] text-slate-400 font-bold uppercase mt-1 tracking-widest">MP4 or MOV</p>
                                        </div>
                                    </div>
                                </template>
                                
                                <input type="file" name="video" x-ref="videoInput" @change="handleFile" accept="video/*" class="hidden">
                            </div>
                            @error('video') <p class="mt-2 text-sm text-red-500 font-medium pl-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </section>

                <!-- Section 4: Organizing Team -->
                <section class="bg-white/60 backdrop-blur-3xl border border-white/80 rounded-[2.5rem] p-8 lg:p-12 shadow-[0_20px_80px_-20px_rgba(0,0,0,0.05)] relative z-40 overflow-visible group"
                    x-data="{ 
                        selectedHeadFacultyId: '',
                        selectedStaffIds: [],
                        selectedVolunteerIds: [],
                        facultyList: {{ $faculty->toJson() }},
                        studentList: {{ $students->toJson() }},
                        get headFaculty() { return this.facultyList.find(f => f.id == this.selectedHeadFacultyId) },
                        get staffMembers() { return this.facultyList.filter(f => this.selectedStaffIds.includes(f.id.toString())) },
                        get volunteers() { return this.studentList.filter(s => this.selectedVolunteerIds.includes(s.id.toString())) }
                    }">
                    <div class="absolute top-1/2 -right-32 w-64 h-64 bg-gradient-to-br from-emerald-200/40 to-teal-200/40 rounded-full blur-[80px] pointer-events-none group-hover:from-emerald-300/40 group-hover:to-teal-300/40 transition-colors duration-700"></div>
                    
                    <div class="flex items-center gap-5 mb-10 relative z-10">
                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-500 shadow-lg shadow-emerald-500/30 flex items-center justify-center text-white font-extrabold text-xl">3</div>
                        <div>
                            <h2 class="text-2xl font-black text-slate-900 tracking-tight">Organizing Team</h2>
                            <p class="text-sm font-medium text-slate-500 mt-0.5">Assign faculty and students to manage this event.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 relative z-10">
                        <!-- Head Faculty Assignee -->
                        <div class="space-y-4 relative z-[60]">
                            <label class="block text-xs font-black text-slate-500 uppercase tracking-widest pl-1">Head Faculty / Lead Organizer <span class="text-red-500">*</span></label>
                            
                            <!-- Custom Single Select for Head Faculty -->
                            <div class="relative" x-data="{ open: false, search: '' }">
                                <!-- Hidden Native Select for Form Submission -->
                                <select name="head_faculty_id" x-model="selectedHeadFacultyId" required class="sr-only">
                                    <option value="">Select Head Faculty</option>
                                    <template x-for="f in facultyList" :key="f.id">
                                        <option :value="f.id" x-text="f.name"></option>
                                    </template>
                                </select>
                                
                                <button @click="open = !open" @click.away="open = false" type="button" class="w-full bg-white/80 backdrop-blur-md border border-slate-200/60 shadow-[inset_0_2px_4px_rgba(0,0,0,0.02)] rounded-2xl px-6 py-4 focus:ring-4 focus:ring-emerald-500/15 focus:border-emerald-400 focus:bg-white transition-all outline-none text-slate-800 font-bold cursor-pointer flex justify-between items-center group min-h-[58px]">
                                    <span class="truncate" x-text="headFaculty ? headFaculty.name : 'Select Head Faculty'"></span>
                                    <div class="w-6 h-6 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 group-hover:bg-emerald-100 group-hover:text-emerald-600 transition-colors shrink-0">
                                        <svg class="w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>
                                </button>
                                
                                <div x-show="open" x-transition.opacity.duration.200ms style="display: none;" class="absolute z-[70] w-full mt-2 bg-white rounded-2xl shadow-[0_20px_60px_-15px_rgba(0,0,0,0.3)] border border-slate-200 overflow-hidden">
                                    <div class="p-3 border-b border-slate-100/50 bg-slate-50/50">
                                        <div class="relative">
                                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                            <input type="text" x-model="search" @click.stop placeholder="Search faculty by name..." class="w-full pl-9 pr-4 py-2 bg-white border border-slate-200 rounded-xl text-sm font-medium focus:ring-2 focus:ring-blue-500/20 focus:border-blue-400 outline-none transition-all placeholder-slate-400 text-slate-700 shadow-inner">
                                        </div>
                                    </div>
                                    <ul class="max-h-64 overflow-y-auto p-2 space-y-1">
                                        <template x-for="f in facultyList.filter(f => f.name.toLowerCase().includes(search.toLowerCase()))" :key="f.id">
                                            <li @click="selectedHeadFacultyId = f.id; open = false; search = ''" 
                                                class="px-4 py-3 rounded-xl cursor-pointer transition-all flex flex-col hover:bg-blue-50/80 border border-transparent hover:border-blue-100 group"
                                                :class="selectedHeadFacultyId == f.id ? 'bg-blue-50/80 border-blue-200 shadow-sm' : ''">
                                                <div class="flex justify-between items-center mb-1 gap-2">
                                                    <span class="font-extrabold text-slate-800 text-sm group-hover:text-blue-700 transition-colors truncate" x-text="f.name"></span>
                                                    <span class="text-[9px] font-black uppercase tracking-widest text-indigo-600 bg-indigo-100/50 px-2 py-0.5 rounded shadow-sm border border-indigo-100/50 shrink-0" x-text="f.designation || 'Faculty'"></span>
                                                </div>
                                                <div class="flex items-center gap-2 text-xs">
                                                    <span class="text-slate-500 font-bold truncate" x-text="f.department ? f.department.name : 'No Department'"></span>
                                                </div>
                                            </li>
                                        </template>
                                        <li x-show="facultyList.filter(f => f.name.toLowerCase().includes(search.toLowerCase())).length === 0" class="px-4 py-6 text-center">
                                            <p class="text-sm font-bold text-slate-500">No faculty found</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Faculty Profile Card (Visible when selected) -->
                            <template x-if="headFaculty">
                                <div class="p-5 bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-100 rounded-2xl flex items-center gap-4 shadow-sm animate-fade-in">
                                    <div class="w-12 h-12 rounded-full bg-blue-600 flex items-center justify-center text-white font-black text-lg shadow-lg shrink-0" x-text="headFaculty.name.charAt(0)"></div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="font-black text-slate-800 text-sm truncate" x-text="headFaculty.name"></h4>
                                        <div class="flex flex-wrap gap-2 mt-1">
                                            <span class="text-[10px] font-black uppercase tracking-widest text-blue-600 bg-blue-100/50 px-2 py-0.5 rounded truncate max-w-full" x-text="headFaculty.department ? headFaculty.department.name : 'General'"></span>
                                            <span class="text-[10px] font-bold text-slate-500 truncate w-full" x-text="headFaculty.email"></span>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>

                        <!-- Co-Organizing Staff -->
                        <div class="space-y-4 relative z-[50]">
                            <label class="block text-xs font-black text-slate-500 uppercase tracking-widest pl-1">Co-Organizing Staff <span class="text-slate-400 font-medium normal-case tracking-normal">(Multi-select)</span></label>
                            
                            <!-- Custom Multi-Select for Staff -->
                            <div class="relative" x-data="{ open: false, search: '' }" @click.away="open = false; search = ''">
                                <!-- Hidden Native Selects for Form Submission -->
                                <select name="staff_ids[]" multiple class="hidden">
                                    <template x-for="id in selectedStaffIds">
                                        <option :value="id" selected></option>
                                    </template>
                                </select>

                                <!-- Trigger Area -->
                                <div @click="open = true" class="w-full min-h-[58px] bg-white/80 backdrop-blur-md border border-slate-200/60 shadow-[inset_0_2px_4px_rgba(0,0,0,0.02)] rounded-2xl p-2.5 cursor-text flex flex-wrap gap-2 items-center focus-within:ring-4 focus-within:ring-indigo-500/15 focus-within:border-indigo-400 transition-all">
                                    <!-- Selected Chips -->
                                    <template x-for="staff in staffMembers" :key="staff.id">
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-indigo-50/80 border border-indigo-100/50 text-indigo-800 text-xs font-bold shadow-sm animate-fade-in group">
                                            <div class="w-4 h-4 rounded-full bg-indigo-200/50 flex items-center justify-center text-[8px] font-black text-indigo-700 shrink-0" x-text="staff.name.charAt(0)"></div>
                                            <span class="truncate max-w-[120px]" x-text="staff.name"></span>
                                            <button type="button" @click.stop="selectedStaffIds = selectedStaffIds.filter(id => id !== staff.id.toString())" class="w-4 h-4 rounded-full hover:bg-indigo-200/80 flex items-center justify-center text-indigo-400 hover:text-indigo-900 transition-colors focus:outline-none shrink-0">
                                                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                                            </button>
                                        </span>
                                    </template>
                                    
                                    <!-- Search Input -->
                                    <input x-ref="searchInput" type="text" x-model="search" @focus="open = true" @keydown.backspace="search === '' && selectedStaffIds.length > 0 ? selectedStaffIds.pop() : null" 
                                        class="flex-1 min-w-[150px] bg-transparent border-none focus:ring-0 p-1 text-sm font-bold text-slate-700 placeholder-slate-400 outline-none" 
                                        :placeholder="selectedStaffIds.length === 0 ? 'Search & select staff...' : 'Add more...'">
                                    
                                    <!-- Dropdown Indicator -->
                                    <div class="w-6 h-6 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 mr-1 self-start mt-0.5 pointer-events-none shrink-0 border border-slate-100 shadow-inner">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>
                                </div>

                                <!-- Dropdown Menu -->
                                <div x-show="open" x-transition.opacity.duration.200ms style="display: none;" class="absolute z-[70] w-full mt-2 bg-white rounded-2xl shadow-[0_20px_60px_-15px_rgba(0,0,0,0.3)] border border-slate-200 overflow-hidden">
                                    <ul class="max-h-64 overflow-y-auto p-2 space-y-1 custom-scrollbar">
                                        <template x-for="f in facultyList.filter(f => f.name.toLowerCase().includes(search.toLowerCase()) && f.id != selectedHeadFacultyId)" :key="f.id">
                                            <li @click="selectedStaffIds.includes(f.id.toString()) ? selectedStaffIds = selectedStaffIds.filter(id => id !== f.id.toString()) : (selectedStaffIds.push(f.id.toString()), search = ''); $refs.searchInput && $refs.searchInput.focus()" 
                                                class="px-4 py-3 rounded-xl cursor-pointer transition-all flex items-center justify-between hover:bg-indigo-50/50 border border-transparent group"
                                                :class="selectedStaffIds.includes(f.id.toString()) ? 'bg-indigo-50/80 border-indigo-200 shadow-sm' : ''">
                                                
                                                <div class="flex-1 min-w-0 pr-4">
                                                    <div class="flex items-center gap-2 mb-1 cursor-pointer">
                                                        <span class="font-extrabold text-sm truncate uppercase tracking-tight" :class="selectedStaffIds.includes(f.id.toString()) ? 'text-indigo-800' : 'text-slate-800 group-hover:text-indigo-700'" x-text="f.name"></span>
                                                        <span class="text-[8px] font-black uppercase tracking-widest text-slate-500 bg-slate-100 px-2 py-0.5 rounded-md border border-slate-200 shrink-0" x-text="f.designation || 'Faculty'"></span>
                                                    </div>
                                                    <div class="flex items-center gap-1.5 text-[10px] text-slate-400 font-bold uppercase tracking-widest">
                                                        <span class="truncate" x-text="f.department ? f.department.name : 'No Department'"></span>
                                                    </div>
                                                </div>
                                                
                                                <div class="w-5 h-5 rounded-md border-2 flex items-center justify-center transition-all shrink-0" 
                                                    :class="selectedStaffIds.includes(f.id.toString()) ? 'bg-indigo-500 border-indigo-500 text-white shadow-md scale-110' : 'bg-white border-slate-300 text-transparent group-hover:border-indigo-400'">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                                </div>
                                            </li>
                                        </template>
                                        <li x-show="facultyList.filter(f => f.name.toLowerCase().includes(search.toLowerCase()) && f.id != selectedHeadFacultyId).length === 0" class="px-4 py-6 text-center">
                                            <p class="text-sm font-bold text-slate-500">No staff members found matching "<span x-text="search" class="text-slate-800"></span>"</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Student Volunteers -->
                        <div class="col-span-1 md:col-span-2 space-y-4 relative z-[40]">
                            <label class="block text-xs font-black text-slate-500 uppercase tracking-widest pl-1">Student Volunteers (Point of Contacts)</label>
                            
                            <!-- Custom Multi-Select for Volunteers -->
                            <div class="relative" x-data="{ open: false, search: '' }" @click.away="open = false; search = ''">
                                <!-- Hidden Native Selects for Form Submission -->
                                <select name="volunteer_ids[]" multiple class="hidden">
                                    <template x-for="id in selectedVolunteerIds">
                                        <option :value="id" selected></option>
                                    </template>
                                </select>

                                <!-- Trigger Area -->
                                <div @click="open = true" class="w-full min-h-[58px] bg-white/80 backdrop-blur-md border border-slate-200/60 shadow-[inset_0_2px_4px_rgba(0,0,0,0.02)] rounded-2xl p-2.5 cursor-text flex flex-wrap gap-2 items-center focus-within:ring-4 focus-within:ring-emerald-500/15 focus-within:border-emerald-400 transition-all">
                                    <!-- Selected Chips -->
                                    <template x-for="vol in volunteers" :key="vol.id">
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-emerald-50/80 border border-emerald-100/50 text-emerald-800 text-xs font-bold shadow-sm animate-fade-in group">
                                            <div class="w-4 h-4 rounded-full bg-emerald-200/50 flex items-center justify-center text-[8px] font-black text-emerald-700 shrink-0" x-text="vol.name.charAt(0)"></div>
                                            <span class="truncate max-w-[120px]" x-text="vol.name"></span>
                                            <button type="button" @click.stop="selectedVolunteerIds = selectedVolunteerIds.filter(id => id !== vol.id.toString())" class="w-4 h-4 rounded-full hover:bg-emerald-200/80 flex items-center justify-center text-emerald-500 hover:text-emerald-900 transition-colors focus:outline-none shrink-0">
                                                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                                            </button>
                                        </span>
                                    </template>
                                    
                                    <!-- Search Input -->
                                    <input x-ref="searchVol" type="text" x-model="search" @focus="open = true" @keydown.backspace="search === '' && selectedVolunteerIds.length > 0 ? selectedVolunteerIds.pop() : null" 
                                        class="flex-1 min-w-[150px] bg-transparent border-none focus:ring-0 p-1 text-sm font-bold text-slate-700 placeholder-slate-400 outline-none" 
                                        :placeholder="selectedVolunteerIds.length === 0 ? 'Search & select students...' : 'Add more...'">
                                    
                                    <!-- Dropdown Indicator -->
                                    <div class="w-6 h-6 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 mr-1 self-start mt-0.5 pointer-events-none shrink-0 border border-slate-100 shadow-inner">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>
                                </div>

                                <!-- Dropdown Menu -->
                                <div x-show="open" x-transition.opacity.duration.200ms style="display: none;" class="absolute z-[70] w-full mt-2 bg-white rounded-2xl shadow-[0_20px_60px_-15px_rgba(0,0,0,0.3)] border border-slate-200 overflow-hidden">
                                    <ul class="max-h-64 overflow-y-auto p-2 space-y-1 custom-scrollbar">
                                        <template x-for="s in studentList.filter(s => s.name.toLowerCase().includes(search.toLowerCase()))" :key="s.id">
                                            <li @click="selectedVolunteerIds.includes(s.id.toString()) ? selectedVolunteerIds = selectedVolunteerIds.filter(id => id !== s.id.toString()) : (selectedVolunteerIds.push(s.id.toString()), search = ''); $refs.searchVol && $refs.searchVol.focus()" 
                                                class="px-4 py-3 rounded-xl cursor-pointer transition-all flex items-center justify-between hover:bg-emerald-50/50 border border-transparent group"
                                                :class="selectedVolunteerIds.includes(s.id.toString()) ? 'bg-emerald-50/80 border-emerald-200 shadow-sm' : ''">
                                                
                                                <div class="flex-1 min-w-0 pr-4">
                                                    <div class="flex items-center gap-2 mb-1 cursor-pointer">
                                                        <span class="font-extrabold text-sm truncate uppercase tracking-tight" :class="selectedVolunteerIds.includes(s.id.toString()) ? 'text-emerald-800' : 'text-slate-800 group-hover:text-emerald-700'" x-text="s.name"></span>
                                                        <span class="text-[8px] font-black uppercase tracking-widest text-emerald-500 bg-emerald-50 px-2 py-0.5 rounded-md border border-emerald-100 shrink-0">Student</span>
                                                    </div>
                                                    <div class="flex items-center gap-1.5 text-[10px] text-slate-400 font-bold uppercase tracking-widest">
                                                        <span class="truncate" x-text="s.email"></span>
                                                    </div>
                                                </div>
                                                
                                                <div class="w-5 h-5 rounded-md border-2 flex items-center justify-center transition-all shrink-0" 
                                                    :class="selectedVolunteerIds.includes(s.id.toString()) ? 'bg-emerald-500 border-emerald-500 text-white shadow-md scale-110' : 'bg-white border-slate-300 text-transparent group-hover:border-emerald-400'">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                                </div>
                                            </li>
                                        </template>
                                        <li x-show="studentList.filter(s => s.name.toLowerCase().includes(search.toLowerCase())).length === 0" class="px-4 py-6 text-center">
                                            <p class="text-sm font-bold text-slate-500">No students found matching "<span x-text="search" class="text-slate-800"></span>"</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </section>

                <!-- Section 5: Form Builder (Dynamic Alpine.js Component) -->
                <section class="bg-white/60 backdrop-blur-3xl border border-white/80 rounded-[2.5rem] p-8 lg:p-12 shadow-[0_20px_80px_-20px_rgba(0,0,0,0.05)] relative overflow-visible group">
                    <div class="absolute -bottom-32 -left-32 w-64 h-64 bg-gradient-to-br from-purple-200/40 to-pink-200/40 rounded-full blur-[80px] pointer-events-none group-hover:from-purple-300/40 group-hover:to-pink-300/40 transition-colors duration-700"></div>

                    <!-- Hidden input to submit the serialized fields to the controller -->
                    <input type="hidden" name="custom_fields" :value="JSON.stringify(fields)">

                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-10 gap-4 relative z-10">
                        <div class="flex items-center gap-5">
                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-purple-500 to-pink-500 shadow-lg shadow-purple-500/30 flex items-center justify-center text-white font-extrabold text-xl">5</div>
                            <div>
                                <h2 class="text-2xl font-black text-slate-900 tracking-tight">Form Builder <span class="text-[10px] uppercase font-bold text-white bg-gradient-to-r from-purple-500 to-pink-500 px-2 py-1 rounded-md ml-2 align-middle shadow-sm">Interactive</span></h2>
                                <p class="text-sm font-medium text-slate-500 mt-0.5">Define data collection blocks dynamically.</p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-5 relative z-10">
                        <!-- Locked Static Block -->
                        <div class="group relative bg-white/50 backdrop-blur-md border border-white/80 rounded-[1.5rem] p-6 flex flex-col md:flex-row items-center justify-between hover:bg-white/80 transition-colors shadow-[0_10px_20px_-5px_rgba(0,0,0,0.02)] hover:shadow-[0_15px_30px_-5px_rgba(0,0,0,0.05)] cursor-default">
                            <div class="flex items-center gap-5 w-full">
                                <div class="text-slate-300 opacity-50 cursor-not-allowed">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M7 10h10v2H7zM7 14h10v2H7z"/></svg>
                                </div>
                                <div>
                                    <p class="font-black text-slate-800 text-lg">Identity Block</p>
                                    <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest mt-1">System Core • Includes Name & Email</p>
                                </div>
                            </div>
                            <div class="mt-4 md:mt-0 px-3 py-1 bg-slate-100 text-slate-500 text-xs font-bold rounded-lg border border-slate-200">Locked</div>
                        </div>

                        <!-- Alpine.js Dynamic Blocks -->
                        <template x-for="(field, index) in fields" :key="field.id">
                            <div class="animate-fade-in relative bg-white/90 backdrop-blur-xl border border-indigo-100 rounded-[1.5rem] p-6 shadow-[0_30px_60px_-15px_rgba(79,70,229,0.15)] z-20 hover:-translate-y-1 transition-transform duration-300">
                                <!-- Left grip handle -->
                                <div class="absolute inset-y-0 left-0 w-8 flex items-center justify-center cursor-move text-slate-300 opacity-50 hover:opacity-100 hover:text-indigo-500 transition-all rounded-l-[1.5rem]">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M7 10h10v2H7zM7 14h10v2H7z"/></svg>
                                </div>
    
                                <div class="pl-6">
                                    <!-- Top Bar: Type Selector & Actions -->
                                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6 pb-6 border-b border-slate-100/80">
                                        <div class="relative w-full sm:w-[250px] shrink-0">
                                            <select x-model="field.type" class="w-full text-xs font-black uppercase tracking-widest text-indigo-600 bg-indigo-50/70 hover:bg-indigo-100/70 border border-indigo-100 rounded-xl px-4 py-3 appearance-none focus:ring-0 outline-none cursor-pointer transition-colors shadow-sm">
                                                <option value="Section Heading">Section Heading</option>
                                                <option value="Short Answer">Short Answer</option>
                                                <option value="Paragraph">Paragraph</option>
                                                <option value="Multiple Choice">Multiple Choice</option>
                                                <option value="Checkboxes">Checkboxes</option>
                                                <option value="Dropdown">Dropdown</option>
                                                <option value="File Upload">File Upload</option>
                                                <option value="Date">Date</option>
                                                <option value="Time">Time</option>
                                                <option value="Number">Number</option>
                                                <option value="Website URL">Website URL</option>
                                            </select>
                                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-indigo-400">
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                                            </div>
                                        </div>
                                        
                                        <div class="flex items-center gap-1 bg-slate-50 border border-slate-100 rounded-xl p-1 shrink-0 shadow-sm w-full sm:w-auto justify-center sm:justify-start">
                                            <button type="button" @click="moveUp(index)" :disabled="index === 0" class="text-slate-400 hover:text-indigo-500 hover:bg-white p-2.5 rounded-lg transition-all disabled:opacity-30 disabled:hover:bg-transparent disabled:hover:text-slate-400" title="Move Up">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 15l7-7 7 7"></path></svg>
                                            </button>
                                            <button type="button" @click="moveDown(index)" :disabled="index === fields.length - 1" class="text-slate-400 hover:text-indigo-500 hover:bg-white p-2.5 rounded-lg transition-all disabled:opacity-30 disabled:hover:bg-transparent disabled:hover:text-slate-400" title="Move Down">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                                            </button>
                                            <div class="w-px h-5 bg-slate-200 mx-1"></div>
                                            <button type="button" @click="duplicateField(index)" class="text-slate-400 hover:text-emerald-500 hover:bg-white p-2.5 rounded-lg transition-all" title="Duplicate Field">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                            </button>
                                            <button type="button" @click="removeField(index)" class="text-slate-400 hover:text-red-500 hover:bg-red-50 p-2.5 rounded-lg transition-all" title="Delete Field">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <!-- Title and Description (Stacked and prominent) -->
                                    <div class="mb-8 flex flex-col gap-3">
                                        <input type="text" x-model="field.title" class="w-full font-black text-slate-800 text-2xl bg-slate-50/50 hover:bg-slate-50 focus:bg-white border-2 border-transparent hover:border-slate-200 focus:border-indigo-400 rounded-xl px-4 py-3 md:px-5 md:py-4 focus:ring-4 focus:ring-indigo-50 transition-all outline-none placeholder-slate-300 shadow-sm" placeholder="Question or Section Title...">
                                        <input type="text" x-model="field.helpText" class="w-full text-sm font-bold text-slate-500 bg-transparent hover:bg-slate-50 focus:bg-white border-2 border-transparent hover:border-slate-200 focus:border-indigo-300 rounded-lg px-4 py-2 md:px-5 md:py-2 focus:ring-4 focus:ring-indigo-50 transition-all outline-none placeholder-slate-300/70" placeholder="Optional description or hint...">
                                    </div>
                                    
                                    <!-- Options Area for Choices -->
                                    <div class="space-y-3" x-show="['Multiple Choice', 'Checkboxes', 'Dropdown'].includes(field.type)" style="display: none;">
                                        <template x-for="(option, optIndex) in field.options" :key="optIndex">
                                            <div class="flex items-center gap-3 group mb-2">
                                                <div class="flex items-center justify-center text-slate-300 text-[10px] font-bold transition-all shrink-0" :class="field.type === 'Multiple Choice' ? 'w-5 h-5 border-2 border-slate-300 group-hover:border-indigo-400 rounded-full' : (field.type === 'Dropdown' ? 'w-5 h-5 group-hover:text-indigo-400' : 'w-5 h-5 border-2 border-slate-300 group-hover:border-indigo-400 rounded-[4px]')">
                                                    <span x-show="field.type === 'Dropdown'" x-text="optIndex + 1 + '.'"></span>
                                                </div>
                                                <input type="text" x-model="field.options[optIndex]" class="w-full text-sm font-bold text-slate-700 bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all placeholder-slate-400" placeholder="Option text">
                                                <button type="button" @click="removeOption(index, optIndex)" class="text-slate-300 hover:text-red-500 hover:bg-red-50 p-2 rounded-lg transition-all focus:outline-none shrink-0" title="Remove Option"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                                            </div>
                                        </template>
                                        <div class="flex items-center gap-3 pt-2 group cursor-pointer" @click="addOption(index)">
                                            <div class="w-5 h-5 flex items-center justify-center shrink-0">
                                                <svg class="w-5 h-5 text-slate-400 group-hover:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                                            </div>
                                            <span class="text-sm font-bold text-slate-500 group-hover:text-indigo-600 transition-colors bg-slate-100/50 group-hover:bg-slate-100 px-3 py-2 rounded-lg border border-transparent group-hover:border-slate-200 w-full text-left">Add option</span>
                                        </div>
                                    </div>
    
                                    <!-- Text Areas -->
                                    <div class="space-y-3" x-show="field.type === 'Short Answer'" style="display: none;">
                                        <input type="text" disabled class="w-full md:w-1/2 bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-400 cursor-not-allowed shadow-inner mt-2" placeholder="Short answer text...">
                                    </div>
                                    <div class="space-y-3" x-show="field.type === 'Paragraph'" style="display: none;">
                                        <textarea disabled rows="3" class="w-full md:w-3/4 bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-400 cursor-not-allowed shadow-inner mt-2" placeholder="Long answer text..."></textarea>
                                    </div>
    
                                    <!-- File Upload Area -->
                                    <div class="space-y-3" x-show="field.type === 'File Upload'" style="display: none;">
                                        <div class="border-2 border-dashed border-slate-300 rounded-2xl p-6 flex flex-col items-center justify-center gap-2 bg-slate-50/50 w-full md:w-1/2 cursor-not-allowed mt-2">
                                            <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                            <span class="text-sm text-slate-500 font-bold">File Upload</span>
                                            <span class="text-xs text-slate-400">Respondents will upload a file here</span>
                                        </div>
                                    </div>

                                    <!-- Other simple inputs (Date, Time, Number, URL) -->
                                    <div class="space-y-3 mt-2" x-show="['Date', 'Time', 'Number', 'Website URL'].includes(field.type)" style="display: none;">
                                        <input x-show="field.type === 'Date'" type="date" disabled class="w-full md:w-1/3 bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-400 cursor-not-allowed shadow-inner">
                                        <input x-show="field.type === 'Time'" type="time" disabled class="w-full md:w-1/3 bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-400 cursor-not-allowed shadow-inner">
                                        <input x-show="field.type === 'Number'" type="number" disabled class="w-full md:w-1/3 bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-400 cursor-not-allowed shadow-inner" placeholder="0">
                                        <input x-show="field.type === 'Website URL'" type="url" disabled class="w-full md:w-1/2 bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-400 cursor-not-allowed shadow-inner" placeholder="https://example.com">
                                    </div>
                                    
                                    <div class="mt-6 pt-4 border-t border-slate-100 flex justify-end items-center gap-4" x-show="field.type !== 'Section Heading'">
                                        <label class="flex items-center cursor-pointer opacity-70 hover:opacity-100 transition-opacity">
                                            <span class="mr-3 text-xs font-black text-slate-500 uppercase tracking-widest">Required Check</span>
                                            <div class="relative">
                                                <input type="checkbox" x-model="field.required" class="sr-only">
                                                <div class="block w-10 h-6 rounded-full shadow-inner transition-colors duration-300" :class="field.required ? 'bg-indigo-400' : 'bg-slate-200'"></div>
                                                <div class="dot absolute left-1 top-1 w-4 h-4 rounded-full transition-transform duration-300 shadow-sm" :class="field.required ? 'translate-x-4 bg-white' : 'bg-slate-100'"></div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </template>

                    </div>

                    <button type="button" @click="addField()" class="mt-8 relative group w-full p-1 cursor-pointer overflow-hidden rounded-[1.5rem] bg-transparent transform-gpu hover:shadow-[0_0_40px_rgba(99,102,241,0.2)] transition-all duration-500 outline-none">
                        <!-- Animated glowing border effect -->
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-300 via-indigo-500 to-purple-500 opacity-20 group-hover:opacity-100 group-hover:blur-sm transition-opacity duration-500 animate-[spin_3s_linear_infinite]"></div>
                        
                        <div class="relative flex items-center justify-center gap-3 w-full py-5 border-2 border-transparent bg-white/70 backdrop-blur-xl group-hover:bg-white/90 rounded-[1.3rem] text-slate-500 group-hover:text-indigo-600 font-extrabold transition-colors">
                            <svg class="w-5 h-5 drop-shadow-sm group-hover:scale-125 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            <span class="uppercase tracking-widest text-sm">Add New Protocol Field</span>
                        </div>
                    </button>
                </section>
            </div>
            
            <div class="mt-8 flex justify-end lg:hidden">
                 <button type="submit" class="w-full text-center px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white border border-blue-700 rounded-2xl font-bold shadow-md hover:shadow-lg transition flex items-center justify-center gap-2">
                    {{ auth()->user()->isStudent() ? 'Submit Proposal' : 'Publish Event' }}
                </button>
            </div>
        </form>
    </div>

    <!-- Alpine.js Application Logic -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('eventForm', () => ({
                fields: [
                    { id: Date.now(), title: 'Dietary Requirements', helpText: '', type: 'Checkboxes', required: false, options: ['Vegetarian', 'Vegan'] }
                ],
                
                addField() {
                    this.fields.push({
                        id: Date.now(),
                        title: '',
                        helpText: '',
                        type: 'Short Answer',
                        required: false,
                        options: ['Option 1']
                    });
                },
                
                duplicateField(index) {
                    let field = JSON.parse(JSON.stringify(this.fields[index]));
                    field.id = Date.now();
                    this.fields.splice(index + 1, 0, field);
                },

                moveUp(index) {
                    if (index > 0) {
                        let temp = this.fields[index];
                        this.fields[index] = this.fields[index - 1];
                        this.fields[index - 1] = temp;
                    }
                },

                moveDown(index) {
                    if (index < this.fields.length - 1) {
                        let temp = this.fields[index];
                        this.fields[index] = this.fields[index + 1];
                        this.fields[index + 1] = temp;
                    }
                },
                
                removeField(index) {
                    this.fields.splice(index, 1);
                },
                
                addOption(fieldIndex) {
                    this.fields[fieldIndex].options.push('New Option');
                },
                
                removeOption(fieldIndex, optionIndex) {
                    this.fields[fieldIndex].options.splice(optionIndex, 1);
                }
            }))
        })
    </script>
</x-app-layout>
