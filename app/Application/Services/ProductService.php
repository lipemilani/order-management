<?php

namespace App\Application\Services;

use App\Application\DTO\DataTransferObject;
use App\Application\DTO\ProductDTO;
use App\Models\Product;
use App\Repositories\ProductRepository;
use App\Application\Transformers\ProductTransformer;
use Illuminate\Database\Eloquent\Model;

class ProductService extends ApplicationService
{
    /**
     * @param ProductTransformer|null $transformer
     * @param ProductRepository|null $repository
     */
    public function __construct(protected S3Service $s3Service, ProductTransformer $transformer = null, ProductRepository $repository = null)
    {
        parent::__construct($transformer, $repository);
    }

    /**
     * @param DataTransferObject|ProductDTO $dto
     * @return Model|null
     */
    public function store(DataTransferObject|ProductDTO $dto): ?Product
    {
        $model = $this->transformer->toModel($dto);

        $name = $this->s3Service->put($dto->photo);

        $model->photo = $name;

        return $this->repository->store($model);
    }
}
