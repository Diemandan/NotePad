<?php

namespace App\Jobs;

use App\Models\Note;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderShipped;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RemindMail implements ShouldQueue
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
        $order = Note::where('remind_at',date('Y-m-d',time()))->get();
        foreach ($order as $oneorder )
        {
          Mail::to($oneorder->user)->send(new OrderShipped($oneorder));
        }      
    }
}
