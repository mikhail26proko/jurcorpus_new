<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Orchid\Presenters\EmployeePresenter;
use Illuminate\Database\Eloquent\Model;
use Orchid\Platform\Concerns\Sortable;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Employee extends Model
{

    use HasFactory,
        AsSource,
        Sortable,
        Filterable,
        Attachable;

    protected $fillable = [
        'last_name',
        'first_name',
        'sur_name',
        'email',
        'phone',
        'branch_id',
        'description',
    ];

    protected $appends = [
        'full_name'
    ];

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

    public function getFullNameAttribute()
    {
        return implode(' ',[$this->last_name, $this->first_name, $this->sur_name]);
    }

    public function presenter(): EmployeePresenter
    {
        return new EmployeePresenter($this);
    }

    // public function lozalization(){
    //     return $this->morphMany(Localization::class, 'localizable');
    // }
}