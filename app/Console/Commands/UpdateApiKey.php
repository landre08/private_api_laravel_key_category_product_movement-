<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class UpdateApiKey extends Command
{
    protected $signature = 'update-user';

    protected $description = 'Updated user API Key';

    public function handle()
    {
        $email = $this->ask('Enter the email account for the user to update the API key.');

        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error('Invalid email address.');
            return 1;
        }

        $user = User::where('email', $email)->first();

        if (! $user) {
            $this->error('User not found.');
            return 1;
        }

        $apiKey = bin2hex(random_bytes(32));

        $user->api_key = $apiKey;
        $user->save();

        $this->info('API user updated successfully.');
        $this->info("Email: {$user->email}");
        $this->info("New API Key: {$user->api_key}");
        $this->info('Please kep this key safe. Copy to a safe place.');

        return 0;
    }
}
