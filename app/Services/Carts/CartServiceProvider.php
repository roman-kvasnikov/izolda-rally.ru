<?php

namespace App\Services\Carts;

use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
	/**
	 * Register services.
	 */
	public function register(): void
	{
		//
	}

	/**
	 * Bootstrap services.
	 */
	public function boot(): void
	{
		if ($this->app->runningInConsole()) {
			$this->loadMigrationsFrom(__DIR__ . '/Migrations');
		}
	}
}
