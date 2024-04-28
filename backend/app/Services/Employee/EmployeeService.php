<?php

namespace App\Services\Employee;

use App\Orchid\Filters\FullNameFilter;
use App\Orchid\Filters\BranchFilter;
use App\Orchid\Filters\FullNameSort;
use App\Services\CommonService;
use App\Models\Employee;

class EmployeeService extends CommonService
{
    protected $model = Employee::class;

    protected array $filters = [
        BranchFilter::class,
        FullNameSort::class,
        FullNameFilter::class,
    ];

    protected string $orderByFuild = 'id';
    protected string $orderByVector = 'asc';

    protected array $relationship = [
        'job_titles',
        'directions',
        'attachment',
    ];

    public function afterCreate(array $data): void
    {
        $employee = $this->get($data['id']);
        $employee->attachment()->sync($data['photo']);
    }

    public function afterUpdate(int|string $id, array $data): void
    {
        $employee = $this->get($id);
        $employee->attachment()->sync($data['photo']);
    }
}
