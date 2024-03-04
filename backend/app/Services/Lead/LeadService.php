<?php

namespace App\Services\Lead;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Services\CommonService;
use App\Enums\StatusEnum;
use App\Models\Lead;

class LeadService extends CommonService
{
    protected $model = Lead::class;

    protected array $filters = [];

    protected array $relationship = [
        'branch',
        'journals',
    ];

    public function index(array $filters = []): LengthAwarePaginator
    {
        $leads = Lead::byFilters($filters)
            ->paginate(config('app.orchid_one_page'));

        if (!$leads) {
            throw new ModelNotFoundException("Leads not found.", 404);
        }

        return $leads;
    }

    public function create(array $data): Lead
    {
        if (empty($data['status'])) {
            $data['status'] = StatusEnum::new;
        }

        return parent::create($data);
    }

}
