<?php

namespace App\Events;

use App\Models\Database\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class UserRegisteredEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user = null;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

}
