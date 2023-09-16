<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;


class createUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(User $user)
    {
        $name = $this->ask('Enter the name of the admin user');
        $email = $this->ask('Enter the email address');
        $password = $this->secret('Enter the password');

        // $user->name = $name;
        // $user->email = $email;
        // $user->password = Hash::make($password);
        // $user->save();
        echo $name;
        echo $email;
        echo $password;

        $this->info('Admin user created successfully.');
    }
}
