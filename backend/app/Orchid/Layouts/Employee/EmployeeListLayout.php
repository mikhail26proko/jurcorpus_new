<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Employee;

use App\Orchid\Extension\Fields\EmployeePresenterLayout;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Layouts\Table;
use App\Models\Employee;
use App\Models\Branch;
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

            TD::make('id', '#')->width(70)
                ->sort()
                ->render(function (Employee $employee, object $loop) {
                    return $loop->index + 1 + (((\request()->get('page')?? 1) - 1) * config('app.orchid_one_page'));
                }),

            TD::make('full_name', __('platform.fuilds.full_name'))
                ->filter(TD::FILTER_TEXT)
                ->sort()
                ->cantHide()
                ->render(fn (Employee $employee) => new EmployeePresenterLayout($employee->presenter())),

            TD::make('birthday', __('platform.fuilds.birthday'))
                ->sort()
                ->render(function (Employee $employee) {
                    return $employee->birthday ? $employee->birthday->format(__('platform.masks.date')) : '';
                })
                ->width(150)
                ->cantHide(),

            TD::make('branch_id',__('platform.fuilds.branch'))
                // TODO: Кешировать филиалы
                ->filter(TD::FILTER_SELECT, array_column(Branch::all()->toArray(),'title', 'id'))
                ->render(function (Employee $employee) {
                    return
                        !empty($employee->branch)
                            ? $employee->branch->title
                            : __('platform.messages.UnsetedValue');
                }),

            TD::make('job_titles.', __('platform.fuilds.job_titles'))
                ->defaultHidden()
                ->render(function (Employee $employee) {
                    if (!empty($employee->job_titles)){
                        return implode(', ', array_column($employee->job_titles->toArray(),'title'));
                    } else {
                        return __('platform.messages.UnsetedValue');
                    }
                }),

            TD::make(__('Actions'))->alignRight()
                ->render(function (Employee $employee) {
                    return DropDown::make()
                        ->icon('bs.three-dots-vertical')
                        ->class(empty($employee->deleted_at) ? 'btn btn-link' : 'btn btn-link link-danger')
                        ->list([
                            ModalToggle::make(__('Edit'))
                                ->icon('bs.pencil')
                                ->modal('editEmployee')
                                ->modalTitle(__('Edit') . ' ' . $employee->title)
                                ->method('createOrUpdateEmployee')
                                ->asyncParameters(['employee' => $employee->id]),

                            empty($employee->deleted_at) ?

                                Button::make(__('Delete'))
                                    ->icon('bs.trash3')
                                    ->confirm(__('platform.messages.SureDelete'))
                                    ->method('delete', [
                                        'employee' => $employee->id,
                                    ]) :
                                Button::make(__('platform.actions.restore'))
                                    ->icon('action-undo')
                                    ->confirm(__('platform.messages.SureRestore'))
                                    ->method('restore', [
                                        'employee' => $employee->id,
                                    ]),
                        ]);
                }),
        ];
    }
}
