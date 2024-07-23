<?php

namespace App\Repositories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class EntityRepository implements EntityRepositoryContract
{
    protected string $entityClassName;
    public function getEntityClassName(): string
    {
        return $this->entityClassName;
    }

    public function index()
    {
        return $this->getEntityClassName()::paginate()->all();
    }

    public function find($id)
    {
        return $this->getEntityClassName()::find($id);
    }

    public function store(Model $model)
    {
        $model->created_at = Carbon::now()->setTimezone('America/Sao_Paulo');
        $model->active = true;

        unset($model->id);
        $model = $model::create($model->toArray());

        return $model;
    }

    public function update(Model $model)
    {
        $model->save();

        return $model;
    }

    public function delete(Model $model)
    {
        $model->active = false;

        $model->save();
    }

    public function restore(Model $model)
    {
        $model->active = true;

        $model->save();
    }
}
