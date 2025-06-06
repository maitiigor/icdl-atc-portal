<?php

namespace App\Events;

use App\Models\ICDLModule;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ICDLModuleUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $icdlModule;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ICDLModule $icdlModule)
    {
        $this->icdlModule = $icdlModule;
    }

}
