<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Service;

use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Field;

class CreateOrUpdateService extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Input::make('id')
                ->type('hidden'),

            Group::make([
                Input::make('title')
                    ->type('text')
                    ->max(255)
                    ->required()
                    ->title(__('platform.fuilds.title'))
                    ->placeholder(__('platform.fuilds.title')),
            ]),

            Group::make([
                TextArea::make('content')
                    ->type('text')
                    ->row(5)
                    ->required()
                    ->title(__('platform.fuilds.description'))
                    ->placeholder(__('platform.fuilds.description')),
            ]),

            Group::make([
                Input::make('sort')
                    ->type('number')
                    ->title(__('platform.fuilds.sort'))
                    ->placeholder(__('platform.fuilds.sort'))
                    ->required()
                    ->min(1),
            ]),
        ];
    }
}
