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
}
