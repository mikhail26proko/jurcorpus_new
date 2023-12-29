<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Platform\Concerns\Sortable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;


class ExtendModel extends Model
{
    use HasFactory,
        AsSource,
        Sortable,
        Filterable;

    protected static function booted()
    {
        static::created(function(Model $entity){
            if (auth()->id()){
                SystemLog::create([
                    'type'      => 'created',
                    'entity'    => $entity::class,
                    'data'      => $entity->toJson(JSON_UNESCAPED_UNICODE),
                ]);
            }
        });

        static::updated(function(Model $entity){
            if (auth()->id()){
                SystemLog::create([
                    'type'      => 'updated',
                    'entity'    => $entity::class,
                    'data'      => $entity->toJson(JSON_UNESCAPED_UNICODE),
                ]);
            }
        });
    }
}
