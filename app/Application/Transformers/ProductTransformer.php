<?php

namespace App\Application\Transformers;

use App\Models\Product;
use App\Application\DTO\ProductDTO;
use Illuminate\Database\Eloquent\Model;
use App\Application\DTO\DataTransferObject;

/**
 *
 */
class ProductTransformer extends Transformer
{

    /**
     * @param ProductDTO|DataTransferObject $dto
     * @return Product
     */
    public function toModel(DataTransferObject $dto): Product
    {
        $model = new Product();

        $model->id = $dto->id;
        $model->name = $dto->name;
        $model->price = $dto->price;
        $model->photo = $dto->photo;
        $model->active = $dto->active;

    }

    /**
     * @param Model $model
     * @param ProductDTO|DataTransferObject $dto
     * @return void
     */
    public function prepareForUpdate(Model &$model, DataTransferObject $dto)
    {
        !array_key_exists('name', $dto->requestData) ?: $model->name = $dto->name;
        !array_key_exists('price', $dto->requestData) ?: $model->price = $dto->price;
        !array_key_exists('photo', $dto->requestData) ?: $model->photo = $dto->photo;
        !array_key_exists('active', $dto->requestData) ?: $model->active = $dto->active;
    }
}
