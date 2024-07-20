<?php

namespace App\Application\Transformers;

use App\Models\Customer;
use App\Application\DTO\CustomerDTO;
use Illuminate\Database\Eloquent\Model;
use App\Application\DTO\DataTransferObject;


class CustomerTransformer extends Transformer
{

    /**
     * @param CustomerDTO|DataTransferObject $dto
     * @return Customer
     */
    public function toModel(DataTransferObject $dto): Customer
    {
        $model = new Customer();

        $model->id = $dto->id;
        $model->name = $dto->name;
        $model->email = $dto->email;
        $model->phone = $dto->phone;
        $model->date_of_birth = $dto->dateOfBirth;
        $model->address = $dto->address;
        $model->complement = $dto->complement;
        $model->neighborhood = $dto->neighborhood;
        $model->cep = $dto->cep;
        $model->created_at = $dto->createdAt;
        $model->active = $dto->active;

    }

    /**
     * @param Model $model
     * @param CustomerDTO|DataTransferObject $dto
     * @return void
     */
    public function prepareForUpdate(Model &$model, DataTransferObject $dto)
    {
        !array_key_exists('name', $dto->requestData) ?: $model->name = $dto->name;
        !array_key_exists('email', $dto->requestData) ?: $model->email = $dto->email;
        !array_key_exists('phone', $dto->requestData) ?: $model->phone = $dto->phone;
        !array_key_exists('data_of_birth', $dto->requestData) ?: $model->data_of_birth = $dto->dateOfBirth;
        !array_key_exists('address', $dto->requestData) ?: $model->address = $dto->address;
        !array_key_exists('complement', $dto->requestData) ?: $model->complement = $dto->complement;
        !array_key_exists('neighborhood', $dto->requestData) ?: $model->neighborhood = $dto->neighborhood;
        !array_key_exists('cep', $dto->requestData) ?: $model->cep = $dto->cep;
        !array_key_exists('created_at', $dto->requestData) ?: $model->created_at = $dto->createdAt;
        !array_key_exists('name', $dto->requestData) ?: $model->name = $dto->name;
        !array_key_exists('active', $dto->requestData) ?: $model->active = $dto->active;
    }
}
