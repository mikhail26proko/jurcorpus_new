<?php

namespace App\Services\Publication;

use App\Orchid\Filters\PubSourceFilter;
use App\Orchid\Filters\EmployeeFilter;
use App\Orchid\Filters\PubTypeFilter;
use App\Orchid\Filters\TitleFilter;
use App\Services\CommonService;
use App\Models\Publication;

class PublicationService extends CommonService
{
    protected $model = Publication::class;

    protected array $filters = [
        EmployeeFilter::class,
        PubSourceFilter::class,
        PubTypeFilter::class,
        TitleFilter::class
    ];

    protected string $orderByFuild = 'publicated_at';
    protected string $orderByVector = 'desc';

    protected array $relationship = [
        'pub_source',
        'pub_type',
        'employee',
        'attachment',
    ];

    public function afterCreate(array $data): void
    {
        $publication = $this->get($data['id']);
        $publication->attachment()->sync($data['photo']);
    }

    public function afterUpdate(int|string $id, array $data): void
    {
        $publication = $this->get($id);
        $publication->attachment()->sync($data['photo']);
    }
}
