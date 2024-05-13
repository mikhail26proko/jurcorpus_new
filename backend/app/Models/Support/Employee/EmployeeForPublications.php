<?php

namespace App\Models\Support\Employee;

use Illuminate\Database\Eloquent\Builder;
use App\Models\Employee;

class EmployeeForPublications extends Employee
{
    /**
     * Таблица БД, ассоциированная с моделью.
     *
     * @var string
     */
    protected $table = 'employees';

    protected static function booted(): void
    {
        static::addGlobalScope('orderByPublicationCount', function (Builder $builder) {
            $builder->withCount('publication')
                ->orderBy('publication_count', 'desc');
        });
    }
}