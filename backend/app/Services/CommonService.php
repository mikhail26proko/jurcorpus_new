<?php

namespace App\Services;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Traits\Builder\OptionBuilderTrait;
use Illuminate\Database\Eloquent\Model;

class CommonService
{
    use OptionBuilderTrait;

    protected $model;

    protected array $relationship = [];

    public function index(): LengthAwarePaginator
    {
        $entity = $this->builder()->filters([
            // common_filters
        ])
            ->paginate(config('app.orchid_one_page'));

        if (!$entity) {
            throw new ModelNotFoundException("$this->model not found.", 404);
        }

        return $entity;
    }

    public function get(int | string $id): Model
    {
        $entity = $this->builder()->where('id', $id)
            ->filters([
                // common_filters
            ])
                ->first();

        if (!$entity) {
            throw new ModelNotFoundException("$this->model not found.", 404);
        }
        return $entity;
    }

    public function create(array $data): Model
    {
        $entity = ($this->model)::create($data);
        return $this->get($entity->id);
    }

    public function update(int | string $id, array $data): Model
    {
        $entity = $this->get($id);
        $entity->fill($data)->save();

        return $this->get($entity->id);
    }

    public function delete(int | string $id): Model
    {
        $entity = $this->get($id);
        $entity -> delete();

        return $entity;
    }

}
