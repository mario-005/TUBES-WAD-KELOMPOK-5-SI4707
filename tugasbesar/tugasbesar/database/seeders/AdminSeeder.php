<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Delete existing admin user if exists
        DB::table('users')->where('email', 'admin@admin.com')->delete();

        // Create new admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);

        $this->command->info('Admin user created successfully!');
    }
} 