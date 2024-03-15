<?php

namespace App\Http\Controllers;

use App\Http\Resources\Service\ServiceResource;
use App\Http\Resources\Service\ServiceCollection;
use App\Services\Service\ServiceService;

class ServiceController extends Controller
{

    private ServiceService $serviceService;

    public function __construct()
    {
        $this->serviceService = new ServiceService();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new ServiceCollection($this->serviceService->index());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new ServiceResource($this->serviceService->get($id));
    }
}
