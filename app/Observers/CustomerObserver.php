<?php

namespace App\Observers;

use Ramsey\Uuid\Uuid;
use App\Models\Customer;

class CustomerObserver
{
    /**
     * @param Customer $customer
     * @return void
     */
    public function creating(Customer $customer): void
    {
        $customer->id = Uuid::uuid4();
    }
}
