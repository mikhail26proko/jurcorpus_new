<?php

namespace App\Services\Publication;

use App\Orchid\Filters\PubSourceFilter;
use App\Orchid\Filters\EmployeeFilter;
use App\Orchid\Filters\PubTypeFilter;
use App\Services\CommonService;
use App\Models\Publication;

class PublicationService extends CommonService
{
    protected $model = Publication::class;

    protected array $filters = [
        EmployeeFilter::class,
        PubSourceFilter::class,
        PubTypeFilter::class,
    ];

    protected string $orderByFuild = 'publicated_at';
    protected string $orderByVector = 'desc';

    protected array $relationship = [
        'pub_source',
        'pub_type',
        'employee',
        'attachment',
    ];
}
