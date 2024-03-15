<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Vacansy extends ExtendModel
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
    ];
}
