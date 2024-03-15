<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Vacansy;

use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Layouts\Table;
use App\Models\Vacansy;
use Orchid\Screen\TD;

class VacansyListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'vacansy';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            // TD::make('id', __('Id'))
            //     ->sort(),

            TD::make('#')->width(60)
                ->render(function (Vacansy $vacansy, object $loop) {
                    return $loop->index + 1 + (((\request()->get('page')?? 1) - 1) * config('app.orchid_one_page'));
                }),

            TD::make('title', __('platform.fuilds.title'))
                ->sort(),

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
                ->render(function (Vacansy $vacansy) {
                    return DropDown::make()
                        ->icon('bs.three-dots-vertical')
                        ->list([
                            ModalToggle::make(__('Edit'))
                                ->icon('bs.pencil')
                                ->modal('editVacansy')
                                ->modalTitle(__('Edit'). ' ' . $vacansy->title)
                                ->method('createOrUpdateVacansy')
                                ->asyncParameters(['vacansy' => $vacansy->id]),

                            Button::make(__('Delete'))
                                ->icon('bs.trash3')
                                ->confirm(__('platform.messages.SureDelete'))
                                ->method('delete', [
                                    'vacansy' => $vacansy->id,
                                ]),
                        ]);
                }),
        ];
    }
}
