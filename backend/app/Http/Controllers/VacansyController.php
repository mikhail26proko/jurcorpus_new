<?php

namespace App\Http\Controllers;

use App\Http\Resources\Vacansy\VacansyCollection;
use App\Http\Resources\Vacansy\VacansyResource;
use App\Services\Vacansy\VacansyService;

class VacansyController extends Controller
{

    private VacansyService $vacansyService;

    public function __construct()
    {
        $this->vacansyService = new VacansyService();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new VacansyCollection($this->vacansyService->index());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new VacansyResource($this->vacansyService->get($id));
    }
}
