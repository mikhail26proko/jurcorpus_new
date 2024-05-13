<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Service;

use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Sight;
use App\Models\Service;

class ServiceListSight extends Sight
{
    /**
     * @var string
     */
    public $target = 'service';

    /**
     * @return Sight[]
     */
    public static function columns(): array
    {
        return [

            // Sight::make('sort'),

            Sight::make('title', __('platform.fuilds.title')),

            Sight::make(__('Actions'))
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
