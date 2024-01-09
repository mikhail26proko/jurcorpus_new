<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Lead;

use App\Orchid\Layouts\UserLeads\CreateOrUpdateUserLead;
use App\Orchid\Layouts\Lead\CreateOrUpdateLeadJournal;
use App\Orchid\Layouts\UserLeads\UserLeadListLayout;
use Orchid\Screen\Actions\ModalToggle;
use App\Services\Lead\JournalService;
use App\Orchid\Components\DateTime;
use App\Services\Lead\LeadService;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Screen\Sight;

class UserLeadScreen extends Screen
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
            __('platform.tabs.all').'_lead' => $this->leadService->index(['status'=>['Все'],'user'=>[auth()->id()]]),
            __('platform.tabs.new').'_lead' => $this->leadService->index(['status' => ['Новая'],'user'=>[auth()->id()]]),
            __('platform.tabs.process').'_lead' => $this->leadService->index(['status' => ['В процессе'],'user'=>[auth()->id()]]),
            __('platform.tabs.processed').'_lead' => $this->leadService->index(['status' => ['Обработана'],'user'=>[auth()->id()]]),
            __('platform.tabs.done').'_lead' => $this->leadService->index(['status' => ['Готово'],'user'=>[auth()->id()]]),
            __('platform.tabs.refuse').'_lead' => $this->leadService->index(['status' => ['Отказ'],'user'=>[auth()->id()]]),
            __('platform.tabs.draft').'_lead' => $this->leadService->index(['status' => ['Черновик'],'user'=>[auth()->id()]]),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return __('platform.pages.menu.crm.user_leads.index');
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return __('platform.pages.menu.crm.user_leads.description');
    }

    public function permission(): ?iterable
    {
        return ['crm.user_leads.*',];
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            //
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
                __('platform.tabs.all')         => new UserLeadListLayout(__('platform.tabs.all').'_lead'),
                __('platform.tabs.new')         => new UserLeadListLayout(__('platform.tabs.new').'_lead'),
                __('platform.tabs.process')     => new UserLeadListLayout(__('platform.tabs.process').'_lead'),
                __('platform.tabs.processed')   => new UserLeadListLayout(__('platform.tabs.processed').'_lead'),
                __('platform.tabs.done')        => new UserLeadListLayout(__('platform.tabs.done').'_lead'),
                __('platform.tabs.refuse')      => new UserLeadListLayout(__('platform.tabs.refuse').'_lead'),
                __('platform.tabs.draft')       => new UserLeadListLayout(__('platform.tabs.draft').'_lead'),
            ]),

            Layout::blank([
                Layout::modal('asyncEditUserLead', CreateOrUpdateUserLead::class)
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
                            if (empty($lead['id']))
                                return '';
                            $lead = $this->leadService->get($lead['id']);
                            $html = '<div class="rounded bg-light mb-3 p-3">';
                            $journals = $lead->journals;
                            foreach ($journals as $journal) {
                                $html .= '<div class="d-flex-rows mb-3">';
                                $html .= '<div class="text-truncate"><a href="'.route('platform.systems.users.edit',['user' => $journal->user_id]).'">' . $journal->user?->name . '</a></div>';
                                $html .= '<div class="d-flex">';
                                $html .= '<div class="col-11 rounded bg-danger mr-0 p-3">';
                                $html .= '<span class="text-decoration-underline">'.(new DateTime($journal->created_at))->render().' : </span>';
                                $html .= '<br>';
                                $html .= '<span>' . $journal->message . '</span>';
                                $html .= '</div>';
                                $html .= '<div class="col-1">'.
                                    Button::make('')
                                            ->method('deleteJournal', [
                                                'journal' => $journal->id,
                                            ])
                                                ->icon('cross')
                                                    ->toHtml()
                                        .'</div>
                                    </div>
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

}
