<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\OrderRequest;
use App\Application\Services\OrderService;
use Symfony\Component\HttpKernel\Exception\HttpException;

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

        $this->checkIfIsValidCustomerIdAndProductId($customerId, $productId);

        $result = $this->service->store($customerId, $productId);

        if($result) return response()->json(["message" => "This order already exists for this customer."], 400);

        return response()->json(["message" => "Order created."], 201);

    }

    /**
     * @param OrderRequest $request
     * @return JsonResponse
     */
    public function delete(OrderRequest $request): JsonResponse
    {
        $customerId = $request->get('customer_id');
        $productId = $request->get('product_id');

        $this->checkIfIsValidCustomerIdAndProductId($customerId, $productId);

        $result = $this->service->delete($customerId, $productId);

        if (!$result) return response()->json(["message" =>"There is no such order"], 400);

        return response()->json(["message" => "Order deleted."], 204);
    }

    private function checkIfIsValidCustomerIdAndProductId(string $customerId, string $productId): void
    {
        $customerExists = Customer::find($customerId);
        $productExists = Product::find($productId);

        if (!$customerExists || !$productExists) {
            throw new HttpException(404, 'Customer or product not found.');
        }
    }
}
