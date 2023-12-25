<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Branch;

use Orchid\Screen\Fields\Group;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Field;

class CreateOrUpdateBranch extends Rows
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
                Input::make('address')
                    ->type('text')
                    ->max(255)
                    ->required()
                    ->title(__('platform.fuilds.address'))
                    ->placeholder(__('platform.fuilds.address')),
            ]),

            Group::make([
                Input::make('phone')
                    ->mask(__('platform.masks.phone'))
                    // ->required()
                    ->title(__('platform.fuilds.phone'))
                    ->placeholder(__('platform.fuilds.phone')),

                Input::make('email')
                    ->type('email')
                    // ->required()
                    ->title(__('platform.fuilds.email'))
                    ->placeholder(__('platform.fuilds.email')),
            ]),

            Group::make([
                Input::make('latitude')
                    ->type('number')
                    ->title(__('Latitude'))
                    ->placeholder(__('Latitude')),

                Input::make('longitude')
                    ->type('number')
                    ->title(__('Longitude'))
                    ->placeholder(__('Longitude')),
            ]),
        ];
    }
}
