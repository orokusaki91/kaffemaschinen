<?php

namespace App\Events;

use App\Http\Requests\ProductRequest;
use App\Models\Database\Product;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ProductAfterSave
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $product = null;

    public $request = null;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Product $product, ProductRequest $request)
    {
        $this->product = $product;
        $this->request = $request;
    }
}
