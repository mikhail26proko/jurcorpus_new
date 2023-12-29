<?php

namespace App\Services\Lead;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Services\CommonService;
use App\Models\Lead;

class LeadService extends CommonService
{
    protected $model = Lead::class;

    protected array $relationship = [
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

}
