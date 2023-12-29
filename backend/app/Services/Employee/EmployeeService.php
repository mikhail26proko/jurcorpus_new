<?php

namespace App\Services\Employee;

use App\Services\CommonService;
use App\Models\Employee;

class EmployeeService extends CommonService
{
    protected $model = Employee::class;

    protected array $relationship = [
        'job_titles',
        'directions',
        'attachment',
    ];
}
