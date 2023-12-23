<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Employee;

use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Field;
use App\Models\Branch;

class CreateOrUpdateEmployee extends Rows
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
                Input::make('last_name')
                    ->type('text')
                    ->max(255)
                    ->required()
                    ->title(__('platform.fuilds.last_name'))
                    ->placeholder(__('platform.fuilds.last_name')),

                Input::make('first_name')
                    ->type('text')
                    ->max(255)
                    ->required()
                    ->title(__('platform.fuilds.first_name'))
                    ->placeholder(__('platform.fuilds.first_name')),

                Input::make('sur_name')
                    ->type('text')
                    ->max(255)
                    ->required()
                    ->title(__('platform.fuilds.sur_name'))
                    ->placeholder(__('platform.fuilds.sur_name')),
            ]),

            Group::make([
                Input::make('email')
                    ->type('email')
                    // ->required()
                    ->title(__('platform.fuilds.email'))
                    ->placeholder(__('platform.fuilds.email')),

                Input::make('phone')
                    ->mask(__('platform.masks.phone'))
                    // ->required()
                    ->title(__('platform.fuilds.phone'))
                    ->placeholder(__('platform.fuilds.phone')),
            ]),

            Relation::make('branch_id')
                ->title(__('platform.fuilds.branch'))
                ->allowAdd(true)
                ->fromModel(Branch::class, 'title'),

        ];
    }
}
