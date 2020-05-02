<?php

namespace Oluseyi\BudgetTwilo;

use Twilio\Rest\Client;

class BudgetTwilio
{
    /** @var Twilio\Rest\Client */
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function notify(string $number, string $message)
    {
        return $this->client->messages->create($number, [
            'from' => config('budgettwilio.sms_from'),
            'body' => $message
        ]);
    }
}
