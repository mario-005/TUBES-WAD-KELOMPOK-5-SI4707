<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CheckCurrentUser extends Command
{
    protected $signature = 'check:user {email}';
    protected $description = 'Check user details in database';

    public function handle()
    {
        $email = $this->argument('email');
        
        $this->info('Checking user details for: ' . $email);
        
        // Check users table
        $user = DB::table('users')->where('email', $email)->first();
        
        if ($user) {
            $this->info('User found in database:');
            $this->table(
                ['ID', 'Name', 'Email', 'Role'],
                [[$user->id, $user->name, $user->email, $user->role]]
            );
            
            // Check if role column exists
            $columns = DB::getSchemaBuilder()->getColumnListing('users');
            $this->info('Columns in users table:');
            $this->table(['Column Name'], collect($columns)->map(fn($col) => [$col])->toArray());
            
            // Check role value
            $this->info('Role value type: ' . gettype($user->role));
            $this->info('Role value length: ' . strlen($user->role));
            $this->info('Role value (hex): ' . bin2hex($user->role));
        } else {
            $this->error('User not found in database!');
        }
    }
} 