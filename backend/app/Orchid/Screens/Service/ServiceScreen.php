<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Service;

use App\Orchid\Layouts\Service\CreateOrUpdateService;
use App\Http\Requests\Service\OrchidServiceRequest;
use App\Orchid\Layouts\Service\ServiceListLayout;
use Orchid\Screen\Actions\ModalToggle;
use App\Services\Service\ServiceService;
use Illuminate\Http\RedirectResponse;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use App\Models\Service;

class ServiceScreen extends Screen
{

    public function __construct(
        private ServiceService $serviceService,
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
            'service' => $this->serviceService->index(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return __('platform.pages.menu.services.index');
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return __('platform.pages.menu.services.description');
    }

    public function permission(): ?iterable
    {
        return ['services.*'];
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
                ->canSee(auth()->user()->hasAnyAccess(['services.full', 'services.create']))
                ->method('createOrUpdateService')
                ->modal('createService')
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

                ServiceListLayout::class,

                Layout::modal('createService', CreateOrUpdateService::class)
                    ->canSee(auth()->user()->hasAnyAccess(['services.full', 'services.create']))
                    ->title(__('Create'))
                    ->applyButton(__('Create')),

                Layout::modal('editService', CreateOrUpdateService::class)
                    ->canSee(auth()->user()->hasAnyAccess(['services.full', 'services.edit']))
                    ->title(__('Update'))
                    ->applyButton(__('Save'))
                    ->async('asyncGetService'),

            ])->canSee(auth()->user()->hasAnyAccess(['services.full', 'services.read'])),
        ];
    }

    /**
     * @return array
     */
    public function asyncGetService(Service $service): array
    {
        $services = $this->serviceService->get($service->id)->toArray();

        return $services;
    }

    public function createOrUpdateService(OrchidServiceRequest $request): void
    {
        $validated = $request->validated();

        if (empty($validated['id'])) {
            $service  = $this->serviceService->create($validated);
            $message = 'WasCreated';
        } else {
            $service  = $this->serviceService->update($validated['id'], $validated);
            $message = 'WasUpdated';
        }

        Toast::success(__('platform.messages.' . $message));
    }

    public function delete(Service $service)
    {
        $this->serviceService->delete($service->id);

        Toast::error($service->title . ' ' . __('platform.messages.WasDeleted'));
    }

}
