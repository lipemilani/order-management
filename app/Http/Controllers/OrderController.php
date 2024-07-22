<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\JsonResponse;
use App\Application\Services\OrderService;

class OrderController
{
    private OrderService $service;
    public function __construct(OrderService $service)
    {
        $this->service = $service;
    }

    public function store(string $customerId, string $productId): JsonResponse
    {
        $order = Order::where('customer_id', $customerId)->where('product_id', $productId)->first();

        if (!empty($order)) return response()->json("This order already exists for this customer.", 400);

        $this->service->store($customerId, $productId);

        return response()->json("Order created.", 201);

    }

    public function delete(string $customerId, string $productId): JsonResponse
    {
        $order = Order::where('customer_id', $customerId)->where('product_id', $productId)->first();

        if (empty($order)) return response()->json("There is no such order", 400);

        $this->service->delete($customerId, $productId);

        return response()->json("Order deleted.", 201);
    }
}
