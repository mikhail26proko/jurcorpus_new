<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Employee;

use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Layouts\Table;
use App\Models\Employee;
use Orchid\Screen\TD;

class EmployeeListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'employee';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            // TD::make('id', __('Id'))
            //     ->sort(),

            TD::make()->render(function (Employee $employee, object $loop) {
                return $loop->index + 1;
            }),

            TD::make('full_name', __('platform.fuilds.full_name'))
                ->sort(),

            TD::make('branch',__('platform.fuilds.branch'))
                ->render(function (Employee $employee) {
                    return
                        !empty($employee->branch)
                            ? $employee->branch->title
                            : 'без филиала';
            }),

            TD::make(__('Actions'))->alignRight()
                ->render(function (Employee $employee) {
                    return DropDown::make()
                        ->icon('bs.three-dots-vertical')
                        ->list([
                            ModalToggle::make(__('Edit'))
                                ->icon('bs.pencil')
                                ->modal('editEmployee')
                                ->modalTitle(__('Edit'). ' ' . $employee->title)
                                ->method('createOrUpdateEmployee')
                                ->asyncParameters(['employee' => $employee->id]),

                            Button::make(__('Delete'))
                                ->icon('bs.trash3')
                                ->confirm(__('SureDelete'))
                                ->method('delete', [
                                    'employee' => $employee->id,
                                ]),
                        ]);
                }),
        ];
    }
}
