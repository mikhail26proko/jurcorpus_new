<?php

namespace App\Http\Controllers;

use App\Http\Resources\Employee\EmployeeCollection;
use App\Http\Resources\Employee\EmployeeResource;
use App\Services\Employee\EmployeeService;

class EmployeeController extends Controller
{

    private EmployeeService $employeeService;

    public function __construct()
    {
        $this->employeeService = new EmployeeService();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new EmployeeCollection($this->employeeService->index());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new EmployeeResource($this->employeeService->get($id));
    }
}
