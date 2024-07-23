<?php

namespace App\Repositories;

use App\Models\Order;
use Carbon\Carbon;

class OrderRepository
{
    /**
     * @var Order
     */
    private Order $model;

    /**
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->model = $order;
    }

    /**
     * @param array $data
     * @return Order
     */
    public function store(array $data): Order
    {
        $this->model->customer_id = $data['customer_id'];
        $this->model->product_id = $data['product_id'];
        $this->model->created_at = Carbon::now()->setTimezone('America/Sao_Paulo');
        $this->model->active = true;

        return $this->model::create($this->model->toArray());
    }

    /**
     * @param Order $order
     * @return void
     */
    public function delete(Order $order): void
    {
        $order->active = false;
        $order->save();
    }

    /**
     * @param string $customerId
     * @param string $productId
     * @return mixed
     */
    public function checkIfExistsByCustomerIdAndProductId(string $customerId, string $productId): mixed
    {
        return $this->model::where('customer_id', $customerId)
            ->where('product_id', $productId)
            ->where('active', true)
            ->first();
    }
}
