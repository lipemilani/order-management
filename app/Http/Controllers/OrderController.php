<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\JsonResponse;
use App\Application\Services\OrderService;

class OrderController
{
    /**
     * @var OrderService
     */
    private OrderService $service;

    /**
     * @param OrderService $service
     */
    public function __construct(OrderService $service)
    {
        $this->service = $service;
    }

    /**
     * @param string $customerId
     * @param string $productId
     * @return JsonResponse
     */
    public function store(string $customerId, string $productId): JsonResponse
    {
        request()->validate([
            'customer_id' => 'string|required' . $customerId,
            'product_id' => 'string|required' . $productId,
        ]);

        $order = Order::where('customer_id', $customerId)->where('product_id', $productId)->first();

        if (!empty($order)) return response()->json("This order already exists for this customer.", 400);

        $this->service->store($customerId, $productId);

        return response()->json("Order created.", 201);

    }

    /**
     * @param string $customerId
     * @param string $productId
     * @return JsonResponse
     */
    public function delete(string $customerId, string $productId): JsonResponse
    {
        request()->validate([
            'customer_id' => 'string|required' . $customerId,
            'product_id' => 'string|required' . $productId,
        ]);

        $order = Order::where('customer_id', $customerId)->where('product_id', $productId)->first();

        if (empty($order)) return response()->json("There is no such order", 400);

        $this->service->delete($order);

        return response()->json("Order deleted.", 204);
    }
}
