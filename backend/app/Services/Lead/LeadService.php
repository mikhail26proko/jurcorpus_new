<?php

namespace App\Services\Lead;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Traits\Builder\OptionBuilderTrait;
use App\Enums\StatusEnum;
use App\Models\Lead;

class LeadService
{
    use OptionBuilderTrait;

    protected $model = Lead::class;

    protected array $relationship = [
        //
    ];

    public function index(string $status = ''): LengthAwarePaginator
    {

        $leads = $this->builder();

        if ($status != '') {
            $leads = $leads->where('status',StatusEnum::value($status));
        }

        $leads = $leads->filters([
                //
        ])
            ->paginate(config('app.orchid_one_page'));

        if (!$leads) {
            throw new ModelNotFoundException("Leads not found.", 404);
        }

        // dd($leads);
        // dd(StatusEnum::value($status));
        return $leads;
    }

    public function get(int | string $id): Lead
    {
        $lead = $this->builder()->where('id', $id)
            ->filters([
                // Фильтры если необходимы
            ])
                ->first();

        if (!$lead) {
            throw new ModelNotFoundException("Lead not found.", 404);
        }
        return $lead;
    }

    public function create(array $data): Lead
    {
        $lead = Lead::create($data);
        return $this->get($lead->id);
    }

    public function update(int | string $id, array $data): Lead
    {
        $lead = $this->get($id);
        $lead->fill($data)->save();

        return $this->get($lead->id);
    }

    public function delete(int | string $id): Lead
    {
        $lead = $this->get($id);
        $lead -> delete();

        return $lead;
    }

}
