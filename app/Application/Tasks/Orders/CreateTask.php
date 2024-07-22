<?php

namespace App\Application\Tasks\Orders;

use App\Mail\CreateOrderMail;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use App\Repositories\OrderRepository;
use App\Application\Tasks\BaseTaskContract;
use Illuminate\Support\Facades\Mail;

class CreateTask implements BaseTaskContract
{
    private OrderRepository $repository;
    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(array $data): void
    {
        $order = $this->repository->store($data);
        $this->sendEmail($data, $order);
    }

    private function sendEmail(array $data, Order $order): void
    {
        $customer = Customer::find($data['customer_id']);
        $product = Product::find($data['product_id']);

        Mail::to($customer->email)->send(new CreateOrderMail($customer, $product, $order));
    }
}
