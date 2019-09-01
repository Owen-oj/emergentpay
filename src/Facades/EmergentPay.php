<?php

namespace Owenoj\EmergentPay\Facades;

use Illuminate\Support\Facades\Facade;

class EmergentPay extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'emergentpay';
    }
}
