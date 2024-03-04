<?php

namespace App\Services\Merches;

use App\Faker\FakerImageProvider;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Support\ServiceProvider;

class MerchServiceProvider extends ServiceProvider
{
	/**
	 * Register services.
	 */
	public function register(): void
	{
		$this->app->singleton(Generator::class, function () {
			$faker = Factory::create();
			$faker->addProvider(new FakerImageProvider($faker));
			return $faker;
		});
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
