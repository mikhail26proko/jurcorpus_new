<?php

namespace App\Services\Branch;

use App\Services\CommonService;
use App\Models\Branch;

class BranchService extends CommonService
{
    protected $model = Branch::class;

    protected array $filters = [];

    protected string $orderByFuild = 'id';
    protected string $orderByVector = 'asc';

    protected array $relationship = [
        'employees',
    ];
}
