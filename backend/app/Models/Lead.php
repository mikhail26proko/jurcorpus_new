<?php

namespace App\Models;

class Lead extends ExtendModel
{
    protected $fillable = [
        'branch_id',
        'fio',
        'email',
        'phone',
        'message',
        'status',
        'user_id',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function journals()
    {
        return $this->hasMany(Journal::class,'lead_id')->orderByDesc('created_at');
    }

    public function scopeByFilters($query, array $filters): void
    {
        if (!empty($filters)){
            if (!empty($filters['status'])) {
                $this->scopeByStatus($query, $filters['status']);
            }
            if (!empty($filters['user'])){
                $this->scopeByUser($query, $filters['user']);
            }
        }
    }

    protected function scopeByStatus($query, array $status): void
    {
        if (empty($status) || in_array('Все', $status))
            return;

        $query->whereIn('status', $status);
    }


    protected function scopeByUser($query, array $user_ids): void
    {
        if (empty($user_ids))
            return;

        $query->whereIn('user_id', $user_ids);
    }

}
