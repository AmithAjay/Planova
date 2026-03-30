import re

def convert():
    with open('resources/views/events/create.blade.php', 'r') as f:
        content = f.read()

    # Route and method
    content = content.replace(
        '''<form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data" class="max-w-5xl mx-auto relative z-10 p-4 lg:p-0">
            @csrf''',
        '''<form action="{{ route('events.update', $event) }}" method="POST" enctype="multipart/form-data" class="max-w-5xl mx-auto relative z-10 p-4 lg:p-0">
            @csrf
            @method('PUT')'''
    )

    # Breadcrumb and title
    content = content.replace('Create New Event', 'Edit Event')
    content = content.replace('Event <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-500">Details</span>', 'Edit <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-500">{{ $event->title }}</span>')
    content = content.replace('>Publish Event<', '>Update Event<')
    content = content.replace('Publish Event\n', 'Update Event\n')

    # Values
    content = content.replace('''value="{{ old('title') }}"''', '''value="{{ old('title', $event->title) }}"''')
    content = content.replace('''old('category_id') ? '' : 'selected' ''', '''old('category_id', $event->category_id) ? '' : 'selected' ''')
    content = content.replace('''old('category_id') == $category->id''', '''old('category_id', $event->category_id) == $category->id''')
    content = content.replace('''value="{{ old('date') }}"''', '''value="{{ old('date', $event->date ? $event->date->format('Y-m-d') : '') }}"''')
    content = content.replace('''value="{{ old('location') }}"''', '''value="{{ old('location', $event->location) }}"''')
    content = content.replace('''{{ old('description') }}''', '''{{ old('description', $event->description) }}''')
    
    # Event type
    content = content.replace('''<option value="Offline" selected>Offline (In-Person)</option>
                                    <option value="Online">Online (Virtual)</option>
                                    <option value="Hybrid">Hybrid</option>''',
                              '''<option value="Offline" {{ old('event_type', $event->event_type) == 'Offline' ? 'selected' : '' }}>Offline (In-Person)</option>
                                    <option value="Online" {{ old('event_type', $event->event_type) == 'Online' ? 'selected' : '' }}>Online (Virtual)</option>
                                    <option value="Hybrid" {{ old('event_type', $event->event_type) == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>''')
    
    # Ticket and participants
    content = content.replace('''value="{{ old('ticket_price', 0) }}"''', '''value="{{ old('ticket_price', $event->ticket_price ?? 0) }}"''')
    content = content.replace('''value="{{ old('max_participants') }}"''', '''value="{{ old('max_participants', $event->max_participants) }}"''')

    # Alpine.js logic replacement for edit
    alpine_old = '''    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('eventForm', () => ({
                imagePreview: null,
                fileName: '',
                fields: [
                    { id: Date.now(), title: 'Dietary Requirements', type: 'Checkboxes', required: false, options: ['Vegetarian', 'Vegan'] }
                ],'''
                
    alpine_new = """    <script>
        document.addEventListener('alpine:init', () => {
            let initialFields = [];
            const rawOldFields = {!! json_encode(old('custom_fields')) !!};
            const dbFields = {!! json_encode($event->custom_fields ?? []) !!};
            try {
                if (rawOldFields) {
                    initialFields = JSON.parse(rawOldFields);
                } else if (Array.isArray(dbFields) && dbFields.length > 0) {
                    initialFields = dbFields;
                } else {
                    initialFields = [
                        { id: Date.now(), title: 'Dietary Requirements', type: 'Checkboxes', required: false, options: ['Vegetarian', 'Vegan'] }
                    ];
                }
            } catch(e) { console.error(e); }

            Alpine.data('eventForm', () => ({
                imagePreview: '{{ $event->image_path ? Storage::url($event->image_path) : "" }}',
                fileName: '{{ $event->image_path ? basename($event->image_path) : "" }}',
                fields: initialFields,"""

    content = content.replace(alpine_old, alpine_new)

    with open('resources/views/events/edit.blade.php', 'w') as f:
        f.write(content)

if __name__ == '__main__':
    convert()
