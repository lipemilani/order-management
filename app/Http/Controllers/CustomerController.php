<?php

namespace App\Http\Controllers;

use App\Application\DTO\CustomerDTO;
use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Application\Services\CustomerService;

class CustomerController extends Controller
{
    /**
     * CustomerController constructor.
     * @param CustomerService $service
     */
    public function __construct(CustomerService $service)
    {
        parent::__construct($service);
    }

    /**
     * @param CustomerRequest $request
     * @throws \ReflectionException
     * @return JsonResponse
     */
    public function store(CustomerRequest $request): JsonResponse
    {
        $dto = CustomerDTO::fromRequest($request);

        $customer = $this->service->store($dto);

        return response()->json($customer);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $customer = $this->service->find($id);
        return response()->json($customer);
    }

    /**
     * @param CustomerRequest $request
     * @param int $id
     * @throws \ReflectionException
     * @return JsonResponse
     */
    public function update(CustomerRequest $request, int $id): JsonResponse
    {
        /**
         * @var Customer $customer
         */
        $dto = CustomerDTO::fromRequest($request);
        $dto->id = $id;
        $customer = $this->service->update($dto);
        return response()->json($customer);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);
        return response()->json(null, 204);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function restore(int $id): JsonResponse
    {
        $this->service->restore($id);
        return response()->json(null, 204);
    }
}
