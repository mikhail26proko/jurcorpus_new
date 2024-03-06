<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Publication;

use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Input;
use App\Models\PubSource;
use App\Models\Employee;
use App\Models\PubType;
use Orchid\Screen\Field;

class CreateOrUpdatePublication extends Rows
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
                Relation::make('pub_source')
                    ->required()
                    ->title('platform.fuilds.pub_source')
                    ->allowAdd(true)
                    ->fromModel(PubSource::class,'title'),
            ]),

            Group::make([
                Relation::make('pub_type')
                    ->required()
                    ->title('platform.fuilds.pub_type')
                    ->allowAdd(true)
                    ->fromModel(PubType::class,'title'),
            ]),

            Group::make([
                Relation::make('employee_id')
                    ->title('platform.fuilds.employee')
                    ->clear()
                    ->fromModel(Employee::class, 'last_name')
                    ->searchColumns('first_name','sur_name')
                    ->displayAppend('full_name'),
                ]),

            Group::make([
                Input::make('title')
                    ->type('text')
                    ->max(255)
                    ->required()
                    ->title(__('platform.fuilds.pub_title'))
                    ->placeholder(__('platform.fuilds.pub_title')),
            ]),

            Group::make([
                Input::make('sub_title')
                    ->type('text')
                    ->max(255)
                    ->required()
                    ->title(__('platform.fuilds.sub_title'))
                    ->placeholder(__('platform.fuilds.sub_title')),
            ]),

            Group::make([
                DateTimer::make('publicated_at')
                    ->title(__('platform.fuilds.publicated_at'))
                    ->format(__('platform.masks.date'))
                    ->enableTime(false)
                    ->placeholder(__('platform.fuilds.publicated_at')),
            ]),

            Group::make([
                Input::make('link')
                    ->title(__('platform.fuilds.link'))
                    ->placeholder(__('platform.fuilds.link')),

            ]),

            Group::make([
                Cropper::make('photo')
                    ->title(__('platform.fuilds.photo'))
                    ->acceptedFiles('.jpg,.jpeg,.png')
                    ->targetId()
                    ->width(300)
                    ->height(400)
            ]),
        ];
    }
}
