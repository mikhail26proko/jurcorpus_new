<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Publication;

use App\Orchid\Layouts\Publication\CreateOrUpdatePublication;
use App\Http\Requests\Publication\OrchidPublicationRequest;
use App\Orchid\Layouts\Publication\PublicationListLayout;
use App\Services\Publication\PublicationService;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use App\Models\Publication;

class PublicationScreen extends Screen
{

    public function __construct(
        private PublicationService $publicationService,
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
            'publication' => $this->publicationService->index(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return __('platform.pages.menu.publications.index');
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return __('platform.pages.menu.publications.description');
    }

    public function permission(): ?iterable
    {
        return ['publications.*',];
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar()
    {
        return [
            ModalToggle::make(__('Create'))
                ->canSee(auth()->user()->hasAnyAccess(['publications.full', 'publications.create']))
                ->method('createOrUpdatePublication')
                ->modal('createPublication')
                ->type(Color::DARK)
                ->icon('plus'),

            Button::make(__('platform.actions.download'))
                ->canSee(auth()->user()->hasAnyAccess(['publications.full', 'publications.upload']))
                ->method('downloadPublication')
                ->type(Color::DARK)
                ->icon('upload'),
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
                PublicationListLayout::class,

                Layout::modal('createPublication', CreateOrUpdatePublication::class)
                    ->canSee(auth()->user()->hasAnyAccess(['publications.full', 'publications.create']))
                    ->title(__('Create'))
                    ->applyButton(__('Create')),

                Layout::modal('editPublication', CreateOrUpdatePublication::class)
                    ->canSee(auth()->user()->hasAnyAccess(['publications.full', 'publications.edit']))
                    ->title(__('Update'))
                    ->applyButton(__('Save'))
                    ->async('asyncGetPublication'),
            ]),
        ];
    }

    public function asyncGetPublication(Publication $publication): array
    {
        $photo          = $publication->attachment()->first()['id'] ?? null;
        $publication    = ($this->publicationService->get($publication->id))->toArray();

        $pub_source = $publication['pub_source']['id'];
        $pub_type   = $publication['pub_type']['id'];

        $publication['pub_source']  = $pub_source;
        $publication['pub_type']    = $pub_type;
        $publication['photo']       = [$photo];

        return $publication;
    }

    public function createOrUpdatePublication(OrchidPublicationRequest $request): void
    {
        $validated = $request -> validated();

        if (empty($validated['id']))
        {
            $publication = $this->publicationService->create($validated);
            $message = 'WasCreated';
        }
        else
        {
            $publication = $this->publicationService->update($validated['id'], $validated);
            $message = 'WasUpdated';
        }

        Toast::success(__('platform.messages.'.$message));
    }

    public function downloadPublication(): void
    {
        Toast::error(__('platform.messages.UnImplemented'));
        // Toast::success(__('platform.messages.Success'));
    }

    public function delete(Publication $publication)
    {
        $this->publicationService->delete($publication->id);

        Toast::error($publication->title . ' ' . __('platform.messages.WasDeleted'));
    }

}
