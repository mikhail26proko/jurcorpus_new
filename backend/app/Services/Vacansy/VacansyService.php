<?php

namespace App\Services\Vacansy;

use App\Services\CommonService;
use App\Models\Vacansy;

class VacansyService extends CommonService
{
    protected $model = Vacansy::class;

    protected array $filters = [];

    protected array $relationship = [];

}
