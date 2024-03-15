<?php

namespace App\Http\Resources\Vacansy;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class VacansyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'title'             => $this->title,
            'description'       => $this->description,
        ];
    }
}
