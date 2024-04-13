<?php

declare(strict_types=1);

namespace App\Orchid\Components\Layouts;

use App\Orchid\Components\SimpleLayouts;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Input;

class EmployeMainInfoLayout extends SimpleLayouts
{
    public function layout()
    {
        return
            Layout::columns([
                Layout::rows([
                    Cropper::make('photo')
                        ->title(__('platform.fuilds.photo'))
                        ->acceptedFiles('.jpg,.jpeg,.png')
                        ->targetId()
                        ->width(300)
                        ->height(400)
                ]),
                Layout::rows([
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

                    DateTimer::make('birthday')
                        ->title(__('platform.fuilds.birthday'))
                        ->format(__('platform.masks.date'))
                        ->required(false)
                        ->allowEmpty()
                        ->allowInput()
                        ->enableTime(false)
                        ->placeholder(__('platform.fuilds.birthday'))
                ]),
        ]);
    }

}
