<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Branch;

use App\Orchid\Layouts\Branch\CreateOrUpdateBranch;
use App\Http\Requests\Branch\OrchidBranchRequest;
use App\Orchid\Layouts\Branch\BranchListLayout;
use Orchid\Screen\Actions\ModalToggle;
use App\Services\Branch\BranchService;
use Illuminate\Http\RedirectResponse;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use App\Models\Branch;

class BranchScreen extends Screen
{

    public function __construct(
        private BranchService $branchService,
    ) {
    }

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'branch' => $this->branchService->index(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return __('platform.pages.menu.branches.index');
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return __('platform.pages.menu.branches.description');
    }

    public function permission(): ?iterable
    {
        return ['branches.*'];
    }

    public static function unaccessed(): RedirectResponse
    {
        return redirect('/');
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
                ->canSee(auth()->user()->hasAnyAccess(['branches.full', 'branches.create']))
                ->method('createOrUpdateBranch')
                ->modal('createBranch')
                ->type(Color::DARK)
                ->icon('plus'),
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
            Layout::blank([

                BranchListLayout::class,

                Layout::modal('createBranch', CreateOrUpdateBranch::class)
                    ->canSee(auth()->user()->hasAnyAccess(['branches.full', 'branches.create']))
                    ->title(__('Create'))
                    ->applyButton(__('Create')),

                Layout::modal('editBranch', CreateOrUpdateBranch::class)
                    ->canSee(auth()->user()->hasAnyAccess(['branches.full', 'branches.edit']))
                    ->title(__('Update'))
                    ->applyButton(__('Save'))
                    ->async('asyncGetBranch'),

            ])->canSee(auth()->user()->hasAnyAccess(['branches.full', 'branches.read'])),
        ];
    }

    /**
     * @return array
     */
    public function asyncGetBranch(Branch $branch): array
    {
        $branches = $this->branchService->get($branch->id)->toArray();

        $employees = array_column($branches['employees'],'id');
        $branches['employees'] = $employees;

        return $branches;
    }

    public function createOrUpdateBranch(OrchidBranchRequest $request): void
    {
        $validated = $request->validated();

        if (empty($validated['id'])) {
            $branch  = $this->branchService->create($validated);
            $message = 'WasCreated';
        } else {
            $branch  = $this->branchService->update($validated['id'], $validated);
            $message = 'WasUpdated';
        }

        Toast::success(__('platform.messages.' . $message));
    }

    public function delete(Branch $branch)
    {
        $this->branchService->delete($branch->id);

        Toast::error($branch->title . ' ' . __('platform.messages.WasDeleted'));
    }

}
