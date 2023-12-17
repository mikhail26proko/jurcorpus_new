<?php

namespace App\Services\Branch;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Traits\Builder\OptionBuilderTrait;
use App\Models\Branch;

class BranchService
{
    use OptionBuilderTrait;

    protected $model = Branch::class;

    protected array $relationship = [
        // Связи по умолчанию
    ];

    public function index(): LengthAwarePaginator
    {
        $branchs = $this->builder()
            ->filters([
                // Фильтры если необходимы
            ])
                ->paginate(config('app.orchid_one_page'));

        if (!$branchs) {
            throw new ModelNotFoundException("Branchs not found.", 404);
        }
        return $branchs;
    }

    public function get(int | string $id): Branch
    {
        $branch = $this->builder()->where('id', $id)
            ->filters([
                // Фильтры если необходимы
            ])
                ->first();

        if (!$branch) {
            throw new ModelNotFoundException("Branch not found.", 404);
        }
        return $branch;
    }

    public function create(array $data): Branch
    {
        $branch = Branch::create($data);

        return $this->get($branch->id);
    }

    public function update(int | string $id, array $data): Branch
    {
        $branch = $this->get($id);
        $branch->fill($data)->save();

        return $this->get($branch->id);
    }

    public function delete(int | string $id): Branch
    {
        $branch = $this->get($id);
        $branch -> delete();

        return $branch;
    }

}
