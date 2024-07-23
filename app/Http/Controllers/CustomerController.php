<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use App\Application\DTO\CustomerDTO;
use App\Http\Requests\CustomerRequest;
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
     * @return JsonResponse
     */
    public function index()
    {
        $customer = $this->service->index();

        return response()->json($customer);

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
     * @param string $id
     * @return JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        $customer = $this->service->find($id);
        return response()->json($customer);
    }

    /**
     * @param CustomerRequest $request
     * @param string $id
     * @throws \ReflectionException
     * @return JsonResponse
     */
    public function update(CustomerRequest $request, string $id): JsonResponse
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
     * @param string $id
     * @return JsonResponse
     */
    public function destroy(string $id): JsonResponse
    {
        $this->service->delete($id);
        return response()->json(null, 204);
    }

    /**
     * @param string $id
     * @return JsonResponse
     */
    public function restore(string $id): JsonResponse
    {
        $this->service->restore($id);
        return response()->json(null, 204);
    }
}
