<?php

namespace App\Http\Resources\Employee;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Branch\BranchResource;
use Illuminate\Http\Request;

class EmployeeResource extends JsonResource
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
            'phone'         => $this->phone,
            'email'         => $this->email,
            'description'   => $this->description,
            'photo'         => $photo ? $photo->url() : null ,
            'job_titles'    => $this->whenLoaded('job_titles',function(){ return array_column($this->job_titles->toArray(),'title');}),
            'directions'    => $this->whenLoaded('directions',function(){ return array_column($this->directions->toArray(),'title');}),
            'branch'        => $this->whenLoaded('branch', new BranchResource($this->branch)),
        ];
    }
}
