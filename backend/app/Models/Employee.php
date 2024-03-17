<?php

namespace App\Models;

use App\Orchid\Presenters\EmployeePresenter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Types\Where;
use Carbon\Carbon;

class Employee extends ExtendModel
{
    use Attachable, SoftDeletes;

    protected $fillable = [
        'last_name',    // Фамилия
        'first_name',   // Имя
        'sur_name',     // Отчество
        'birthday',
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
        'last_name',    // Фамилия
        'first_name',   // Имя
        'sur_name',     // Отчество
        'birthday',
    ];

    protected $casts = [
        'birthday' => 'datetime:d.m.Y',
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

    // Аксессоры

    public function getFullNameAttribute()
    {
        return implode(' ',[$this->last_name, $this->first_name, $this->sur_name]);
    }

    // Мутаторы

    public function setBirthdayAttribute($value)
    {
        if (!empty($value))
        {
            $this->attributes['birthday'] = new Carbon($value);
        }
    }

    public function presenter(): EmployeePresenter
    {
        return new EmployeePresenter($this);
    }

    // public function lozalization(){
    //     return $this->morphMany(Localization::class, 'localizable');
    // }
}