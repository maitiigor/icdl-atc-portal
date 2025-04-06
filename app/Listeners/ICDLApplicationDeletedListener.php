<?php

namespace App\Listeners;


use App\Events\ICDLApplicationDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ICDLApplicationDeletedListener
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
     * @param  ICDLApplicationDeleted  $event
     * @return void
     */
    public function handle(ICDLApplicationDeleted $event)
    {
        //
    }
}
