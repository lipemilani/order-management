<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
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
     * @param OrderRequest $request
     * @return JsonResponse
     */
    public function store(OrderRequest $request): JsonResponse
    {
        $customerId = $request->get('customer_id');
        $productId = $request->get('product_id');

        $result = $this->service->store($customerId, $productId);

        if($result) return response()->json("This order already exists for this customer.", 400);

        return response()->json("Orders created.", 201);

    }

    /**
     * @param OrderRequest $request
     * @return JsonResponse
     */
    public function delete(OrderRequest $request): JsonResponse
    {
        $customerId = $request->get('customer_id');
        $productId = $request->get('product_id');


        $result = $this->service->delete($customerId, $productId);

        if (!$result) return response()->json("There is no such order", 400);

        return response()->json("Orders deleted.", 204);
    }
}
