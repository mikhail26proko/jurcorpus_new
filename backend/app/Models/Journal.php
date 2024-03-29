<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Journal extends ExtendModel
{
    use SoftDeletes;

    protected static function booted()
    {
        parent::booted();
        static::creating(function(Journal $journal){
            $journal->user_id = auth()->id() ?? null;
        });
    }
    protected $fillable = [
        'lead_id',
        'message',
    ];

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
