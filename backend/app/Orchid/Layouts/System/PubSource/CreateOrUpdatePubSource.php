<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\System\PubSource;

use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Field;

class CreateOrUpdatePubSource extends Rows
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
                ->title(__('platform.fuilds.title'))
                ->placeholder(__('platform.fuilds.title')),
        ];
    }
}
