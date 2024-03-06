<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Orchid\Attachment\Attachable;
use Carbon\Carbon;

class Publication extends ExtendModel
{
    use Attachable, SoftDeletes;

    protected $fillable = [
        'pub_source_id',
        'pub_type_id',
        'employee_id',
        'title',
        'sub_title',
        'publicated_at',
        'link',
    ];

    protected $casts = [
        'publicated_at' => 'datetime:d.m.Y',
    ];

    public function pub_source()
    {
        return $this->belongsTo(PubSource::class);
    }

    public function pub_type()
    {
        return $this->belongsTo(PubType::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    // Мутаторы

    public function setPublicatedAtAttribute($value)
    {
        $this->attributes['publicated_at'] = new Carbon($value);
    }
}
