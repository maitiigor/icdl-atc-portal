<?php

namespace App\Listeners;


use App\Events\ICDLApplicationCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Notification;

class ICDLApplicationCreatedListener
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
     * @param  ICDLApplicationCreated  $event
     * @return void
     */
    public function handle(ICDLApplicationCreated $event)
    {
        //
        Notification::send($event->icdlApplication, new \App\Notifications\ICDLApplicationCreatedNotification($event->icdlApplication));
    }
}
