<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Default Users (Safe for Production)
        User::create([
            'name' => 'Super Admin',
            'email' => 'super@admin.com',
            'password' => bcrypt('password'),
            'role' => 'super_admin',
        ]);

        User::create([
            'name' => 'Faculty Admin',
            'email' => 'admin@faculty.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Student User',
            'email' => 'student@college.com',
            'password' => bcrypt('password'),
            'role' => 'student',
        ]);

        // 2. Call other seeders
        $this->call(CategorySeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(FacultySeeder::class);
    }
}