<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Employee;

use App\Orchid\Layouts\Employee\CreateOrUpdateEmployee;
use App\Http\Requests\Employee\OrchidEmployeeRequest;
use App\Orchid\Layouts\Employee\EmployeeListLayout;
use App\Services\Employee\EmployeeService;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use App\Models\Employee;
use Carbon\Carbon;

class EmployeeScreen extends Screen
{

    public function __construct(
        private EmployeeService $employeeService,
    )
    {}

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'employee' => $this->employeeService->index(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return __('platform.pages.menu.employees.index');
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return __('platform.pages.menu.employees.description');
    }

    public function permission(): ?iterable
    {
        return [
            'platform.employees',
        ];
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            ModalToggle::make(__('Create'))
                ->type(Color::DARK)
                    ->icon('plus')
                        ->modal('createEmployee')
                            ->method('createOrUpdateEmployee'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return string[]|\Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [
            EmployeeListLayout::class,

            Layout::modal('createEmployee', CreateOrUpdateEmployee::class)
                ->title(__('Create'))
                    ->applyButton(__('Create')),

            Layout::modal('editEmployee', CreateOrUpdateEmployee::class)
                ->title(__('Update'))
                    ->applyButton(__('Save'))
                        ->async('asyncGetEmployee'),
        ];
    }

    public function asyncGetEmployee(Employee $employee): array
    {
        $employee = ($this->employeeService->get($employee->id))->toArray();

        $job_titles = array_column($employee['job_titles'],'id');
        $employee['job_titles'] = $job_titles;

        return $employee;
    }

    public function createOrUpdateEmployee(OrchidEmployeeRequest $request): void
    {
        $validated = $request -> validated();

        if (empty($validated['id']))
        {
            $employee = $this->employeeService->create($validated);
            $message = 'WasCreated';
        }
        else
        {
            $employee = $this->employeeService->update($validated['id'], $validated);
            $message = 'WasUpdated';
        }

        $employee->job_titles()->sync($validated['job_titles']);
        $employee->attachment()->sync($validated['photo']);

        Toast::success(__('platform.messages.'.$message));
    }

    public function delete(Employee $employee)
    {
        $this->employeeService->delete($employee->id);

        Toast::error($employee->title . ' ' . __('platform.messages.WasDeleted'));
    }

}
