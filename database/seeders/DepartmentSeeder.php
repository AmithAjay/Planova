<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;
use App\Models\User;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            'Computer Science',
            'Social Work',
            'Commerce',
            'Psychology',
            'BBA',
            'Physical Education'
        ];

        foreach ($departments as $dept) {
            Department::firstOrCreate(['name' => $dept]);
        }

        // Update existing users
        $cs = Department::where('name', 'Computer Science')->first();
        $pe = Department::where('name', 'Physical Education')->first();
        $commerce = Department::where('name', 'Commerce')->first();

        // Amith -> Computer Science
        User::where('name', 'like', '%amith%')->update(['department_id' => $cs->id]);

        // Shivadarsh -> Physical Education
        User::where('name', 'like', '%shivadarsh%')->update(['department_id' => $pe->id]);

        // Others -> Randomly distributed if not updated
        User::whereNull('department_id')->each(function ($user) use ($commerce) {
            $user->update(['department_id' => $commerce->id]);
        });
    }
}
