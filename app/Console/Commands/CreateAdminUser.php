<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    // Command signature
    protected $signature = 'user:create-admin';

    // Command description
    protected $description = 'Create an admin user interactively';

    public function handle(): void
    {
        // $username = $this->ask('Enter username');
        $name = $this->ask('Enter name');
        $role_id = $this->ask('Enter role ID');
        $email = $this->ask('Enter email');
        $password = $this->secret('Enter password'); // hidden input

        // Create the user
        User::create([
            // 'username' => $username,
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role_id' => $role_id,
        ]);

        $this->info("Admin user '{$name}' created successfully!");
    }
}
