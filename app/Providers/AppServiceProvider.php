<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
		// View composer for authenticated user profile info ...
        view()->composer([
				'dashboard',
				'branches.list',
				'branches.create',
				'branches.show',
				'branches.edit',
				'suppliers.list',
				'suppliers.create',
				'suppliers.show',
				'suppliers.edit',
				'items.list',
				'items.create',
				'items/category.list',
				'items/uom.list',
				
				'inventory.list',
				'inventory/items.create',
				'inventory/items.show',
				'inventory/items.edit',
				'inventory/munits.create',
				'inventory/munits.show',
				'inventory/munits.edit',
				'purchase.list',
				'purchase.create',
				
				'user.register',
				'user.list',
				'user.show',
				'user.edit',
			], 
			'App\Http\ViewComposers\AuthUserProfileComposer'
		);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
