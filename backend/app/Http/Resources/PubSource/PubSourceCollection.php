<?php

namespace App\Http\Resources\PubSource;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Request;

class PubSourceCollection extends ResourceCollection
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
