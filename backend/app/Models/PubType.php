<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class PubType extends ExtendModel
{
    use SoftDeletes;

    protected $fillable = [
        'title'
    ];

    public function publications()
    {
        return $this->hasMany(Publication::class);
    }
}
