<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Lead;

use App\Orchid\Layouts\Lead\CreateOrUpdateLeadJournal;
use App\Http\Requests\Lead\OrchidLeadJournalRequest;
use App\Orchid\Layouts\Lead\CreateOrUpdateLead;
use App\Http\Requests\Lead\OrchidLeadRequest;
use App\Orchid\Layouts\Lead\LeadListLayout;
use App\Services\Lead\JournalService;
use Orchid\Screen\Actions\ModalToggle;
use App\Orchid\Components\DateTime;
use Orchid\Support\Facades\Layout;
use App\Services\Lead\LeadService;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Screen\Sight;
use App\Models\Journal;
use App\Models\Lead;

class LeadScreen extends Screen
{

    public function __construct(
        private LeadService $leadService,
        private JournalService $journalService,
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
            __('platform.tabs.all').'_lead' => $this->leadService->index(['status'=>['Все']]),
            __('platform.tabs.new').'_lead' => $this->leadService->index(['status' => ['Новая']]),
            __('platform.tabs.process').'_lead' => $this->leadService->index(['status' => ['В процессе']]),
            __('platform.tabs.processed').'_lead' => $this->leadService->index(['status' => ['Обработана']]),
            __('platform.tabs.done').'_lead' => $this->leadService->index(['status' => ['Готово']]),
            __('platform.tabs.refuse').'_lead' => $this->leadService->index(['status' => ['Отказ']]),
            __('platform.tabs.draft').'_lead' => $this->leadService->index(['status' => ['Черновик']]),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return __('platform.pages.menu.crm.leads.index');
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return __('platform.pages.menu.crm.leads.description');
    }

    public function permission(): ?iterable
    {
        return [
            'platform.crm.leads',
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
                        ->modal('createLead')
                            ->method('createOrUpdateLead'),
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
            Layout::tabs([
                __('platform.tabs.all')         => new LeadListLayout(__('platform.tabs.all').'_lead'),
                __('platform.tabs.new')         => new LeadListLayout(__('platform.tabs.new').'_lead'),
                __('platform.tabs.process')     => new LeadListLayout(__('platform.tabs.process').'_lead'),
                __('platform.tabs.processed')   => new LeadListLayout(__('platform.tabs.processed').'_lead'),
                __('platform.tabs.done')        => new LeadListLayout(__('platform.tabs.done').'_lead'),
                __('platform.tabs.refuse')      => new LeadListLayout(__('platform.tabs.refuse').'_lead'),
                __('platform.tabs.draft')       => new LeadListLayout(__('platform.tabs.draft').'_lead'),
            ])
            ->activeTab(__('platform.tabs.new')),

            Layout::blank([
                Layout::modal('createLead', CreateOrUpdateLead::class)
                    ->title(__('Create'))
                        ->applyButton(__('Create')),

                Layout::modal('asyncEditLead', CreateOrUpdateLead::class)
                    ->title(__('Update'))
                        ->applyButton(__('Save'))
                            ->async('asyncGetLead'),
            ]),

            Layout::blank([
                Layout::modal('asyncOpenLead', Layout::legend('', [
                    Sight::make('created_at', __('platform.fuilds.created_at'))
                        ->usingComponent(DateTime::class,'d.m.Y H:i'),
                    Sight::make('fio', __('platform.fuilds.full_name')),
                    Sight::make('email', __('platform.fuilds.email')),
                    Sight::make('phone', __('platform.fuilds.phone')),
                    Sight::make('message', __('platform.fuilds.message')),
                    Sight::make('journals.',__('platform.fuilds.journals'))
                        ->render(function($lead){
                            $html = '<div class="rounded bg-light mb-3 p-3">';
                            $journals = (array) $lead['journals'];
                            foreach ($journals as $journal) {
                                $html .= '<div class="d-flex mb-3">';
                                $html .= '<div class="rounded bg-danger p-3">';
                                $html .= '<span class="text-decoration-underline">'.(new DateTime($journal['created_at']))->render().' : </span>';
                                $html .= '<br>';
                                $html .= '<span>'.$journal['message'].'</span>';
                                $html .= '</div>';
                                $html .= '<div class="">'.
                                    Button::make(__('Delete'))
                                        ->confirm(__('platform.messages.SureDelete'))
                                            ->method('deleteJournal', [
                                                'lead' => $lead['id'],
                                            ])
                                                ->icon('cross')
                                                    ->toHtml()
                                .'</div>
                                </div>';
                            }
                            $html .='</div>'.
                            ModalToggle::make(__('Add').' '.__('platform.fuilds.journal'))
                                ->type(Color::DARK)
                                    ->icon('plus')
                                        ->modal('CreateLeadJournal')
                                            ->method('CreateOrUpdateLeadJournal',['lead_id' => $lead['id']])
                                                ->toHtml();
                            return $html;
                        },
                    ),
                ]))
                    ->async('asyncGetLead')
                    ->withoutApplyButton(true)
                    ->withoutCloseButton(true),

                Layout::modal('CreateLeadJournal', CreateOrUpdateLeadJournal::class)
                    ->title(__('platform.fuilds.journal'))
            ]),
        ];
    }

    public function asyncGetLead(Lead $lead): array
    {
       return $this->leadService->get($lead->id)->toArray();
    }

    public function createOrUpdateLead(OrchidLeadRequest $request): void
    {
        $validated = $request -> validated();

        if (empty($validated['id']))
        {
            $lead = $this->leadService->create($validated);
            $message = 'WasCreated';
        }
        else
        {
            $lead = $this->leadService->update($validated['id'], $validated);
            $message = 'WasUpdated';
        }

        Toast::success(__('platform.messages.'.$message));
    }

    public function CreateOrUpdateLeadJournal(OrchidLeadJournalRequest $request): void
    {
        $validated = $request -> validated();

        if (empty($validated['id']))
        {
            $journal = $this->journalService->create($validated);
            $message = 'WasAdded';
        }
        else
        {
            $journal = $this->journalService->update($validated['id'], $validated);
            $message = 'WasUpdated';
        }

        Toast::success(__('platform.messages.'.$message));
    }

    public function delete(Lead $lead): void
    {
        $this->leadService->delete($lead->id);

        Toast::error($lead->title . ' ' . __('platform.messages.WasDeleted'));
    }

    public function deleteJournal(Journal $journal): void
    {
        $this->journalService->delete($journal->id);

        Toast::error(__('platform.messages.WasDeleted'));
    }

}
