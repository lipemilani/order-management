<?php

namespace App\Observers;

use App\Models\Product;
use Ramsey\Uuid\Uuid;

class ProductObserver
{
    /**
     * @param Product $product
     * @return void
     */
    public function creating(Product $product): void
    {
        $product->id = Uuid::uuid4();
    }
}
