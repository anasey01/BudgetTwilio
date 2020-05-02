<?php

namespace Oluseyi\BudgetTwilio\Facades;

use Illuminate\Support\Facades\Facade;

class BudgetTwilio extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'budgettwilio';
    }
}
