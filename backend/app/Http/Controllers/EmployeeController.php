<?php

namespace App\Http\Controllers;

use App\Http\Resources\Employee\EmployeeResource;
use App\Http\Resources\Employee\EmployeeCollection;
use App\Services\Employee\EmployeeService;

class EmployeeController extends Controller
{

    private EmployeeService $branchService;

    public function __construct()
    {
        $this->branchService = new EmployeeService();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new EmployeeCollection($this->branchService->index());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new EmployeeResource($this->branchService->get($id));
    }
}
