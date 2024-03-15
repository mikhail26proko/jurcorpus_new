<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Service;

use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use App\Models\Service;

class ServiceListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'service';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [

            TD::make('#')->width(60)
                ->render(function (Service $service, object $loop) {
                    return $loop->index + 1 + (((\request()->get('page')?? 1) - 1) * config('app.orchid_one_page'));
                }),

            TD::make('title', __('platform.fuilds.title'))
                ->sort(),

            TD::make('sort', __('platform.fuilds.sort')),

            TD::make('created_at', __('created_at'))
                ->asComponent(
                    DateTimeSplit::class, [
                        'upperFormat' => 'M j, Y',
                        'lowerFormat' => 'D, H:i',
                    ])
                ->align(TD::ALIGN_RIGHT)
                ->defaultHidden()
                ->sort(),

            TD::make('updated_at', __('updated_at'))
                ->asComponent(DateTimeSplit::class, [
                        'upperFormat' => 'M j, Y',
                        'lowerFormat' => 'D, H:i',
                    ])
                ->align(TD::ALIGN_RIGHT)
                ->defaultHidden()
                ->sort(),

            TD::make(__('Actions'))->alignRight()
                ->render(function (Service $service) {
                    return DropDown::make()
                        ->icon('bs.three-dots-vertical')
                        ->list([
                            ModalToggle::make(__('Edit'))
                                ->icon('bs.pencil')
                                ->modal('editService')
                                ->modalTitle(__('Edit'). ' ' . $service->title)
                                ->method('createOrUpdateService')
                                ->asyncParameters(['service' => $service->id]),

                            Button::make(__('Delete'))
                                ->icon('bs.trash3')
                                ->confirm(__('platform.messages.SureDelete'))
                                ->method('delete', [
                                    'service' => $service->id,
                                ]),
                        ]);
                }),
        ];
    }
}
