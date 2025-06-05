<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CheckAdminUser extends Command
{
    protected $signature = 'check:admin';
    protected $description = 'Check and fix admin user in database';

    public function handle()
    {
        $this->info('Checking admin user...');

        // Check if admin exists
        $admin = User::where('email', 'admin@admin.com')->first();

        if (!$admin) {
            $this->error('Admin user not found!');
            $this->info('Creating admin user...');
            
            User::create([
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('password'),
                'role' => 'admin'
            ]);
            
            $this->info('Admin user created successfully!');
        } else {
            $this->info('Admin user found:');
            $this->table(
                ['ID', 'Name', 'Email', 'Role'],
                [[$admin->id, $admin->name, $admin->email, $admin->role]]
            );

            // Check if role is correct
            if ($admin->role !== 'admin') {
                $this->warn('Admin role is incorrect!');
                $this->info('Fixing admin role...');
                
                $admin->update(['role' => 'admin']);
                
                $this->info('Admin role fixed successfully!');
            }
        }
    }
} 