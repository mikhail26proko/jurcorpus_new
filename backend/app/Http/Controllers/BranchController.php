<?php

namespace App\Http\Controllers;

use App\Http\Resources\Branch\BranchFullResource;
use App\Http\Resources\Branch\BranchCollection;
use App\Services\Branch\BranchService;

class BranchController extends Controller
{

    private BranchService $branchService;

    public function __construct()
    {
        $this->branchService = new BranchService();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new BranchCollection($this->branchService->index());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new BranchFullResource($this->branchService->get($id));
    }
}
