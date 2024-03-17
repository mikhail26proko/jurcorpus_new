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
                ->route('platform.publications')
                ->icon('person-vcard'),

            Menu::make(__('platform.pages.menu.services.index'))
                ->permission('services.*')
                ->route('platform.services')
                ->icon('briefcase'),

            Menu::make(__('platform.pages.menu.vacansies.index'))
                ->permission('vacansies.*')
                ->route('platform.vacansies')
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

                            Menu::make(__('platform.pages.menu.system.directories.pub_sources.index'))
                                ->permission('system.directories.pub_sources.*')
                                ->route('platform.directories.pub_sources'),

                            Menu::make(__('platform.pages.menu.system.directories.pub_types.index'))
                                ->permission('system.directories.pub_types.*')
                                ->route('platform.directories.pub_types'),
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

            $this->permissionsGenerate('crm.leads'),
            $this->permissionsGenerate('crm.user_leads'),
            $this->permissionsGenerate('branches'),
            $this->permissionsGenerate('employees'),
            $this->permissionsGenerate('publications'),
            $this->permissionsGenerate('services'),
            $this->permissionsGenerate('vacansies'),
            $this->permissionsGenerate('system.users'),
            $this->permissionsGenerate('system.roles'),
            $this->permissionsGenerate('system.directories.job_titles'),
            $this->permissionsGenerate('system.directories.directions'),
            $this->permissionsGenerate('system.directories.pub_sources'),
            $this->permissionsGenerate('system.directories.pub_types'),

            $this->permissionsGenerate('system.system_log', ['full']),
            $this->permissionsGenerate('examples',['full']),

        ];
    }

    private function permissionsGenerate(string $page, array $permits = ['full', 'read', 'create', 'update', 'delete']): ItemPermission
    {
        $permission =  ItemPermission::group(__('platform.pages.menu.' . $page . '.index'));

        foreach ($permits as $permit) {
            $permission->addPermission(
                $page . '.' . $permit,
                __('platform.actions.' . $permit)
            );
        }

        return $permission;
    }
}
