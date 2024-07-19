<?php

namespace App\Observers;

use App\Models\Order;
use Ramsey\Uuid\Uuid;

class OrderObserver
{
    /**
     * @param Order $order
     * @return void
     */
    public function creating(Order $order): void
    {
        $order->id = Uuid::uuid4();
    }
}
