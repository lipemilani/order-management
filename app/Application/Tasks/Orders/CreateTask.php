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

    public function execute(array $data): ?bool
    {
        $exists = $this->repository->checkIfExistsByCustomerIdAndProductId($data['customer_id'], $data['product_id']);
        if ($exists) return true;
        $this->repository->store($data);
        return false;
    }

}
