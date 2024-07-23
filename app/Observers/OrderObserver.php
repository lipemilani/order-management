<?php

namespace App\Observers;

use App\Mail\CreateOrderMail;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Mail;

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

    public function created(Order $order): void
    {
        $customer = Customer::find($order->customer_id);
        $product = Product::find($order->product_id);

        Mail::to($customer->email)->send(new CreateOrderMail($customer, $product, $order));
    }
}
