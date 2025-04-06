<?php

namespace App\Events;

use App\Models\ICDLApplication;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ICDLApplicationDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $icdlApplication;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ICDLApplication $icdlApplication)
    {
        $this->icdlApplication = $icdlApplication;
    }

}
