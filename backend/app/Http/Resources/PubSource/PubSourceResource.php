<?php

namespace App\Http\Resources\PubSource;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class PubSourceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'title'         => $this->title,
        ];
    }
}
