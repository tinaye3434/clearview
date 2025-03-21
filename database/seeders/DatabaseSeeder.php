<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);

//        DB::table('users')->insert([
//            'name' => 'Admin',
//            'email' => 'admin@admin.com',
//            'password' => Hash::make('password'),
//            'is_admin' => true,
//        ]);

        DB::table('users')->insert([
            'name' => 'User1',
            'email' => 'user1@admin.com',
            'password' => Hash::make('password'),
            'is_admin' => false,
        ]);
    }
}
