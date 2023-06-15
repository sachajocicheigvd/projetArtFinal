<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Message as test;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;



class Message implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $username;
    public $message;
    public $pseudo;
    public $genres;

    public function __construct($username, $message, $pseudo)
    {
        $this->username = $username;
        $this->message = $message;
        $this->genres = Auth::user()->genres;
        $this->pseudo = Auth::user()->username;
    }

    public function broadcastOn()
    {
        return new Channel('chat');
    }

    public function broadcastAs()
    {
        return 'message';
    }
}
