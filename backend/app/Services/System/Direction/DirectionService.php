<?php

namespace App\Services\System\Direction;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Traits\Builder\OptionBuilderTrait;
use App\Models\Direction;

class DirectionService
{
    use OptionBuilderTrait;

    protected $model = Direction::class;

    protected array $relationship = [
        //
    ];

    public function index(): LengthAwarePaginator
    {
        $directions = $this->builder()
            ->filters([
                // Фильтры если необходимы
            ])
                ->paginate(config('app.orchid_one_page'));

        if (!$directions) {
            throw new ModelNotFoundException("Directions not found.", 404);
        }
        return $directions;
    }

    public function get(int | string $id): Direction
    {
        $direction = $this->builder()->where('id', $id)
            ->filters([
                // Фильтры если необходимы
            ])
                ->first();

        if (!$direction) {
            throw new ModelNotFoundException("Direction not found.", 404);
        }
        return $direction;
    }

    public function create(array $data): Direction
    {
        $direction = Direction::create($data);

        return $this->get($direction->id);
    }

    public function update(int | string $id, array $data): Direction
    {
        $direction = $this->get($id);
        $direction->fill($data)->save();

        return $this->get($direction->id);
    }

    public function delete(int | string $id): Direction
    {
        $direction = $this->get($id);
        $direction -> delete();

        return $direction;
    }

}
