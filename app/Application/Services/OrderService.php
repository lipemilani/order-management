<?php

namespace App\Application\Services;

use App\Models\Order;
use App\Repositories\OrderRepository;
use App\Application\Tasks\Orders\CreateTask;

class OrderService
{
    /**
     * @var OrderRepository
     */
    private OrderRepository $repository;

    /**
     * @param OrderRepository $repository
     */
    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param string $customerId
     * @param string $productId
     * @return mixed
     */
    public function store(string $customerId, string $productId): mixed
    {
        $order = $this->repository->checkIfExistsByCustomerIdAndProductId($customerId, $productId);

        if ($order) {
            return true;
        }

        $this->repository->store(['customer_id' => $customerId, 'product_id' => $productId]);

        return false;
    }

    /**
     * @param string $customerId
     * @param string $productId
     * @return mixed
     */
    public function delete(string $customerId, string $productId): mixed
    {
        $order = $this->repository->checkIfExistsByCustomerIdAndProductId($customerId, $productId);

        if (!$order) {
            return false;
        }

        $this->repository->delete($order);
        return true;
    }
}
