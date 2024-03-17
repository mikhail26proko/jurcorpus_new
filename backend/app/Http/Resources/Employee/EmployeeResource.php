<?php

namespace App\Http\Resources\Employee;

use App\Http\Resources\Branch\BranchResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
            'full_name'     => $this->full_name,
            'phone'         => $this->phone,
            'email'         => $this->email,
            'description'   => $this->description,
            'job_titles'    => $this->whenLoaded('job_titles',function(){ return array_column($this->job_titles->toArray(),'title');}),
            'directions'    => $this->whenLoaded('directions',function(){ return array_column($this->directions->toArray(),'title');}),
            'branch'        => $this->whenLoaded('branch', new BranchResource($this->branch)),
        ];
    }
}
