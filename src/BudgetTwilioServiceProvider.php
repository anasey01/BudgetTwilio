<?php

namespace Oluseyi\BudgetTwilio;

use Exception;
use Twilio\Rest\Client;
use Oluseyi\BudgetTwilio\BudgetTwilio;
use Illuminate\Support\ServiceProvider;

class BudgetTwilioServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/budgettwilio.php', 'budgettwilio');

        $this->app->bind('budgettwilio', function () {
            $this->ensureConfigValuesAreSet();
            $client = new Client(config('budgettwilio.account_sid'), config('budgettwilio.auth_token'));
            return new BudgetTwilio($client);
        });
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishConfig();
        }
    }

    protected function ensureConfigValuesAreSet()
    {
        $mandatoryAttributes = config('budgettwilio');

        foreach ($mandatoryAttributes as $key => $value) {
            if (empty($value)) {
                throw new Exception("Please provide a value for ${key}");
            }
        }
    }

    protected function publishConfig()
    {
        $this->publishes([
            __DIR__ . '/../config/budgettwilio.php' => config_path('budgettwilio.php'),
        ], 'budgettwilio-config');
    }
}
