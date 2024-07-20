<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * ProductController constructor.
     * @param ProductApplicationService $service
     */
    public function __construct(ProductApplicationService $service)
    {
        parent::__construct($service);
    }
}
