<?php

namespace App\Repositories;

use App\Models\Customer;

class CustomerRepository extends EntityRepository
{
    /**
     * @var string
     */
    protected string $entityClassName = Customer::class;
}
