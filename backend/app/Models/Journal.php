<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Platform\Concerns\Sortable;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Journal extends Model
{
    use HasFactory,
        AsSource,
        Sortable,
        Attachable,
        Filterable;

    protected $fillable = [
        'lead_id',
        'message',
    ];

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
}
