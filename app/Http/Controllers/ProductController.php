<?php

namespace App\Http\Controllers;

use App\Application\Services\S3Service;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use App\Application\DTO\ProductDTO;
use App\Http\Requests\ProductRequest;
use App\Application\Services\ProductService;
use Illuminate\Http\UploadedFile;

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
     * @return JsonResponse
     */
    public function index()
    {
        $customer = $this->service->index();

        return response()->json($customer);

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
     * @param string $id
     * @return JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        $product = $this->service->find($id);
        return response()->json($product);
    }

    /**
     * @param ProductRequest $request
     * @param string $id
     * @throws \ReflectionException
     * @return JsonResponse
     */
    public function update(ProductRequest $request, string $id): JsonResponse
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
