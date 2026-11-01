<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class DeleteApiKey extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete an API user their email address.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = User::where('email', $this->ask('Enter the email address of the user to delete.'))->first();

        if (! $user) {
            $this->error('User not found.');
            return 1;
        }

        if ($this->confirm("Are you sure want to delete the user with the email {$user->email}?")) {
            $user->delete();
            $this->info("User deleted successfully.");
            return 0;
        } else {
            $this->info('Operation cancelled.');
            return 1;
        }
    }
}
