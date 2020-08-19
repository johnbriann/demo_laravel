<?php

namespace App\Listerners;

use App\Events\NotiEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotiEventListener
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
     * @param  NotiEvent  $event
     * @return void
     */
    public function handle(NotiEvent $event)
    {
        //
    }
}
