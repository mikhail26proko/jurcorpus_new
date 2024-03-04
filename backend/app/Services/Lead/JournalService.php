<?php

namespace App\Services\Lead;

use App\Services\CommonService;
use App\Models\Journal;

class JournalService extends CommonService
{
    protected $model = Journal::class;

    protected array $filters = [];

    protected array $relationship = [
        'user',
    ];
}
