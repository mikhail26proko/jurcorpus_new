<?php

declare(strict_types=1);

namespace App\Orchid\Screens\System\PubType;

use App\Orchid\Layouts\System\PubType\CreateOrUpdatePubType;
use App\Orchid\Layouts\System\PubType\PubTypeListLayout;
use App\Http\Requests\PubType\OrchidPubTypeRequest;
use App\Services\System\PubType\PubTypeService;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use App\Models\PubType;

class PubTypeScreen extends Screen
{

    public function __construct(
        private PubTypeService $pubSourceService,
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
            'pub_type' => $this->pubSourceService->index(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return __('platform.pages.menu.system.directories.pub_types.index');
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return __('platform.pages.menu.system.directories.pub_types.description');
    }

    public function permission(): ?iterable
    {
        return ['system.directories.pub_types.*',];
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
                ->canSee(auth()->user()->hasAnyAccess(['system.directories.pub_types.full', 'system.directories.pub_types.create']))
                ->method('createOrUpdatePubType')
                ->modal('createPubType')
                ->type(Color::DARK)
                ->icon('plus')
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
                PubTypeListLayout::class,

                Layout::modal('createPubType', CreateOrUpdatePubType::class)
                    ->canSee(auth()->user()->hasAnyAccess(['system.directories.pub_types.full', 'system.directories.pub_types.create']))
                    ->title(__('Create'))
                    ->applyButton(__('Create')),

                Layout::modal('editPubType', CreateOrUpdatePubType::class)
                    ->canSee(auth()->user()->hasAnyAccess(['system.directories.pub_types.full', 'system.directories.pub_types.edit']))
                    ->title(__('Update'))
                    ->applyButton(__('Save'))
                    ->async('asyncGetPubType'),
            ])
        ];
    }

    /**
     * @return array
     */
    public function asyncGetPubType(PubType $pubSource): array
    {
        return $pubSource->toArray();
    }

    public function createOrUpdatePubType(OrchidPubTypeRequest $request): void
    {
        $validated = $request -> validated();

        if (empty($validated['id']))
        {
            $pubSource = $this->pubSourceService->create($validated);
            $message = 'WasCreated';
        }
        else
        {
            $pubSource = $this->pubSourceService->update($validated['id'], $validated);
            $message = 'WasUpdated';
        }

        Toast::success(__('platform.messages.'.$message));
    }

    public function delete(PubType $pubSource)
    {
        $this->pubSourceService->delete($pubSource->id);

        Toast::error($pubSource->title . ' ' . __('platform.messages.WasDeleted'));
    }

}
