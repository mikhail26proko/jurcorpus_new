<?php

namespace App\Models;

use Orchid\Filters\Types\WhereIn;

class Lead extends ExtendModel
{
    protected $fillable = [
        'fio',
        'email',
        'phone',
        'message',
        'status',
    ];

    public function journals()
    {
        return $this->hasMany(Journal::class,'lead_id')->orderByDesc('created_at');
    }

    public function scopeByStatus($query, array $status): void
    {
        if (empty($status) || in_array('Все', $status))
            return;

        $query->whereIn('status', $status);
    }

}
