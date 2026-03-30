<x-app-layout>
    <div class="min-h-screen bg-[#f0ebf8] py-12 px-4 sm:px-6 lg:px-8 font-sans">
        <div class="max-w-3xl mx-auto">
            <!-- Progress Bar -->
            <div class="w-full bg-slate-200 h-1.5 rounded-full mb-8 overflow-hidden shadow-sm" x-data="{ 
                progress: 0,
                calculateProgress() {
                    let requiredFields = document.querySelectorAll('[required]');
                    let filledFields = Array.from(requiredFields).filter(field => {
                        if (field.type === 'radio') {
                            return document.querySelector(`input[name='${field.name}']:checked`);
                        }
                        return field.value.trim() !== '';
                    });
                    this.progress = (filledFields.length / requiredFields.length) * 100;
                }
            }" x-init="calculateProgress()" @change="calculateProgress()" @input="calculateProgress()">
                <div class="h-full bg-blue-700 transition-all duration-500 ease-out shadow-[0_0_8px_rgba(109,40,217,0.3)]" :style="`width: ${progress}%`"></div>
            </div>

            <!-- Header Card -->
            <div class="bg-white rounded-xl shadow-sm border-t-[10px] border-blue-700 overflow-hidden mb-4 transform transition-all hover:shadow-md">
                <div class="p-8">
                    <h1 class="text-3xl font-bold text-slate-900 tracking-tight">{{ $event->title }}</h1>
                    <div class="mt-4 text-slate-600 prose prose-blue max-w-none">
                        {!! $event->description !!}
                    </div>
                    <div class="mt-6 pt-6 border-t border-slate-100 flex items-center justify-between">
                        <div class="flex items-center gap-3 text-sm font-semibold text-slate-500">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            Registration Open
                        </div>
                        <div class="text-xs font-black text-blue-700 bg-blue-50 px-3 py-1.5 rounded-lg uppercase tracking-widest border border-blue-100">
                            {{ $event->event_type ?? 'Standard Event' }}
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('events.register', $event) }}" method="POST" class="space-y-4">
                @csrf
                
                <!-- Email Disclaimer (Visual Only) -->
                <div class="bg-white rounded-xl shadow-sm p-8 border border-slate-100 group transition-all hover:border-blue-200">
                    <div class="flex items-center justify-between mb-4">
                        <label class="text-base font-bold text-slate-900 group-hover:text-blue-900 transition-colors">Registered Identity</label>
                        <span class="text-red-500 text-sm font-black">* Required</span>
                    </div>
                    <p class="text-sm font-medium text-slate-600 bg-slate-50 p-3 rounded-lg border border-slate-200 inline-block">{{ auth()->user()->email }}</p>
                    <p class="mt-4 text-xs font-semibold text-slate-400 uppercase tracking-widest">Switching accounts is not permitted for this protocol.</p>
                </div>

                <!-- Gender Field -->
                <div class="bg-white rounded-xl shadow-sm p-8 border border-slate-100 group transition-all hover:border-blue-200">
                    <div class="flex items-center justify-between mb-6">
                        <label class="text-base font-bold text-slate-900 group-hover:text-blue-900 transition-colors">Gender Identification <span class="text-red-500 ml-1">*</span></label>
                    </div>
                    <div class="space-y-4">
                        @foreach(['Male', 'Female', 'Other', 'Prefer not to say'] as $option)
                            <label class="flex items-center group/opt cursor-pointer p-3 bg-white border border-slate-100 rounded-xl hover:bg-slate-50 hover:border-blue-200 transition-all shadow-sm">
                                <div class="relative flex items-center justify-center">
                                    <input type="radio" name="gender" value="{{ $option }}" required class="peer appearance-none w-6 h-6 border-2 border-slate-300 rounded-md checked:border-blue-700 checked:bg-blue-700 transition-all">
                                    <svg class="absolute w-4 h-4 text-white scale-0 peer-checked:scale-100 transition-transform pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                    </svg>
                                </div>
                                <span class="ml-3 text-sm font-bold text-slate-700 group-hover/opt:text-blue-700">{{ $option }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('gender')
                        <p class="mt-3 text-xs font-bold text-red-500 bg-red-50 p-2 rounded-lg border border-red-100">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone Number Field -->
                <div class="bg-white rounded-xl shadow-sm p-8 border border-slate-100 group transition-all hover:border-blue-200">
                    <div class="flex items-center justify-between mb-4">
                        <label class="text-base font-bold text-slate-900 group-hover:text-blue-900 transition-colors">Neural Interface Link (Phone) <span class="text-red-500 ml-1">*</span></label>
                    </div>
                    <div class="relative">
                        <input type="text" name="phone_number" required placeholder="Your answer" 
                            class="w-full border-b-[1.5px] border-slate-200 py-3 text-sm font-bold focus:border-blue-600 transition-all outline-none placeholder:text-slate-300 group-hover:placeholder:text-slate-400">
                        <div class="absolute bottom-0 left-0 w-0 h-[2px] bg-blue-600 transition-all duration-300 peer-focus:w-full"></div>
                    </div>
                    <p class="mt-4 text-xs font-semibold text-slate-400 uppercase tracking-widest">Format: 10-digit number (e.g., 9876543210)</p>
                    @error('phone_number')
                        <p class="mt-3 text-xs font-bold text-red-500 bg-red-50 p-2 rounded-lg border border-red-100">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Dynamic Fields -->
                @if($event->custom_fields)
                    @foreach($event->custom_fields as $idx => $field)
                        @php
                            $questionName = !empty($field['title']) ? $field['title'] : (!empty($field['helpText']) ? $field['helpText'] : 'Question ' . ($idx + 1));
                        @endphp
                        <div class="bg-white rounded-xl shadow-sm p-8 border border-slate-100 group transition-all hover:border-blue-200">
                            <div class="flex flex-col mb-6">
                                <label class="text-base font-bold text-slate-900 group-hover:text-blue-900 transition-colors">
                                    {{ $questionName }}
                                    @if($field['required']) <span class="text-red-500 ml-1">*</span> @endif
                                </label>
                                @if(!empty($field['helpText']) && $field['helpText'] !== $questionName)
                                    <p class="text-sm font-medium text-slate-500 mt-1">{{ $field['helpText'] }}</p>
                                @endif
                            </div>

                            @if($field['type'] === 'Short Answer')
                                <div class="relative">
                                    <input type="text" name="responses[{{ $questionName }}]" @if($field['required']) required @endif placeholder="Your answer" 
                                        class="w-full border-b-[1.5px] border-slate-200 py-3 text-sm font-bold focus:border-blue-600 transition-all outline-none">
                                </div>
                            @elseif($field['type'] === 'Paragraph')
                                <div class="relative">
                                    <textarea name="responses[{{ $questionName }}]" @if($field['required']) required @endif placeholder="Your detailed response..." rows="4"
                                        class="w-full border-[1.5px] border-slate-200 rounded-xl p-4 text-sm font-bold focus:border-blue-600 transition-all outline-none resize-y"></textarea>
                                </div>
                            @elseif($field['type'] === 'Multiple Choice')
                                <div class="grid grid-cols-1 gap-3">
                                    @foreach($field['options'] as $opt)
                                        <label class="flex items-center group/opt cursor-pointer p-3 bg-white border border-slate-100 rounded-xl hover:bg-slate-50 hover:border-blue-200 transition-all shadow-sm">
                                            <div class="relative flex items-center justify-center">
                                                <input type="radio" name="responses[{{ $questionName }}]" value="{{ $opt }}" @if($field['required']) required @endif class="peer appearance-none w-6 h-6 border-2 border-slate-300 rounded-md checked:border-blue-700 checked:bg-blue-700 transition-all">
                                                <svg class="absolute w-4 h-4 text-white scale-0 peer-checked:scale-100 transition-transform pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                                </svg>
                                            </div>
                                            <span class="ml-3 text-sm font-bold text-slate-700 group-hover/opt:text-blue-700">{{ $opt }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            @elseif($field['type'] === 'Checkboxes')
                                <div class="grid grid-cols-1 gap-3">
                                    @foreach($field['options'] as $opt)
                                        <label class="flex items-center group/opt cursor-pointer p-3 bg-white border border-slate-100 rounded-xl hover:bg-slate-50 hover:border-blue-200 transition-all shadow-sm">
                                            <div class="relative flex items-center justify-center">
                                                <input type="checkbox" name="responses[{{ $questionName }}][]" value="{{ $opt }}" class="peer appearance-none w-6 h-6 border-2 border-slate-300 rounded-md checked:border-blue-700 checked:bg-blue-700 transition-all">
                                                <svg class="absolute w-4 h-4 text-white scale-0 peer-checked:scale-100 transition-transform pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                                </svg>
                                            </div>
                                            <span class="ml-3 text-sm font-bold text-slate-700 group-hover/opt:text-blue-700">{{ $opt }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            @elseif($field['type'] === 'Dropdown')
                                <div class="relative">
                                    <select name="responses[{{ $questionName }}]" @if($field['required']) required @endif class="w-full border-[1.5px] border-slate-200 rounded-xl p-4 text-sm font-bold focus:border-blue-600 transition-all outline-none bg-white appearance-none cursor-pointer">
                                        <option value="" disabled selected>Select an option...</option>
                                        @foreach($field['options'] as $opt)
                                            <option value="{{ $opt }}">{{ $opt }}</option>
                                        @endforeach
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>
                                </div>
                            @elseif(in_array($field['type'], ['Date', 'Time', 'Number', 'Website URL']))
                                <div class="relative">
                                    @php
                                        $inputType = 'text';
                                        if ($field['type'] === 'Date') $inputType = 'date';
                                        elseif ($field['type'] === 'Time') $inputType = 'time';
                                        elseif ($field['type'] === 'Number') $inputType = 'number';
                                        elseif ($field['type'] === 'Website URL') $inputType = 'url';
                                    @endphp
                                    <input type="{{ $inputType }}" name="responses[{{ $questionName }}]" @if($field['required']) required @endif 
                                        class="w-full border-b-[1.5px] border-slate-200 py-3 text-sm font-bold focus:border-blue-600 transition-all outline-none">
                                </div>
                            @endif
                        </div>
                    @endforeach
                @endif

                <!-- Submission Bar -->
                <div class="flex items-center justify-between pt-4">
                    <button type="submit" class="text-white px-10 py-3.5 rounded-lg font-black text-sm uppercase tracking-[0.2em] shadow-lg hover:scale-[1.02] active:scale-95 transition-all" style="background-color: #2563eb; box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.3);">
                        Confirm Registration
                    </button>
                    <button type="button" onclick="history.back()" class="text-sm font-black uppercase tracking-widest hover:text-slate-800 transition-colors" style="color: #64748b;">
                        Cancel Registration
                    </button>
                </div>
            </form>
            
            <div class="mt-12 text-center">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em]">Planova Engine v4.0 • Engineering Verification Active</p>
                <p class="mt-2 text-[8px] font-bold text-slate-300 uppercase tracking-widest">Never submit passwords through Planova Forms.</p>
            </div>
        </div>
    </div>
</x-app-layout>
