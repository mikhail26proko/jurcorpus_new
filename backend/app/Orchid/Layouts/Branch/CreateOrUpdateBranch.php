<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Branch;

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

            Input::make('title')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Title'))
                ->placeholder(__('Title')),

            Input::make('address')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Address'))
                ->placeholder(__('Address')),

            Input::make('phone')
                ->mask('(999) 999-9999')
                // ->required()
                ->title(__('Phone'))
                ->placeholder(__('Phone')),

            Input::make('email')
                ->type('email')
                // ->required()
                ->title(__('Email'))
                ->placeholder(__('Email')),

            Input::make('latitude')
                ->type('number')
                ->title(__('Latitude'))
                ->placeholder(__('Latitude')),

            Input::make('longitude')
                ->type('number')
                ->title(__('Longitude'))
                ->placeholder(__('Longitude')),
        ];
    }
}
