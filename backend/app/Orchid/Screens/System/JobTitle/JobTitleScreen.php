<?php

declare(strict_types=1);

namespace App\Orchid\Screens\System\JobTitle;

use App\Orchid\Layouts\System\JobTitle\CreateOrUpdateJobTitle;
use App\Orchid\Layouts\System\JobTitle\JobTitleListLayout;
use App\Http\Requests\JobTitle\OrchidJobTitleRequest;
use App\Services\System\JobTitle\JobTitleService;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use App\Models\JobTitle;

class JobTitleScreen extends Screen
{

    public function __construct(
        private JobTitleService $jobTitleService,
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
            'job_title' => $this->jobTitleService->index(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return __('platform.pages.menu.system.directories.job_titles.index');
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return __('platform.pages.menu.system.directories.job_titles.description');
    }

    public function permission(): ?iterable
    {
        return [
            'platform.systems.directories',
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
                        ->modal('createJobTitle')
                            ->method('createOrUpdateJobTitle'),
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
            JobTitleListLayout::class,

            Layout::modal('createJobTitle', CreateOrUpdateJobTitle::class)
                ->title(__('Create'))
                    ->applyButton(__('Create')),

            Layout::modal('editJobTitle', CreateOrUpdateJobTitle::class)
                ->title(__('Update'))
                    ->applyButton(__('Save'))
                        ->async('asyncGetJobTitle'),
        ];
    }

    /**
     * @return array
     */
    public function asyncGetJobTitle(JobTitle $jobTitle): array
    {
        return $jobTitle->toArray();
    }

    public function createOrUpdateJobTitle(OrchidJobTitleRequest $request): void
    {
        $validated = $request -> validated();

        if (empty($validated['id']))
        {
            $jobTitle = $this->jobTitleService->create($validated);
            $message = 'WasCreated';
        }
        else
        {
            $jobTitle = $this->jobTitleService->update($validated['id'], $validated);
            $message = 'WasUpdated';
        }

        Toast::success(__('platform.messages.'.$message));
    }

    public function delete(JobTitle $jobTitle)
    {
        $this->jobTitleService->delete($jobTitle->id);

        Toast::error($jobTitle->title . ' ' . __('platform.messages.WasDeleted'));
    }

}
