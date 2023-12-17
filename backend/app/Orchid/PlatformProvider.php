<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Menu;
use Orchid\Support\Color;

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

        // ...
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
                ->icon('bs.book')
                ->route(config('platform.index')),

            Menu::make(__('platform.pages.menu.branches.index'))
                ->permission('platform.branches')
                    ->icon('person-vcard')
                        ->route('platform.branches'),

            Menu::make(__('platform.pages.menu.employees.index'))
                ->permission('platform.employees')
                    ->icon('person-vcard')
                        ->route('platform.employees'),

            Menu::make(__('platform.pages.menu.publications.index'))
                    ->permission('platform.publications')
                    ->icon('fa.newspaper-solid'),
                        // ->route('platform.news'),

            Menu::make(__('platform.pages.menu.vacancies.index'))
                ->permission('platform.vacancies')
                ->icon('briefcase'),
                    // ->route('platform.vacancies'),

            Menu::make(__('platform.pages.menu.system.index'))
                ->icon('bs.gear-wide-connected')
                    ->list([
                        Menu::make(__('platform.pages.menu.system.users.index'))
                            ->icon('bs.people')
                                ->route('platform.systems.users')
                                    ->permission('platform.systems.users'),

                        Menu::make(__('platform.pages.menu.system.roles.index'))
                                ->icon('bs.shield')
                                    ->route('platform.systems.roles')
                                        ->permission('platform.systems.roles'),

                    ]),

            Menu::make(__('platform.pages.menu.examples.index'))
            ->permission('platform.examples')
                ->icon('settings')
                ->list([
                    Menu::make('Sample Screen')
                        ->icon('bs.collection')
                        ->route('platform.example')
                        ->badge(fn () => 6),

                    Menu::make('Form Elements')
                        ->icon('bs.card-list')
                        ->route('platform.example.fields')
                        ->active('*/examples/form/*'),

                    Menu::make('Overview Layouts')
                        ->icon('bs.window-sidebar')
                        ->route('platform.example.layouts'),

                    Menu::make('Grid System')
                        ->icon('bs.columns-gap')
                        ->route('platform.example.grid'),

                    Menu::make('Charts')
                        ->icon('bs.bar-chart')
                        ->route('platform.example.charts'),

                    Menu::make('Cards')
                        ->icon('bs.card-text')
                        ->route('platform.example.cards')
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
            ItemPermission::group(__('platform.pages.menu.system.index'))
                ->addPermission('platform.systems.users', __('platform.pages.menu.system.users.index'))
                ->addPermission('platform.systems.roles', __('platform.pages.menu.system.roles.index')),

            ItemPermission::group(__('platform.pages.menu.examples.index'))
                ->addPermission('platform.examples', __('platform.pages.menu.examples.index')),

            ItemPermission::group(__('platform.pages.menu.branches.index'))
                ->addPermission('platform.branches', __('platform.pages.menu.branches.index')),

            ItemPermission::group(__('platform.pages.menu.employees.index'))
                ->addPermission('platform.employees', __('platform.pages.menu.employees.index')),

            ItemPermission::group(__('platform.pages.menu.publications.index'))
                ->addPermission('platform.publications', __('platform.pages.menu.publications.index')),

            ItemPermission::group(__('platform.pages.menu.vacancies.index'))
                ->addPermission('platform.vacancies', __('platform.pages.menu.vacancies.index')),
        ];
    }
}
