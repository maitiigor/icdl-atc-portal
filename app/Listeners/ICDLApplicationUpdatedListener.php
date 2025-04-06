<?php

namespace App\Listeners;

use App\Events\ICDLApplicationUpdated;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ICDLApplicationUpdatedListener
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
     * @param  ICDLApplicationUpdated  $event
     * @return void
     */
    public function handle(ICDLApplicationUpdated $event)
    {
        //
    }
}
