<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ListApiKey extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'list-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List API users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::all()->pluck('email')->toArray();
        $this->info('API users list.');
        foreach($users as $user) {
            $this->line($user);
        }
    }
}
