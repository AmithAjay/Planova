<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Technical Events',
            'Cultural Fest',
            'Workshops & Seminars',
            'Sports & Athletics',
            'Hackathons',
            'Club Meetings',
            'Guest Lectures',
            'Exhibitions'
        ];

        foreach ($categories as $category) {
            \App\Models\Category::firstOrCreate([
                'name' => $category,
                'slug' => \Illuminate\Support\Str::slug($category)
            ]);
        }
    }
}
