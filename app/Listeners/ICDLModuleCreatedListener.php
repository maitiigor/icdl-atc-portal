<?php

namespace App\Listeners;

use App\Models\Customer;
use App\Events\ICDLModuleCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ICDLModuleCreatedListener
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
     * @param  ICDLModuleCreated  $event
     * @return void
     */
    public function handle(ICDLModuleCreated $event)
    {
        //
    }
}
