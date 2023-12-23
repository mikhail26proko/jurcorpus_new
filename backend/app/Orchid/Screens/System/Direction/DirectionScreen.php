<?php

declare(strict_types=1);

namespace App\Orchid\Screens\System\Direction;

use App\Orchid\Layouts\System\Direction\CreateOrUpdateDirection;
use App\Orchid\Layouts\System\Direction\DirectionListLayout;
use App\Http\Requests\Direction\OrchidDirectionRequest;
use App\Services\System\Direction\DirectionService;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use App\Models\Direction;

class DirectionScreen extends Screen
{

    public function __construct(
        private DirectionService $directionService,
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
            'direction' => $this->directionService->index(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return __('platform.pages.menu.system.directories.directions.index');
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return __('platform.pages.menu.system.directories.directions.description');
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
                        ->modal('createDirection')
                            ->method('createOrUpdateDirection'),
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
            DirectionListLayout::class,

            Layout::modal('createDirection', CreateOrUpdateDirection::class)
                ->title(__('Create'))
                    ->applyButton(__('Create')),

            Layout::modal('editDirection', CreateOrUpdateDirection::class)
                ->title(__('Update'))
                    ->applyButton(__('Save'))
                        ->async('asyncGetDirection'),
        ];
    }

    /**
     * @return array
     */
    public function asyncGetDirection(Direction $direction): array
    {
        return $direction->toArray();
    }

    public function createOrUpdateDirection(OrchidDirectionRequest $request): void
    {
        $validated = $request -> validated();

        if (empty($validated['id']))
        {
            $direction = $this->directionService->create($validated);
            $message = 'WasCreated';
        }
        else
        {
            $direction = $this->directionService->update($validated['id'], $validated);
            $message = 'WasUpdated';
        }

        Toast::success(__('platform.messages.'.$message));
    }

    public function delete(Direction $direction)
    {
        $this->directionService->delete($direction->id);

        Toast::error($direction->title . ' ' . __('platform.messages.WasDeleted'));
    }

}
