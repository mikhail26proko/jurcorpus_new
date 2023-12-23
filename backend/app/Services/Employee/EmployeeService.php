<?php

namespace App\Services\Employee;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Traits\Builder\OptionBuilderTrait;
use App\Models\Employee;

class EmployeeService
{
    use OptionBuilderTrait;

    protected $model = Employee::class;

    protected array $relationship = [
        'job_titles',
        'directions',
        'attachment',
    ];

    public function index(): LengthAwarePaginator
    {
        $employees = $this->builder()
            ->filters([
                // Фильтры если необходимы
            ])
                ->paginate(config('app.orchid_one_page'));

        if (!$employees) {
            throw new ModelNotFoundException("Employees not found.", 404);
        }
        return $employees;
    }

    public function get(int | string $id): Employee
    {
        $employee = $this->builder()->where('id', $id)
            ->filters([
                // Фильтры если необходимы
            ])
                ->first();

        if (!$employee) {
            throw new ModelNotFoundException("Employee not found.", 404);
        }
        return $employee;
    }

    public function create(array $data): Employee
    {
        $employee = Employee::create($data);

        return $this->get($employee->id);
    }

    public function update(string $id, array $data): Employee
    {
        $employee = $this->get($id);
        $employee -> fill($data)->save();

        return $this->get($employee->id);
    }

    public function delete(int | string $id): Employee
    {
        $employee = $this->get($id);
        $employee -> delete();

        return $employee;
    }
}
