<?php

namespace App\AdminMenu;


use Illuminate\Support\Collection;

class Builder
{
    protected $adminMenu;

    public function __construct()
    {
        $this->adminMenu = Collection::make([]);
    }

    public function add($key) {
        $menu = new AdminMenu();
        $menu->key($key);
        $this->adminMenu->put($key, $menu);

        return $menu;
    }

    public function get($key) {
        return $this->adminMenu->get($key);
    }

    public function registerMenu($menuKey, $adminMenu)
    {
        if ($this->adminMenu->has($menuKey)) {
            $adminMenuObj = $this->adminMenu->get($menuKey);

            foreach ($adminMenu as $key => $menuArray) {
                if (isset($menuArray['submenu'])) {
                    $menus = $menuArray['submenu'];

                    foreach ($menus as $subKey => $subArray) {
                        $subObj = new AdminMenu;
                        $subObj->key($subKey)
                               ->label($subArray['label'])
                               ->route($subArray['route']);

                        $adminMenuObj->subMenu($subKey, $subObj);
                    }
                }
            }

            $this->adminMenu->put($menuKey, $adminMenuObj);
        } else {
            $adminMenuObj = new AdminMenu;

            foreach ($adminMenu as $key => $menuArray) {
                $flag = true;

                $adminMenuObj->key($key);

                if (isset($menuArray['label'])) {
                    $adminMenuObj->label($menuArray['label']);
                } else {
                    $flag = false;
                }

                if (isset($menuArray['route'])) {
                    $adminMenuObj->route($menuArray['route']);
                } else {
                    $flag = false;
                }
            }

            if (false !== $flag) {
                $this->adminMenu->put($menuKey, $adminMenuObj);
            }
        }
    }

    public function getMenuItems()
    {
        return $this->adminMenu->all();
    }
}