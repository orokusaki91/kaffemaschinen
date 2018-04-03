<?php

namespace App\AdminMenu;

use App\AdminMenu\Facade as AdminMenuFacade;

use App\Http\ViewComposers\AdminNavComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class Provider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     */
    protected $defer = true;

    public function boot() {
        $this->registerMenu();
        $this->registerViewComposerData();
    }

    public function registerViewComposerData()
    {
        View::composer('admin.layouts.left-nav', AdminNavComposer::class);
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->registerServices();
        $this->app->alias('adminmenu', 'App\AdminMenu\Builder');
    }

    /**
     * Register the Admin Menu instance.
     */
    protected function registerServices()
    {
        $this->app->singleton('adminmenu', function ($app) {
            return new Builder();
        });
    }

    protected function registerMenu()
    {
        /**
         * Add Menu Product
         */
        AdminMenuFacade::add('product')
            ->label(__('lang.product'))
            ->route('admin.product.index');

        /**
         * Add Menu Package
         */
        AdminMenuFacade::add('package')
            ->label(__('lang.package'))
            ->route('admin.package.index');

        /**
         * Add Menu Popup
         */
        AdminMenuFacade::add('popup')
            ->label(__('lang.popup'))
            ->route('admin.popup.index');

        /**
         * Add Menu Sales
         */
        AdminMenuFacade::add('sale')
            ->label(__('lang.orders-sold'))
            ->route('admin.order.index');

        /**
         * Add Menu Category
         */
        AdminMenuFacade::add('category')
            ->label(__('lang.category'))
            ->route('admin.category.index');

        /**
         * Add Menu Partner
         */
        AdminMenuFacade::add('partner')
            ->label(__('Partner'))
            ->route('admin.partner.index');

        /**
         * Add Menu Customers
         */
        AdminMenuFacade::add('customers')
            ->label(__('lang.customer'))
            ->route("admin.buyer.index");

        /**
         * Add Menu Newsletters
         */
        AdminMenuFacade::add('newsletters')
            ->label(__('lang.newsletter'))
            ->route("admin.newsletter.index");
        /**
         * Add Menu System
         */
        AdminMenuFacade::add('system')
            ->label(__('lang.system'))
            ->route("#");
        $systemMenu = AdminMenuFacade::get('system');

        /**
         * Add Submenu Admin User
         */
        $adminUserMenu = new AdminMenu();
        $adminUserMenu->key('admin-user')
            ->label(__('lang.admin-users'))
            ->route('admin.admin-user.index');
        $systemMenu->subMenu('admin-user', $adminUserMenu);

        $changePasswordMenu = new AdminMenu();
        $changePasswordMenu->key('change-password')
            ->label(__('lang.change-password'))
            ->route('admin.change-password.index');
        $systemMenu->subMenu('change-password', $changePasswordMenu);

        /**
         * Add Menu Pages
         */
        AdminMenuFacade::add('home')
            ->label(__('lang.pages'))
            ->route("#");
        $homeMenu = AdminMenuFacade::get('home');

        /**

         * Add Submenu
         */
        $homeSubMenu = new AdminMenu();
        $homeSubMenu->key('home')
            ->label('Home')
            ->route('admin.page.home');
        $homeMenu->subMenu('home', $homeSubMenu);

        /**

         * Add Menu Product
         */
        AdminMenuFacade::add('statistics')
            ->label(__('lang.statistics'))
            ->route('admin.statistics');
    }

    public function provides()
    {
        return ['adminmenu', 'App\AdminMenu\Builder'];
    }
}

