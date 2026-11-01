<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CreateApiUser extends Command
{
    protected $signature = 'create-user';

    protected $description = 'Create a new API user with a unique API key';

    public function handle()
    {
        $email = $this->ask('Enter the email for the new API user.');

        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error('Invalid email address.');
            return 1;
        }

        $apiKey = bin2hex(random_bytes(32));

        $user = User::create([
            'email' => $email,
            'api_key' => $apiKey
        ]);

        $this->info('API user created successfully.');
        $this->info("Email: {$user->email}");
        $this->info("API Key: {$user->api_key}");
        $this->info('Please kep this key safe. Copy to a safe place.');

        return 0;
    }
}
