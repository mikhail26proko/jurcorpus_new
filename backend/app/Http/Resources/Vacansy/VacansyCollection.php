<?php

namespace App\Http\Resources\Vacansy;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Request;

class VacansyCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
