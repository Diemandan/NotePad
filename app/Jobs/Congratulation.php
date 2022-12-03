<?php

namespace App\Jobs;

use App\Models\User;
use App\Mail\BirthCongratulation;
use Illuminate\Support\Facades\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class Congratulation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $users = User::whereMonth('birth_date', date('m'))
            ->whereDay('birth_date', date('d'))->get();
        foreach ($users as $user) {
            Mail::to($user)->send(new BirthCongratulation($user));
        }
    }
}
