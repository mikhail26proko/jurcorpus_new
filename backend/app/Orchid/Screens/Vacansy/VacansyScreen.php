<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Vacansy;

use App\Orchid\Layouts\Vacansy\CreateOrUpdateVacansy;
use App\Http\Requests\Vacansy\OrchidVacansyRequest;
use App\Orchid\Layouts\Vacansy\CreateVacansy;
use App\Orchid\Layouts\Vacansy\UpdateVacansy;
use App\Orchid\Layouts\Vacansy\VacansyListLayout;
use Orchid\Screen\Actions\ModalToggle;
use App\Services\Vacansy\VacansyService;
use Illuminate\Http\RedirectResponse;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use App\Models\Vacansy;

class VacansyScreen extends Screen
{

    public function __construct(
        private VacansyService $vacansyService,
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
            'vacansy' => $this->vacansyService->index(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return __('platform.pages.menu.vacansies.index');
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return __('platform.pages.menu.vacansies.description');
    }

    public function permission(): ?iterable
    {
        return ['vacansies.*'];
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
    public function commandBar()
    {
        return [
            ModalToggle::make(__('Create'))
                ->canSee(auth()->user()->hasAnyAccess(['vacansies.full', 'vacansies.create']))
                ->method('createOrUpdateVacansy')
                ->modal('createVacansy')
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

                VacansyListLayout::class,

                Layout::blank([
                    Layout::modal('createVacansy', CreateVacansy::class)
                        ->canSee(auth()->user()->hasAnyAccess(['vacansies.full', 'vacansies.create']))
                        ->title(__('Create'))
                        ->applyButton(__('Create')),
                ]),

                Layout::modal('editVacansy', UpdateVacansy::class)
                    ->canSee(auth()->user()->hasAnyAccess(['vacansies.full', 'vacansies.edit']))
                    ->title(__('Update'))
                    ->applyButton(__('Save'))
                    ->async('asyncGetVacansy'),

            ])->canSee(auth()->user()->hasAnyAccess(['vacansies.full', 'vacansies.read'])),
        ];
    }

    /**
     * @return array
     */
    public function asyncGetVacansy(Vacansy $vacansy): array
    {
        $vacansies = $this->vacansyService->get($vacansy->id)->toArray();

        return $vacansies;
    }

    public function createOrUpdateVacansy(OrchidVacansyRequest $request): void
    {
        $validated = $request->validated();

        if (empty($validated['id'])) {
            $vacansy  = $this->vacansyService->create($validated);
            $message = 'WasCreated';
        } else {
            $vacansy  = $this->vacansyService->update($validated['id'], $validated);
            $message = 'WasUpdated';
        }

        Toast::success(__('platform.messages.' . $message));
    }

    public function delete(Vacansy $vacansy)
    {
        $this->vacansyService->delete($vacansy->id);

        Toast::error($vacansy->title . ' ' . __('platform.messages.WasDeleted'));
    }

}
