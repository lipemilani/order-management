<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * @var ApplicationService
     */
    protected ApplicationService $service;

    /**
     * Controller constructor.
     * @param ApplicationService $service
     */
    public function __construct(ApplicationService $service)
    {
        $this->service = $service;
    }
}
