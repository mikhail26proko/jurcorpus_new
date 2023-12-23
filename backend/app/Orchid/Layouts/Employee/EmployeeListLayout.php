<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Employee;

use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Layouts\Persona;
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

            TD::make('#')->width(60)
                ->render(function (Employee $employee, object $loop) {
                    return $loop->index + 1;
                }),

            TD::make('full_name', __('platform.fuilds.full_name'))
                ->sort()
                ->cantHide()
                ->render(fn (Employee $employee) => new Persona($employee->presenter())),

            TD::make('branch',__('platform.fuilds.branch'))
                ->render(function (Employee $employee) {
                    return
                        !empty($employee->branch)
                            ? $employee->branch->title
                            : __('platform.messages.UnsetedValue');
                }),

            TD::make('job_titles.', __('platform.fuilds.job_titles'))
                ->render(function (Employee $employee) {
                    if (!empty($employee->job_titles)){
                        return implode(', ',array_column($employee->job_titles->toArray(),'title'));
                    } else {
                        return __('platform.messages.UnsetedValue');
                    }
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
                                ->confirm(__('platform.messages.SureDelete'))
                                ->method('delete', [
                                    'employee' => $employee->id,
                                ]),
                        ]);
                }),
        ];
    }
}
