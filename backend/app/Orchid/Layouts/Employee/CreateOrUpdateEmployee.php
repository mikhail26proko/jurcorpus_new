<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Employee;

use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Input;
use App\Models\Direction;
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
                DateTimer::make('practiceStartDate')
                    ->title(__('platform.fuilds.practiceStartDate'))
                    ->format(__('platform.masks.date'))
                    ->required(false)
                    ->allowEmpty()
                    ->allowInput()
                    ->enableTime(false)
                    ->placeholder(__('platform.fuilds.practiceStartDate')),
            ]),

            Group::make([
                Relation::make('job_titles.')
                    ->title('platform.fuilds.job_titles')
                    ->multiple()
                    ->nullable(true)
                    ->allowAdd(true)
                    ->fromModel(JobTitle::class,'title','id'),
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
                    ->fromModel(Direction::class,'title','id'),
            ]),

            Group::make([
                TextArea::make('description')
                    ->title(__('platform.fuilds.description'))
                    ->rows(5),

            ]),
        ];
    }
}
