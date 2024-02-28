<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\System\Direction;

use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Layouts\Table;
use App\Models\Direction;
use Orchid\Screen\TD;

class DirectionListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'direction';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            // TD::make('id', __('Id'))
            //     ->sort(),

            TD::make('#')->width(60)
                ->render(function (Direction $direction, object $loop) {
                    return $loop->index + 1 + (((\request()->get('page')?? 1) - 1) * config('app.orchid_one_page'));
                }),

            TD::make('title', __('platform.fuilds.title'))
                ->sort(),

            TD::make(__('Actions'))->alignRight()
                ->render(function (Direction $direction) {
                    return DropDown::make()
                        ->icon('bs.three-dots-vertical')
                        ->list([
                            ModalToggle::make(__('Edit'))
                                ->icon('bs.pencil')
                                ->modal('editDirection')
                                ->modalTitle(__('Edit'). ' ' . $direction->title)
                                ->method('createOrUpdateDirection')
                                ->asyncParameters(['direction' => $direction->id]),

                            Button::make(__('Delete'))
                                ->icon('bs.trash3')
                                ->confirm(__('platform.messages.SureDelete'))
                                ->method('delete', [
                                    'direction' => $direction->id,
                                ]),
                        ]);
                }),
        ];
    }
}
