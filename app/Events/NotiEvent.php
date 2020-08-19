<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotiEvent implements ShouldBroadcast {
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $count;
    public $text;
    public function __construct($count, $text,$user='')
    {
        $this->count = $count;
        $this->text = $text;
        $this->user = $user;
    }
    public function broadcastOn()
    {
        return new Channel('notiChannel');
    }
}
