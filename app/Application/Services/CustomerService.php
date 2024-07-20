<?php

namespace App\Application\Services;

use App\Repositories\CustomerRepository;
use App\Application\Transformers\CustomerTransformer;

class CustomerService extends ApplicationService
{
    /**
     * @param CustomerTransformer|null $transformer
     * @param CustomerRepository|null $repository
     */
    public function __construct(CustomerTransformer $transformer = null, CustomerRepository $repository = null)
    {
        parent::__construct($transformer, $repository);
    }
}
