<?php

namespace App\Events;

use App\Models\HistoryPerangkat;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class HistoryPerangkatWasCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $history;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(HistoryPerangkat $history_perangkat)
    {
        $this->history = $history_perangkat->load('perangkat');
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['perangkat-log'];
    }

    public function broadcastAs()
    {

        return 'perangkat-statistic';
    }
}
