<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\UserLeads;

use App\Models\User;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Input;
use App\Enums\StatusEnum;
use Orchid\Screen\Field;
use App\Models\Branch;

class CreateOrUpdateUserLead extends Rows
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
                Relation::make('branch_id')
                    ->title(__('platform.fuilds.branch'))
                    ->clear()
                    ->fromModel(Branch::class, 'title'),
            ]),

            Group::make([
                Input::make('fio')
                    ->type('text')
                    ->max(255)
                    ->required()
                    ->title(__('platform.fuilds.full_name'))
                    ->placeholder(__('platform.fuilds.full_name')),
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

            Group::make([
                Relation::make('user_id')
                    ->title(__('platform.fuilds.user_id'))
                    ->clear()
                    ->fromModel(User::class, 'name')
            ]),

            Group::make([
                Select::make('status')
                    ->options([
                        ...StatusEnum::toArray()
                    ])
                    ->title('Статус'),
            ]),

            Group::make([
                TextArea::make('message')
                    ->title(__('platform.fuilds.message'))
                    ->placeholder(__('platform.fuilds.message'))
                    ->required()
                    ->rows(5),
            ]),
        ];
    }
}
