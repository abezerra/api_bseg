<?php

namespace App\Events;

use App\Entities\Conversation;
use App\Entities\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ChatEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * @var Conversation
     */
    public $conversation;
    /**
     * @var User
     */
    public $user_id;
    public $respondedor;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    //private chat
//    public function __construct(Conversation $conversation, User $user_id, $respondedor)
//    {
//        $this->conversation = $conversation;
//        $this->user_id = $user_id;
//        $this->respondedor = $respondedor;
//    }

    //public chat
    public function __construct(Conversation $conversation, User $user_id)
    {
        $this->conversation = $conversation;
        $this->user_id = $user_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */

    //private chat app
//    public function broadcastOn()
//    {
//        return new PrivateChannel('chat.'. $this.$this->user_id );
//    }

    //public chat
    public function broadcastOn()
    {
        return new Channel('chat');
    }
}
