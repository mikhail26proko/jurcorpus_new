<?php

declare(strict_types=1);

use App\Orchid\Screens\Examples\ExampleFieldsAdvancedScreen;
use App\Orchid\Screens\Examples\ExampleTextEditorsScreen;
use App\Orchid\Screens\Lead\UserLeadScreen;
use App\Orchid\Screens\System\Direction\DirectionScreen;
use App\Orchid\Screens\System\SystemLog\SystemLogScreen;
use App\Orchid\Screens\System\JobTitle\JobTitleScreen;
use App\Orchid\Screens\System\User\UserProfileScreen;
use App\Orchid\Screens\Examples\ExampleLayoutsScreen;
use App\Orchid\Screens\Examples\ExampleActionsScreen;
use App\Orchid\Screens\Examples\ExampleChartsScreen;
use App\Orchid\Screens\Examples\ExampleFieldsScreen;
use App\Orchid\Screens\Examples\ExampleCardsScreen;
use App\Orchid\Screens\System\Role\RoleEditScreen;
use App\Orchid\Screens\System\Role\RoleListScreen;
use App\Orchid\Screens\System\User\UserEditScreen;
use App\Orchid\Screens\System\User\UserListScreen;
use App\Orchid\Screens\Examples\ExampleGridScreen;
use App\Orchid\Screens\Employee\EmployeeScreen;
use App\Orchid\Screens\Examples\ExampleScreen;
use App\Orchid\Screens\Branch\BranchScreen;
use App\Orchid\Screens\Lead\LeadScreen;
use App\Orchid\Screens\PlatformScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

    // Main
    Route::screen('/main', PlatformScreen::class)
        ->name('platform.main');

    // Platform > Profile
    Route::screen('profile', UserProfileScreen::class)
        ->name('platform.profile')
        ->breadcrumbs(fn (Trail $trail) => $trail
            ->parent('platform.index')
            ->push(__('Profile'), route('platform.profile')));

    Route::group(['name' => 'Lead'], function(){
        Route::screen('lead', LeadScreen::class)
            ->name('platform.lead');
    });

    Route::group(['name' => 'UserLead'], function(){
        Route::screen('user_lead', UserLeadScreen::class)
            ->name('platform.user_lead');
    });

    Route::group(['name' => 'Branch'], function(){
        Route::screen('branches', BranchScreen::class)
            ->name('platform.branches');
    });

    Route::group(['name' => 'Employee'], function(){
        Route::screen('employees', EmployeeScreen::class)
            ->name('platform.employees');
    });

    Route::group(['name' => 'Users'], function(){
        // Platform > System > Users > User
        Route::screen('users/{user}/edit', UserEditScreen::class)
            ->name('platform.systems.users.edit')
            ->breadcrumbs(fn (Trail $trail, $user) => $trail
                ->parent('platform.systems.users')
                ->push($user->name, route('platform.systems.users.edit', $user)));

        // Platform > System > Users > Create
        Route::screen('users/create', UserEditScreen::class)
            ->name('platform.systems.users.create')
            ->breadcrumbs(fn (Trail $trail) => $trail
                ->parent('platform.systems.users')
                ->push(__('Create'), route('platform.systems.users.create')));

        // Platform > System > Users
        Route::screen('users', UserListScreen::class)
            ->name('platform.systems.users')
            ->breadcrumbs(fn (Trail $trail) => $trail
                ->parent('platform.index')
                ->push(__('Users'), route('platform.systems.users')));
    });

    Route::group(['name' => 'Roles'], function(){
        // Platform > System > Roles > Role
        Route::screen('roles/{role}/edit', RoleEditScreen::class)
            ->name('platform.systems.roles.edit')
            ->breadcrumbs(fn (Trail $trail, $role) => $trail
                ->parent('platform.systems.roles')
                ->push($role->name, route('platform.systems.roles.edit', $role)));

        // Platform > System > Roles > Create
        Route::screen('roles/create', RoleEditScreen::class)
            ->name('platform.systems.roles.create')
            ->breadcrumbs(fn (Trail $trail) => $trail
                ->parent('platform.systems.roles')
                ->push(__('Create'), route('platform.systems.roles.create')));

        // Platform > System > Roles
        Route::screen('roles', RoleListScreen::class)
            ->name('platform.systems.roles')
            ->breadcrumbs(fn (Trail $trail) => $trail
                ->parent('platform.index')
                ->push(__('Roles'), route('platform.systems.roles')));
    });

    Route::group(['name' => 'SystemLog'], function(){
        Route::screen('system_log', SystemLogScreen::class)
            ->name('platform.systems.system_log')
            ->breadcrumbs(fn (Trail $trail) => $trail
                ->parent('platform.index')
                ->push(
                    __('platform.pages.menu.system.system_log.index'),
                    route('platform.systems.system_log')
                )
            );
    });

    Route::group(['name' => 'JobTitle'], function(){
        Route::screen('job_title', JobTitleScreen::class)
            ->name('platform.directories.job_titles');
    });

    Route::group(['name' => 'Direction'], function(){
        Route::screen('directions', DirectionScreen::class)
            ->name('platform.directories.directions');
    });

    Route::group(['name' => 'Example'], function(){
        Route::screen('example', ExampleScreen::class)
            ->name('platform.example')
            ->breadcrumbs(fn (Trail $trail) => $trail
                ->parent('platform.index')
                ->push('Example Screen'));

        Route::screen('/examples/form/fields', ExampleFieldsScreen::class)->name('platform.example.fields');
        Route::screen('/examples/form/advanced', ExampleFieldsAdvancedScreen::class)->name('platform.example.advanced');
        Route::screen('/examples/form/editors', ExampleTextEditorsScreen::class)->name('platform.example.editors');
        Route::screen('/examples/form/actions', ExampleActionsScreen::class)->name('platform.example.actions');

        Route::screen('/examples/layouts', ExampleLayoutsScreen::class)->name('platform.example.layouts');
        Route::screen('/examples/grid', ExampleGridScreen::class)->name('platform.example.grid');
        Route::screen('/examples/charts', ExampleChartsScreen::class)->name('platform.example.charts');
        Route::screen('/examples/cards', ExampleCardsScreen::class)->name('platform.example.cards');
    });