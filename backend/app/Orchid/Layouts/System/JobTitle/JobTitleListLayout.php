<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\System\JobTitle;

use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Layouts\Table;
use App\Models\JobTitle;
use Orchid\Screen\TD;

class JobTitleListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'job_title';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            // TD::make('id', __('Id'))
            //     ->sort(),

            TD::make('#')->width(60)
                ->render(function (JobTitle $jobTitle, object $loop) {
                    return $loop->index + 1;
                }),

            TD::make('title', __('platform.fuilds.title'))
                ->sort(),

            TD::make(__('Actions'))->alignRight()
                ->render(function (JobTitle $jobTitle) {
                    return DropDown::make()
                        ->icon('bs.three-dots-vertical')
                        ->list([
                            ModalToggle::make(__('Edit'))
                                ->icon('bs.pencil')
                                ->modal('editJobTitle')
                                ->modalTitle(__('Edit'). ' ' . $jobTitle->title)
                                ->method('createOrUpdateJobTitle')
                                ->asyncParameters(['jobTitle' => $jobTitle->id]),

                            Button::make(__('Delete'))
                                ->icon('bs.trash3')
                                ->confirm(__('platform.messages.SureDelete'))
                                ->method('delete', [
                                    'jobTitle' => $jobTitle->id,
                                ]),
                        ]);
                }),
        ];
    }
}
