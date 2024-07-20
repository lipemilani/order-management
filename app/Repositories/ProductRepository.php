<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository extends EntityRepository
{
    /**
     * @var string
     */
    protected string $entityClassName = Product::class;
}
