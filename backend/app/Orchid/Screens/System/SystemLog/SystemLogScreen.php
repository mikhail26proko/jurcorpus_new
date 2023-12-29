<?php

declare(strict_types=1);

namespace App\Orchid\Screens\System\SystemLog;

use App\Orchid\Layouts\System\SystemLog\SystemLogListLayout;
use Orchid\Screen\Screen;
use App\Models\SystemLog;

class SystemLogScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'system_log' => SystemLog::with('user')
                ->orderByDesc('created_at')
                    ->paginate(config('app.orchid_one_page')),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return __('platform.pages.menu.system.system_log.index');
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return __('platform.pages.menu.system.system_log.description');
    }

    public function permission(): ?iterable
    {
        return [
            'platform.systems.system_log',
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
            SystemLogListLayout::class,
        ];
    }

}
