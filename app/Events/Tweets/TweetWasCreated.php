<?php

namespace App\Events\Tweets;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Tweet;
use App\Http\Resources\TweetResource;

class TweetWasCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $tweet;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Tweet $tweet)
    {
        $this->tweet = $tweet;
    }

      /**
     * Get the broadcast channel name for the event.
     *
     * @return array|string
     */
    public function broadcastAs()
    {
        return 'TweetWasCreated';
    }

    /**
     * Get the data that should be sent with the broadcasted event.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastWith()
    {
        return (new TweetResource($this->tweet))->jsonSerialize();
    }


    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return $this->tweet->user->followers->map(function($user) {
            return new PrivateChannel('timeline.' . $user->id);
        })
           ->toArray();
        
    }
}
