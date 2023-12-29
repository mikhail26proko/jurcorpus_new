<?php

namespace App\Models;

class Journal extends ExtendModel
{
    protected $fillable = [
        'lead_id',
        'message',
    ];

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
}
