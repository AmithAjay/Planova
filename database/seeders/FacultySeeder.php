<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = \Illuminate\Support\Facades\Hash::make('password123');
        $role = 'admin';

        $facultyData = [
            // HODs
            ['name' => 'Niya Roy', 'email' => 'niya.roy@rajagiri.edu', 'designation' => 'HOD', 'department_id' => 1], // CS
            ['name' => 'Ann Mariya James', 'email' => 'ann.mariya.james@rajagiri.edu', 'designation' => 'HOD', 'department_id' => 4], // Psychology
            ['name' => 'Varun Raghav', 'email' => 'varun.raghav@rajagiri.edu', 'designation' => 'HOD', 'department_id' => 3], // Commerce
            ['name' => 'Albin Johnson', 'email' => 'albin.johnson@rajagiri.edu', 'designation' => 'HOD', 'department_id' => 5], // BBA
            ['name' => 'Ameen Muhammed', 'email' => 'ameen.muhammed@rajagiri.edu', 'designation' => 'HOD', 'department_id' => 6], // Physical Education
            ['name' => 'Viyani Kurian', 'email' => 'viyani.kurian@rajagiri.edu', 'designation' => 'HOD', 'department_id' => 2], // Social Work

            // Faculty
            ['name' => 'Ashin Jiju', 'email' => 'ashin.jiju@rajagiri.edu', 'designation' => 'Faculty', 'department_id' => 1], // CS
            ['name' => 'Emil Varghese', 'email' => 'emil.varghese@rajagiri.edu', 'designation' => 'Faculty', 'department_id' => 2], // Social Work
            ['name' => 'Mathew Biju', 'email' => 'mathew.biju@rajagiri.edu', 'designation' => 'Faculty', 'department_id' => 3], // Commerce
            ['name' => 'Joel Binoy', 'email' => 'joel.binoy@rajagiri.edu', 'designation' => 'Faculty', 'department_id' => 5], // BBA
            ['name' => 'D Allen', 'email' => 'd.allen@rajagiri.edu', 'designation' => 'Faculty', 'department_id' => 4], // Psychology

            // Additional Dummy Faculty (10 members)
            ['name' => 'Sarah Thomas', 'email' => 'sarah.thomas@rajagiri.edu', 'designation' => 'Faculty', 'department_id' => 1],
            ['name' => 'Rahul Nair', 'email' => 'rahul.nair@rajagiri.edu', 'designation' => 'Faculty', 'department_id' => 1],
            ['name' => 'Deepa Menon', 'email' => 'deepa.menon@rajagiri.edu', 'designation' => 'Faculty', 'department_id' => 4],
            ['name' => 'Arun Kumar', 'email' => 'arun.kumar@rajagiri.edu', 'designation' => 'Faculty', 'department_id' => 3],
            ['name' => 'Priya Lakshmi', 'email' => 'priya.lakshmi@rajagiri.edu', 'designation' => 'Faculty', 'department_id' => 3],
            ['name' => 'Kevin George', 'email' => 'kevin.george@rajagiri.edu', 'designation' => 'Faculty', 'department_id' => 5],
            ['name' => 'Meera Wilson', 'email' => 'meera.wilson@rajagiri.edu', 'designation' => 'Faculty', 'department_id' => 2],
            ['name' => 'Sanjay Das', 'email' => 'sanjay.das@rajagiri.edu', 'designation' => 'Faculty', 'department_id' => 2],
            ['name' => 'Anjali Devi', 'email' => 'anjali.devi@rajagiri.edu', 'designation' => 'Faculty', 'department_id' => 4],
            ['name' => 'Toby Joseph', 'email' => 'toby.joseph@rajagiri.edu', 'designation' => 'Faculty', 'department_id' => 6],
        ];

        foreach ($facultyData as $data) {
            \App\Models\User::updateOrCreate(
            ['email' => $data['email']],
            [
                'name' => $data['name'],
                'password' => $password,
                'role' => $role,
                'designation' => $data['designation'],
                'department_id' => $data['department_id'],
            ]
            );
        }
    }
}
