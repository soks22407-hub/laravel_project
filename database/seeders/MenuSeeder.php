<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Menu::create([
        'title' => 'Main Menu',
        'sub_title' => 'Homepage links',
        'description' => 'This is the main navigation menu',
        'active' => 1,
        'created_by' => 1, // assuming user ID 1
    ]);
    }
}
