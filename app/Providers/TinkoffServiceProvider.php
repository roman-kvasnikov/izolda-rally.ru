<?php

namespace App\Providers;

use App\Services\Tinkoff\TinkoffConfig;
use App\Services\Tinkoff\TinkoffService;
use Illuminate\Support\ServiceProvider;

class TinkoffServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Если есть обращение к тинькоф сервису - то конфигурируем его сразу. Таким образом при любом вызове, уже получаешь готовый тинькоф
        $this->app->bind(TinkoffService::class, function () {
            $config = config('services.tinkoff');

            return new TinkoffService(
                new TinkoffConfig(
                    terminal: $config['terminal'],
                    password: $config['password'],
                )
            );
        });
    }

    public function boot(): void
    {
        //
    }
}
