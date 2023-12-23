<?php

namespace App\Services\System\JobTitle;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Traits\Builder\OptionBuilderTrait;
use App\Models\JobTitle;

class JobTitleService
{
    use OptionBuilderTrait;

    protected $model = JobTitle::class;

    protected array $relationship = [
        //
    ];

    public function index(): LengthAwarePaginator
    {
        $jobTitles = $this->builder()
            ->filters([
                // Фильтры если необходимы
            ])
                ->paginate(config('app.orchid_one_page'));

        if (!$jobTitles) {
            throw new ModelNotFoundException("JobTitles not found.", 404);
        }
        return $jobTitles;
    }

    public function get(int | string $id): JobTitle
    {
        $JobTitle = $this->builder()->where('id', $id)
            ->filters([
                // Фильтры если необходимы
            ])
                ->first();

        if (!$JobTitle) {
            throw new ModelNotFoundException("JobTitle not found.", 404);
        }
        return $JobTitle;
    }

    public function create(array $data): JobTitle
    {
        $JobTitle = JobTitle::create($data);

        return $this->get($JobTitle->id);
    }

    public function update(int | string $id, array $data): JobTitle
    {
        $JobTitle = $this->get($id);
        $JobTitle->fill($data)->save();

        return $this->get($JobTitle->id);
    }

    public function delete(int | string $id): JobTitle
    {
        $JobTitle = $this->get($id);
        $JobTitle -> delete();

        return $JobTitle;
    }

}
