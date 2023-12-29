<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class SystemLog extends Model
{
    use HasFactory,
        AsSource;

    protected static function booted()
    {
        static::creating(function(SystemLog $log){
            $log->user_id = auth()->id() ?? null;
        });
    }

    public $timestamps = false;

    protected $fillable = [
        'type',
        'entity',
        'data',
        'user_id',
        'created_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
