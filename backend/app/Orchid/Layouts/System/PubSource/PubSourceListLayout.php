<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\System\PubSource;

use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Layouts\Table;
use App\Models\PubSource;
use Orchid\Screen\TD;

class PubSourceListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'pub_source';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            // TD::make('id', __('Id'))
            //     ->sort(),

            TD::make('#')->width(60)
                ->render(function (PubSource $pubSource, object $loop) {
                    return $loop->index + 1 + (((\request()->get('page')?? 1) - 1) * config('app.orchid_one_page'));
                }),

            TD::make('title', __('platform.fuilds.title'))
                ->sort(),

            TD::make(__('Actions'))->alignRight()
                ->render(function (PubSource $pubSource) {
                    return DropDown::make()
                        ->icon('bs.three-dots-vertical')
                        ->list([
                            ModalToggle::make(__('Edit'))
                                ->icon('bs.pencil')
                                ->modal('editPubSource')
                                ->modalTitle(__('Edit'). ' ' . $pubSource->title)
                                ->method('createOrUpdatePubSource')
                                ->asyncParameters(['pubSource' => $pubSource->id]),

                            Button::make(__('Delete'))
                                ->icon('bs.trash3')
                                ->confirm(__('platform.messages.SureDelete'))
                                ->method('delete', [
                                    'pubSource' => $pubSource->id,
                                ]),
                        ]);
                }),
        ];
    }
}
