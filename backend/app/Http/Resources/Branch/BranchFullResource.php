<?php

namespace App\Http\Resources\Branch;

use App\Http\Resources\Employee\EmployeeCollection;
use Illuminate\Http\Request;

class BranchFullResource extends BranchResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            ...parent::toArray($request),
            'employees' => $this->whenLoaded('employees', new EmployeeCollection($this->employees)),
        ];
    }
}
