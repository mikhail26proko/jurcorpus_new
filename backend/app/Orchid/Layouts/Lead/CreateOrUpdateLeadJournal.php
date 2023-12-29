<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Lead;

use App\Enums\StatusEnum;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Field;

class CreateOrUpdateLeadJournal extends Rows
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
                TextArea::make('message')
                    ->type('text')
                    ->max(255)
                    ->required()
                    ->title(__('platform.fuilds.message'))
                    ->placeholder(__('platform.fuilds.message')),
            ]),
        ];
    }
}
