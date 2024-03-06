<?php

namespace App\Http\Controllers;

use App\Http\Resources\Publication\PublicationCollection;
use App\Services\Publication\PublicationService;

class PublicationController extends Controller
{
    private PublicationService $publicationService;

    public function __construct()
    {
        $this->publicationService = new PublicationService();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new PublicationCollection($this->publicationService->index());
    }
}
