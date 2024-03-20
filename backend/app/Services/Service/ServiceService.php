<?php

namespace App\Services\Service;

use App\Services\CommonService;
use App\Models\Service;

class ServiceService extends CommonService
{
    protected $model = Service::class;

    protected string $orderByFuild = 'sort';
    protected string $orderByVector = 'asc';

    protected array $filters = [];

    protected array $relationship = [];

    public function preCreate(array $data): array
    {
        $count = (new Service)->count();

        if ($data['sort'] >= $count || $data['sort'] <= 0){
            $data['sort'] = $count+1;
        } else {
            $this->moveUp($data['sort']);
        }

        return $data;
    }

    public function preUpdate(string|int $id, array $data): array
    {

        $count = (new Service)->count();
        $prewSort = $this->get($id)['sort'];

        if ($data['sort'] == $prewSort)
            return $data;

        if ($data['sort'] == $count || $data['sort'] <= 0){
            $this->moveDown($prewSort);
            $data['sort'] = $count;
        } else {
            $this->moveDown($prewSort+1);
            $this->moveUp($data['sort']);
        }


        return $data;
    }

    public function preDelete(string|int $id): bool
    {
        $prewSort = $this->get($id)['sort'];
        return $this->moveDown($prewSort+1);
    }

    public function moveUp(int $position): bool
    {
        $entity = (new $this->model)->where('sort','>=',$position);
        return $entity->increment('sort');
    }

    public function moveDown(int $position): bool
    {
        $entity = (new $this->model)->where('sort','>=',$position);
        return $entity->decrement('sort');
    }
}
