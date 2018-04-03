<?php

namespace App\Tabs;

use Illuminate\Support\Collection;

class TabsMaker
{
    /**
     * Tabs Collection
     */
    protected $adminTabs;

    /**
     * Tabs Construct
     */
    public function __construct()
    {
        $this->adminTabs = Collection::make([]);
    }

    /**
     * Add Tab to Tabs Collection
     */
    public function add($key) {
        $tab = new Tab();
        $this->adminTabs->put($key, $tab);

        return $tab;
    }


    /**
     * Return all registered Tab with Specified Type
     */
    public function all($type = "product") {

        $tabs = $this->adminTabs->filter(function ($item, $key) use ($type) {
            if($item->type == $type) {
                return true;
            }
        });

        return $tabs;
    }
}