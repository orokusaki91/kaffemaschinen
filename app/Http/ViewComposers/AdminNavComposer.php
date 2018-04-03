<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\AdminMenu\Facade as AdminMenu;

class AdminNavComposer
{
    /**
     * Bind data to view.
     */
    public function compose(View $view)
    {
        $adminMenus = (array)AdminMenu::getMenuItems();
        $view->with('adminMenus', $adminMenus);
    }
}