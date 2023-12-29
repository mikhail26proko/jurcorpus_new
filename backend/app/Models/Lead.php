<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Platform\Concerns\Sortable;
use Orchid\Filters\Types\WhereIn;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Lead extends Model
{
    use HasFactory,
        AsSource,
        Sortable,
        Filterable;

    /**
     * @var array
     */
    protected $allowedFilters = [
        'status'       => WhereIn::class,
    ];

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
