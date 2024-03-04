<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Employee;

use App\Models\Direction;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Field;
use App\Models\JobTitle;
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
                DateTimer::make('birthday')
                    ->title(__('platform.fuilds.birthday'))
                    ->format(__('platform.masks.date'))
                    ->enableTime(false)
                    ->placeholder(__('platform.fuilds.birthday')),
            ]),

            Group::make([
                Relation::make('job_titles.')
                    ->title('platform.fuilds.job_titles')
                    ->multiple()
                    ->nullable(true)
                    ->allowAdd(true)
                    ->fromModel(JobTitle::class,'title'),
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
                Relation::make('branch_id')
                    ->title(__('platform.fuilds.branch'))
                    ->clear()
                    ->fromModel(Branch::class, 'title'),
            ]),

            Group::make([
                Relation::make('directions.')
                    ->title('platform.fuilds.directions')
                    ->multiple()
                    ->nullable(true)
                    ->allowAdd(true)
                    ->fromModel(Direction::class,'title'),
            ]),

            Group::make([
                TextArea::make('description')
                    ->title(__('platform.fuilds.description'))
                    ->rows(5),

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
