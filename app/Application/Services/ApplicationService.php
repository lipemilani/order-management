<?php

namespace App\Application\Services;

use Illuminate\Database\Eloquent\Model;
use App\Application\DTO\DataTransferObject;
use App\Application\Transformers\Transformer;
use App\Repositories\EntityRepositoryContract;

class ApplicationService
{
    /**
     * @var Transformer|null
     */
    private ?Transformer $transformer;

    /**
     * @var EntityRepositoryContract|null
     */
    private ?EntityRepositoryContract $repository;

    public function __construct(?Transformer $transformer = null, ?EntityRepositoryContract $repository = null)
    {
        $this->repository = $repository;
        $this->transformer = $transformer;
    }

    public function index($data)
    {
        return $this->repository->index($data);
    }

    /**
     * @param DataTransferObject $dto
     * @return Model|null
     */
    public function store(DataTransferObject $dto): ?Model
    {
        $model = $this->transformer->toModel($dto);

        return $this->repository->store($model);
    }

    /**
     * @param DataTransferObject $dto
     * @return Model|null
     */
    public function update(DataTransferObject $dto): ?Model
    {
        $model = $this->find(optional($dto)->id);

        if ($model === null) {
            return null;
        }

        $this->transformer->prepareForUpdate($model, $dto);

        return $this->repository->update($model);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->repository->find($id);
    }

    /**
     * @param string $id
     * @return bool
     */
    public function delete(string $id): bool
    {
        $model = $this->find($id);

        if ($model === null) {
            return false;
        }

        $this->repository->delete($model);

        return true;
    }

    /**
     * @param string $id
     * @return bool
     */
    public function restore(string $id): bool
    {
        $model = $this->find($id);

        if ($model === null) {
            return false;
        }

        $this->repository->restore($model);

        return true;
    }
}
