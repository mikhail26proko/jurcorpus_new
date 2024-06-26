<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Orchid\Presenters\EmployeePresenter;
use Illuminate\Database\Eloquent\Builder;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Types\Where;
use Carbon\Carbon;

class Employee extends ExtendModel
{
    use Attachable, SoftDeletes;

    protected $fillable = [
        'last_name',        // Фамилия
        'first_name',       // Имя
        'sur_name',         // Отчество
        'birthday',         // День рождения
        'practiceStartDate',// Начало практики
        'email',
        'phone',
        'branch_id',
        'description',
    ];

    protected $appends = [
        'full_name'
    ];

    protected $allowedFilters = [
        'last_name'        => Where::class,
        'first_name'       => Where::class,
        'sur_name'         => Where::class,
    ];

    protected $allowedSorts = [
        'id',
        'last_name',        // Фамилия
        'first_name',       // Имя
        'sur_name',         // Отчество
        'birthday',         // День рождения
        'practiceStartDate',// Начало практики
    ];

    protected $casts = [
        'birthday'          => 'datetime:d.m.Y',
        'practiceStartDate' => 'datetime:d.m.Y',
    ];

    // Связи

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function job_titles()
    {
        return $this->belongsToMany(JobTitle::class, 'employee_job_title');
    }

    public function directions()
    {
        return $this->belongsToMany(Direction::class, 'employee_direction');
    }

    public function publication()
    {
        return $this->HasMany(Publication::class,'employee_id');
    }

    // Аксессоры

    public function getFullNameAttribute()
    {
        return implode(' ',[$this->last_name, $this->first_name, $this->sur_name]);
    }

    // Мутаторы

    public function setBirthdayAttribute($value)
    {
        $this->attributes['birthday'] = !empty($value) ? new Carbon($value): null;
    }

    public function setPracticeStartDateAttribute($value)
    {
        $this->attributes['practiceStartDate'] = !empty($value) ? new Carbon($value): null;
    }

    // Скоупы

    public function scopePublisher(Builder $query): Builder
    {
        return $query->whereHas('publication');
    }

    // Презентер

    public function presenter(): EmployeePresenter
    {
        return new EmployeePresenter($this);
    }

    // public function lozalization(){
    //     return $this->morphMany(Localization::class, 'localizable');
    // }
}