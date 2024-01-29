<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Platform\Concerns\Sortable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Lead extends Model
{
    use HasFactory,
        AsSource,
        Sortable,
        Filterable;

    protected static function booted()
    {
        static::updated(function(Lead $lead){
            if (auth()->id()){
                SystemLog::create([
                    'type'      => 'updated',
                    'entity'    => $lead::class,
                    'data'      => $lead->toJson(JSON_UNESCAPED_UNICODE),
                ]);
            }
        });
    }

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
