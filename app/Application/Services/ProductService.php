<?php

namespace App\Application\Services;

use App\Repositories\ProductRepository;
use App\Application\Transformers\ProductTransformer;

class ProductService extends ApplicationService
{
    /**
     * @param ProductTransformer|null $transformer
     * @param ProductRepository|null $repository
     */
    public function __construct(ProductTransformer $transformer = null, ProductRepository $repository = null)
    {
        parent::__construct($transformer, $repository);
    }
}
