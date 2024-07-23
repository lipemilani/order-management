<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface EntityRepositoryContract
{
    /**
     * Returns the class name of the object managed by the repository.
     * @return string
     */
    public function getEntityClassName(): string;

    /**
     * @return mixed
     */
    public function index();

    /**
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * @param Model $model
     * @return mixed
     */
    public function store(Model $model);

    /**
     * @param Model $model
     * @return mixed
     */
    public function update(Model $model);

    /**
     * @param Model $model
     * @return mixed
     */
    public function delete(Model $model);

    /**
     * @param Model $model
     * @return mixed
     */
    public function restore(Model $model);
}
