<?php

namespace App\Http\Resources\Publication;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PublicationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $photo = $this->attachment()->first();

        return [
            'id'            => $this->id,
            'pub_source'    => $this->pub_source->title,
            'employee_id'   => $this->employee->full_name,
            'title'         => $this->title,
            'sub_title'     => $this->sub_title,
            'publicated_at' => $this->publicated_at,
            'photo'         => $photo ? $photo->url() : null,
            'link'          => $this->link,
        ];
    }
}
