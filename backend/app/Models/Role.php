<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Orchid\Platform\Models\Role as OrchidRole;

class Role extends OrchidRole
{
    protected static function booted()
    {
        static::created(function(Role $role){
            if (auth()->id()){
                SystemLog::create([
                    'type'      => 'created',
                    'entity'    => Role::class,
                    'data'      => $role->toJson(JSON_UNESCAPED_UNICODE),
                ]);
            }
        });

        static::updated(function(Role $role){
            if (auth()->id()){
                SystemLog::create([
                    'type'      => 'updated',
                    'entity'    => Role::class,
                    'data'      => $role->toJson(JSON_UNESCAPED_UNICODE),
                ]);
            }
        });
    }
}
