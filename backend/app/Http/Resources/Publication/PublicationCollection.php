<?php

namespace App\Http\Resources\Publication;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Employee\EmployeeShortResource;
use App\Http\Resources\PubSource\PubSourceResource;
use Illuminate\Http\Request;
use App\Models\PubSource;
use App\Models\Employee;

class PublicationCollection extends ResourceCollection
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

    /**
     * Получить дополнительные данные, возвращаемые с массивом ресурса.
     *
     * @return array<string, mixed>
     */
    public function with(Request $request): array
    {
        return [
            'filters' => [
                'employees'     => EmployeeShortResource::collection(Employee::publisher()->get()),
                'pub_source'    => PubSourceResource::collection(PubSource::all()),
            ],
        ];
    }
}
