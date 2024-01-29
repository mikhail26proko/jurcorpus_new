<?php

namespace App\Http\Controllers;

use App\Http\Requests\Lead\StoreLeadRequest;
use App\Http\Resources\Lead\LeadResource;
use App\Services\Lead\LeadService;

class LeadController extends Controller
{
    private LeadService $leadService;

    public function __construct()
    {
        $this->leadService = new LeadService();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLeadRequest $request)
    {
        $data = $request->validated();

        return new LeadResource($this->leadService->create($data));
    }
}
