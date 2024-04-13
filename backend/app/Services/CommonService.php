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

    protected array $filters = [];
    protected array $relationship = [];

    public function index(): LengthAwarePaginator
    {
        $entity = $this->builder()->filters($this->filters)
            ->paginate(config('app.orchid_one_page'));

        if (!$entity) {
            throw new ModelNotFoundException("$this->model not found.", 404);
        }

        return $entity;
    }

    public function indexWithTrashed(): LengthAwarePaginator
    {
        $entity = ($this->builder())->withoutGlobalScopes()->filters($this->filters)
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

    public function preCreate(array $data): array
    {
        return $data;
    }
    public function create(array $data): Model
    {
        if (empty($data = $this->preCreate($data))) {
            throw new \Exception('Не удалось выполнить действие перед созданием');
        }

        $entity = ($this->model)::create($data);

        $this->afterCreate($data);

        return $this->get($entity->id);
    }

    public function afterCreate(array $data): void
    {}

    public function preUpdate(int | string $id, array $data): array
    {
        return $data;
    }
    public function update(int | string $id, array $data): Model
    {
        if (empty($data = $this->preUpdate($id, $data)))
        {
            throw new \Exception('Не удалось выполнить действие перед обновлением');
        }

        $entity = $this->get($id);
        $entity->fill($data)->save();

        $this->afterUpdate($id, $data);

        return $this->get($entity->id);
    }

    public function afterUpdate(int | string $id, array $data): void
    {}

    public function preDelete(int | string $id): bool
    {
        return true;
    }

    public function delete(int | string $id): Model
    {
        if (!$this->preDelete($id))
        {
            throw new \Exception('Не удалось выполнить действие перед удалением');
        }
        $entity = $this->get($id);
        $entity -> delete();

        $this->afterDelete($id);

        return $entity;
    }

    public function afterDelete(int | string $id): void
    {}
}
