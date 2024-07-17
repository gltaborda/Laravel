<?php

namespace App\Listeners;

use App\Events\ThousandVisits;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\CongratulationThousandVisits;

class ThousandVisitsEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\FirstBikeCreated  $event
     * @return void
     */
    public function handle(ThousandVisits $event)
    {
        Mail::to($event->user->email)->send(new CongratulationThousandVisits($event->bike));
    }
}
