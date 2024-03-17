<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Vacansy;

use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Field;

class UpdateVacansy extends Rows
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
                Quill::make('description')->id('update')->toolbar([
                    "text", "color", "header", "list", "format"
                ]),
            ]),

        ];
    }
}
