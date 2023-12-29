<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\System\SystemLog;

use App\Orchid\Components\DateTime;
use Orchid\Screen\Layouts\Persona;
use Orchid\Screen\Layouts\Table;
use App\Models\SystemLog;
use Orchid\Screen\TD;

class SystemLogListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'system_log';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('id','#')->width(60)->defaultHidden(),

            TD::make('created_at', __('platform.fuilds.system_log.created_at'))->usingComponent(DateTime::class),

            TD::make('user',__('platform.fuilds.system_log.user'))
                ->render(fn(SystemLog $system_log) => new Persona($system_log->user->presenter())),

            TD::make('type', __('platform.fuilds.system_log.type'))
                ->filter(),

            TD::make('entity', __('platform.fuilds.system_log.entity'))
                ->render(fn(SystemLog $system_log)=>__('platform.entityes.'.$system_log->entity))
                ->filter(),

            TD::make('data', __('platform.fuilds.system_log.data')),
        ];
    }
}
