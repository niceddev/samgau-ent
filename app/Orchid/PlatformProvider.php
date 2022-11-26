<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * @param Dashboard $dashboard
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);
    }

    /**
     * @return Menu[]
     */
    public function registerMainMenu(): array
    {
        return [
            Menu::make(__('common.must_subjects'))
                ->icon('book-open')
                ->route('platform.must_subjects.index'),

            Menu::make(__('common.subjects'))
                ->icon('book-open')
                ->route('platform.subjects.index'),

            Menu::make(__('common.students'))
                ->icon('people')
                ->route('platform.students.index'),

            Menu::make(__('common.grades'))
                ->icon('layers')
                ->route('platform.grades.index'),
        ];
    }

    /**
     * @return Menu[]
     */
    public function registerProfileMenu(): array
    {
        return [];
    }

    /**
     * @return ItemPermission[]
     */
    public function registerPermissions(): array
    {
        return [];
    }
}
