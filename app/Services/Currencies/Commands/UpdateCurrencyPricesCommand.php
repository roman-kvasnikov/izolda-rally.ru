<?php

namespace App\Services\Currencies\Commands;

use App\Services\Currencies\CurrencyService;
use App\Services\Currencies\Sources\SourceEnum;
use Illuminate\Console\Command;

class UpdateCurrencyPricesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currencies:prices {source}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updating currency rates';

    /**
     * Execute the console command.
     */
    public function handle(CurrencyService $service)
    {
        $this->warn('Updation currency rates...');

        $this->updatePrices($service);

        $this->info('Currency rates are updated.');
    }

    private function updatePrices(CurrencyService $service): void
    {
        $source = $service->getSource(
            SourceEnum::from($this->argument('source'))
        );

        $service->updatePrices()->run($source);
    }
}
