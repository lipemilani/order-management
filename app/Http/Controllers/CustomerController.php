<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * CustomerController constructor.
     * @param CustomerApplicationService $service
     */
    public function __construct(CustomerApplicationService $service)
    {
        parent::__construct($service);
    }
}
