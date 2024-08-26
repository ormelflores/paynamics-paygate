<?php

namespace Paynamics\Paygate\Laravel\Facades;

class Paygate extends \Illuminate\Support\Facades\Facade
{
    public static function getFacadeAccessor(): string
    {
        return 'paygate';
    }
}
