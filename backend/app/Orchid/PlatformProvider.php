<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\OrchidServiceProvider;
use Orchid\Platform\ItemPermission;
use Orchid\Screen\Actions\Menu;
use Orchid\Platform\Dashboard;
use Orchid\Support\Color;
use App\Models\Lead;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @param Dashboard $dashboard
     *
     * @return void
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);
    }

    /**
     * Register the application menu.
     *
     * @return Menu[]
     */
    public function menu(): array
    {
        return [

            Menu::make(__('platform.pages.menu.main.index'))
                ->route(config('platform.index'))
                ->icon('orchid-old'),

            Menu::make(__('platform.pages.menu.crm.leads.index'))
                ->badge(function () {
                    return Lead::where('status', 'Новая')->count();
                }, Color::DANGER)
                ->permission('crm.leads.*')
                ->route('platform.lead')
                ->icon('note'),

            Menu::make(__('platform.pages.menu.crm.user_leads.index'))
                ->badge(function () {
                    return Lead::where('status', 'Новая')->where('user_id', auth()->id())->count();
                }, Color::DANGER)
                ->permission('crm.user_leads.*')
                ->route('platform.user_lead')
                ->icon('note'),

            Menu::make(__('platform.pages.menu.branches.index'))
                ->permission('branches.*')
                ->route('platform.branches')
                ->icon('person-vcard'),

            Menu::make(__('platform.pages.menu.employees.index'))
                ->permission('employees.*')
                ->route('platform.employees')
                ->icon('person-vcard'),

            Menu::make(__('platform.pages.menu.publications.index'))
                ->permission('publications.*')
                // ->route('platform.news')
                ->icon('fa.newspaper-solid'),

            Menu::make(__('platform.pages.menu.vacancies.index'))
                ->permission('vacancies.*')
                // ->route('platform.vacancies')
                ->icon('briefcase'),

            Menu::make(__('platform.pages.menu.system.index'))
                ->permission('system.*')
                ->icon('bs.gear-wide-connected')
                ->parent('system')
                ->list([

                    Menu::make(__('platform.pages.menu.system.users.index'))
                        ->permission('system.users.*')
                        ->route('platform.systems.users')
                        ->icon('bs.people'),

                    Menu::make(__('platform.pages.menu.system.roles.index'))
                        ->permission('system.roles.*')
                        ->route('platform.systems.roles')
                        ->icon('bs.shield'),

                    Menu::make(__('platform.pages.menu.system.directories.index'))
                        ->permission('system.directories.*')
                        ->icon('notebook')
                        ->parent('directories')
                        ->list([

                            Menu::make(__('platform.pages.menu.system.directories.job_titles.index'))
                                ->permission('system.directories.job_titles.*')
                                ->route('platform.directories.job_titles'),

                            Menu::make(__('platform.pages.menu.system.directories.directions.index'))
                                ->permission('system.directories.directions.*')
                                ->route('platform.directories.directions'),
                        ]),

                    Menu::make(__('platform.pages.menu.system.system_log.index'))
                        ->permission('system.system_log.*')
                        ->route('platform.systems.system_log')
                        ->icon('history'),
                ]),

            Menu::make(__('platform.pages.menu.examples.index'))
                ->permission('examples.*')
                ->icon('settings')
                ->list([

                    Menu::make('Sample Screen')
                        ->badge(fn() => 6)
                        ->route('platform.example')
                        ->icon('bs.collection'),

                    Menu::make('Form Elements')
                        ->route('platform.example.fields')
                        ->icon('bs.card-list')
                        ->active('*/examples/form/*'),

                    Menu::make('Overview Layouts')
                        ->route('platform.example.layouts')
                        ->icon('bs.window-sidebar'),

                    Menu::make('Grid System')
                        ->route('platform.example.grid')
                        ->icon('bs.columns-gap'),

                    Menu::make('Charts')
                        ->route('platform.example.charts')
                        ->icon('bs.bar-chart'),

                    Menu::make('Cards')
                        ->route('platform.example.cards')
                        ->icon('bs.card-text')
                        ->divider(),
                ]),

        ];
    }

    /**
     * Register permissions for the application.
     *
     * @return ItemPermission[]
     */
    public function permissions(): array
    {
        return [

            ItemPermission::group(__('platform.pages.menu.crm.leads.index'))
                ->addPermission('crm.leads.full', __('platform.actions.full'))
                ->addPermission('crm.leads.read', __('platform.actions.read'))
                ->addPermission('crm.leads.create', __('platform.actions.create'))
                ->addPermission('crm.leads.update', __('platform.actions.update'))
                ->addPermission('crm.leads.delete', __('platform.actions.delete')),

            ItemPermission::group(__('platform.pages.menu.crm.user_leads.index'))
                ->addPermission('crm.user_leads.full', __('platform.actions.full'))
                ->addPermission('crm.user_leads.read', __('platform.actions.read'))
                ->addPermission('crm.user_leads.create', __('platform.actions.create'))
                ->addPermission('crm.user_leads.update', __('platform.actions.update'))
                ->addPermission('crm.user_leads.delete', __('platform.actions.delete')),

            ItemPermission::group(__('platform.pages.menu.branches.index'))
                ->addPermission('branches.full', __('platform.actions.full'))
                ->addPermission('branches.read', __('platform.actions.read'))
                ->addPermission('branches.create', __('platform.actions.create'))
                ->addPermission('branches.update', __('platform.actions.update'))
                ->addPermission('branches.delete', __('platform.actions.delete')),

            ItemPermission::group(__('platform.pages.menu.employees.index'))
                ->addPermission('employees.full', __('platform.actions.full'))
                ->addPermission('employees.read', __('platform.actions.read'))
                ->addPermission('employees.create', __('platform.actions.create'))
                ->addPermission('employees.update', __('platform.actions.update'))
                ->addPermission('employees.delete', __('platform.actions.delete')),

            ItemPermission::group(__('platform.pages.menu.system.users.index'))
                ->addPermission('system.users.full', __('platform.actions.full'))
                ->addPermission('system.users.read', __('platform.actions.read'))
                ->addPermission('system.users.create', __('platform.actions.create'))
                ->addPermission('system.users.update', __('platform.actions.update'))
                ->addPermission('system.users.delete', __('platform.actions.delete')),

            ItemPermission::group(__('platform.pages.menu.system.roles.index'))
                ->addPermission('system.roles.full', __('platform.actions.full'))
                ->addPermission('system.roles.read', __('platform.actions.read'))
                ->addPermission('system.roles.create', __('platform.actions.create'))
                ->addPermission('system.roles.update', __('platform.actions.update'))
                ->addPermission('system.roles.delete', __('platform.actions.delete')),

            ItemPermission::group(__('platform.pages.menu.system.system_log.index'))
                ->addPermission('system.system_log.full', __('platform.actions.full')),

            ItemPermission::group(__('platform.pages.menu.system.directories.job_titles.index'))
                ->addPermission('system.directories.job_titles.full', __('platform.actions.full'))
                ->addPermission('system.directories.job_titles.read', __('platform.actions.read'))
                ->addPermission('system.directories.job_titles.create', __('platform.actions.create'))
                ->addPermission('system.directories.job_titles.update', __('platform.actions.update'))
                ->addPermission('system.directories.job_titles.delete', __('platform.actions.delete')),

            ItemPermission::group(__('platform.pages.menu.system.directories.directions.index'))
                ->addPermission('system.directories.directions.full', __('platform.actions.full'))
                ->addPermission('system.directories.directions.read', __('platform.actions.read'))
                ->addPermission('system.directories.directions.create', __('platform.actions.create'))
                ->addPermission('system.directories.directions.update', __('platform.actions.update'))
                ->addPermission('system.directories.directions.delete', __('platform.actions.delete')),

            ItemPermission::group(__('platform.pages.menu.examples.index'))
                ->addPermission('examples.full', __('platform.actions.full')),

            // ItemPermission::group(__('platform.pages.menu.system.index'))
            // ->addPermission('platform.systems.users', __('platform.pages.menu.system.users.index'))
            // ->addPermission('platform.systems.roles', __('platform.pages.menu.system.roles.index'))
            // ->addPermission('platform.systems.system_log', __('platform.pages.menu.system.system_log.index'))
            // ->addPermission('platform.systems.directories', __('platform.pages.menu.system.directories.index')),

            // ItemPermission::group(__('platform.pages.menu.branches.index'))
            //     ->addPermission('platform.branches', __('platform.pages.menu.branches.index')),

            // ItemPermission::group(__('platform.pages.menu.employees.index'))
            //     ->addPermission('platform.employees', __('platform.pages.menu.employees.index')),

            // ItemPermission::group(__('platform.pages.menu.publications.index'))
            //     ->addPermission('platform.publications', __('platform.pages.menu.publications.index')),

            // ItemPermission::group(__('platform.pages.menu.vacancies.index'))
            //     ->addPermission('platform.vacancies', __('platform.pages.menu.vacancies.index')),
        ];
    }
}
