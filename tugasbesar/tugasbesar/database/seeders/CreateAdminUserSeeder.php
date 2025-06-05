<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class CreateAdminUserSeeder extends Seeder
{
    public function run()
    {
        // Delete existing admin user
        DB::table('users')->where('email', 'admin@admin.com')->delete();

        // Create new admin user
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);

        $this->command->info('Admin user created:');
        $this->command->table(
            ['ID', 'Name', 'Email', 'Role'],
            [[$admin->id, $admin->name, $admin->email, $admin->role]]
        );
    }
} 