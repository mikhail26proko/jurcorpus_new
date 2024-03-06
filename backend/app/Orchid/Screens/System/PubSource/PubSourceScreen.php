<?php

declare(strict_types=1);

namespace App\Orchid\Screens\System\PubSource;

use App\Orchid\Layouts\System\PubSource\CreateOrUpdatePubSource;
use App\Orchid\Layouts\System\PubSource\PubSourceListLayout;
use App\Http\Requests\PubSource\OrchidPubSourceRequest;
use App\Services\System\PubSource\PubSourceService;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use App\Models\PubSource;

class PubSourceScreen extends Screen
{

    public function __construct(
        private PubSourceService $pubSourceService,
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
            'pub_source' => $this->pubSourceService->index(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return __('platform.pages.menu.system.directories.pub_sources.index');
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return __('platform.pages.menu.system.directories.pub_sources.description');
    }

    public function permission(): ?iterable
    {
        return ['system.directories.pub_sources.*',];
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
                ->canSee(auth()->user()->hasAnyAccess(['system.directories.pub_sources.full', 'system.directories.pub_sources.create']))
                ->method('createOrUpdatePubSource')
                ->modal('createPubSource')
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
                PubSourceListLayout::class,

                Layout::modal('createPubSource', CreateOrUpdatePubSource::class)
                    ->canSee(auth()->user()->hasAnyAccess(['system.directories.pub_sources.full', 'system.directories.pub_sources.create']))
                    ->title(__('Create'))
                    ->applyButton(__('Create')),

                Layout::modal('editPubSource', CreateOrUpdatePubSource::class)
                    ->canSee(auth()->user()->hasAnyAccess(['system.directories.pub_sources.full', 'system.directories.pub_sources.edit']))
                    ->title(__('Update'))
                    ->applyButton(__('Save'))
                    ->async('asyncGetPubSource'),
            ])
        ];
    }

    /**
     * @return array
     */
    public function asyncGetPubSource(PubSource $pubSource): array
    {
        return $pubSource->toArray();
    }

    public function createOrUpdatePubSource(OrchidPubSourceRequest $request): void
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

    public function delete(PubSource $pubSource)
    {
        $this->pubSourceService->delete($pubSource->id);

        Toast::error($pubSource->title . ' ' . __('platform.messages.WasDeleted'));
    }

}
