<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'username' => 'lecks',
            'email' => 'lecks@example.com',
            'password' => bcrypt('lecks')
        ]);
        User::factory()->create([
            'username' => 'user2',
            'email' => 'user2@example.com',
            'password' => bcrypt('user2')
        ]);
        User::factory()->create([
            'username' => 'user3',
            'email' => 'user3@example.com',
            'password' => bcrypt('user3')
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
