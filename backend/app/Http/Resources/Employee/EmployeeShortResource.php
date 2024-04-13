<?php

namespace App\Http\Resources\Employee;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class EmployeeShortResource extends JsonResource
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
            'full_name'     => $this->full_name,
        ];
    }
}
