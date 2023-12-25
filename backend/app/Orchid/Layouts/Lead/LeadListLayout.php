<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Lead;

use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Layouts\Table;
use App\Models\Lead;
use Orchid\Screen\TD;

class LeadListLayout extends Table
{
    // /**
    //  * @var string
    //  */
    public $target = 'lead';
    // public string $target = '';

    public function __construct(string $target){
        $this->target = $target;
    }

    /**
     * @return TD[]
     */
    public function columns(): array
    {

        return [
            // TD::make('id', __('Id'))
            //     ->sort(),

            TD::make('#')->width(60)
                ->render(function (Lead $lead, object $loop) {
                    return $loop->index + 1;
                }),

            TD::make('fio', __('platform.fuilds.full_name'))
                ->sort(),

            TD::make('email', __('platform.fuilds.email'))
                ->sort(),

            TD::make('phone', __('platform.fuilds.phone'))
                ->sort(),

            TD::make('message', __('platform.fuilds.message'))
                ->sort(),

            TD::make(__('Actions'))->alignRight()
                ->render(function (Lead $lead) {
                    return DropDown::make()
                        ->icon('bs.three-dots-vertical')
                        ->list([
                            ModalToggle::make(__('Edit'))
                                ->icon('bs.pencil')
                                ->modal('editLead')
                                ->modalTitle(__('Edit'). ' ' . $lead->title)
                                ->method('createOrUpdateLead')
                                ->asyncParameters(['lead' => $lead->id]),

                            Button::make(__('Delete'))
                                ->icon('bs.trash3')
                                ->confirm(__('platform.messages.SureDelete'))
                                ->method('delete', [
                                    'lead' => $lead->id,
                                ]),
                        ]);
                }),
        ];
    }
}
