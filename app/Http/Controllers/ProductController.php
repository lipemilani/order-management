<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use App\Application\DTO\ProductDTO;
use App\Http\Requests\ProductRequest;
use App\Application\Services\ProductService;

class ProductController extends Controller
{
    /**
     * ProductController constructor.
     * @param ProductService $service
     */
    public function __construct(ProductService $service)
    {
        parent::__construct($service);
    }

    /**
     * @param ProductRequest $request
     * @throws \ReflectionException
     * @return JsonResponse
     */
    public function store(ProductRequest $request): JsonResponse
    {
        $dto = ProductDTO::fromRequest($request);

        $product = $this->service->store($dto);

        return response()->json($product);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $product = $this->service->find($id);
        return response()->json($product);
    }

    /**
     * @param ProductRequest $request
     * @param int $id
     * @throws \ReflectionException
     * @return JsonResponse
     */
    public function update(ProductRequest $request, int $id): JsonResponse
    {
        /**
         * @var Product $product
         */
        $dto = ProductDTO::fromRequest($request);
        $dto->id = $id;
        $product = $this->service->update($dto);
        return response()->json($product);
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
