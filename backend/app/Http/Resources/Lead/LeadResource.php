<?php

namespace App\Http\Resources\Lead;

use App\Http\Resources\Branch\BranchResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LeadResource extends JsonResource
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
            'fio'           => $this->fio,
            'email'         => $this->email,
            'phone'         => $this->phone,
            'created_at'    => $this->created_at,
        ];
    }
}
