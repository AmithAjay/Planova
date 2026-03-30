<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$student = \App\Models\User::firstOrCreate(
['email' => 'studenttest@example.com'],
[
    'name' => 'Test Student',
    'password' => bcrypt('password'),
    'role' => 'student',
    'department_id' => \App\Models\Department::first()->id ?? null
]
);

$event = \App\Models\Event::first();
if ($event) {
    if (!$event->participants()->where('user_id', $student->id)->exists()) {
        \App\Models\Registration::create([
            'user_id' => $student->id,
            'event_id' => $event->id,
            'status' => 'registered',
            'gender' => 'Male',
            'phone_number' => '9880000000',
            'responses' => ['Dietary Requirements' => ['Vegetarian']]
        ]);

        $admins = \App\Models\User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            $admin->notify(new \App\Notifications\NewRegistrationNotification($event, $student));
        }
        echo "Notification dispatched successfully to " . $admins->count() . " admins!\n";
    }
    else {
        echo "Student already registered for this event.\n";
    }
}
else {
    echo "No events found.\n";
}
