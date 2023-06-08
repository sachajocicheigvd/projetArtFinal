<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Sondage
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $answer;

    public function __construct($answer)
    {
   
        $this->answer = $answer;
    }

    public function broadcastOn()
    {
        return new Channel('sondage');
    }

    public function broadcastAs()
    {
        return 'answer';
    }
}