<?php

namespace App\Console\Commands;

use App\Services\Currencies\Commands\InstallCurrenciesCommand;
use App\Services\Payments\Commands\InstallPaymentsCommand;
use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->warn('Installation of application...');

        $this->call(InstallCurrenciesCommand::class);
        $this->call(InstallPaymentsCommand::class);

        $this->info('Application installed.');
    }
}
