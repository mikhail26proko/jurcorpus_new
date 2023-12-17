<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Branch;

use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use App\Models\Branch;

class BranchListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'branch';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            // TD::make('id', __('Id'))
            //     ->sort(),

            TD::make()->render(function (Branch $branch, object $loop) {
                return $loop->index + 1;
            }),

            TD::make('title', __('Title'))
                ->sort(),

            TD::make('email', __('Email'))
                ->sort()
                ->cantHide(),

            TD::make('employee_count', __('employee_count'))->render(fn(Branch $branch)=>($branch->employees_count)),

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
                ->render(function (Branch $branch) {
                    return DropDown::make()
                        ->icon('bs.three-dots-vertical')
                        ->list([
                            ModalToggle::make(__('Edit'))
                                ->icon('bs.pencil')
                                ->modal('editBranch')
                                ->modalTitle(__('Edit'). ' ' . $branch->title)
                                ->method('createOrUpdateBranch')
                                ->asyncParameters(['branch' => $branch->id]),

                            Button::make(__('Delete'))
                                ->icon('bs.trash3')
                                ->confirm(__('AreYouSureDelete?'))
                                ->method('delete', [
                                    'branch' => $branch->id,
                                ]),
                        ]);
                }),
        ];
    }
}
