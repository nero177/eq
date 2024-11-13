<?php

namespace App\Console\Commands;

use App\Mail\NotifyOldUser;
use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Mail;


class NotifyOldUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:notify-old-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify users from old erteqoob site to change their passwords';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::get();
        $index = 0; //set manually
        // $users = User::where('email', 'edwardnero2020@gmail.com')->first();
        try {
            // Mail::to($users)->queue(new NotifyOldUser());
            foreach ($users as $user) {
                // if ($index <= 50){
                //     continue;
                // }

                Mail::to($user)->queue(new NotifyOldUser());
                $index += 1;
            }
        } catch (\Exception $e) {
            info('index', ['index' => $index]);
            dd($index);
        }

    }
}
