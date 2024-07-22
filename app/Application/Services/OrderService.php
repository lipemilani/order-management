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
     * @return void
     */
    public function store(string $customerId, string $productId): void
    {
        app(CreateTask::class)->execute(['customerId' => $customerId, 'productId' => $productId]);
    }

    /**
     * @param Order $order
     * @return void
     */
    public function delete(Order $order): void
    {
        $this->repository->delete($order);
    }
}
