<?php

namespace Laravel\Paynamics\Paygate\Constants;

class TransactionType
{
    const SALE = 'sale';

    const AUTHORIZED = 'authorized';

    const PREAUTHORIZED = 'preauthorized';

    public static function toArray(): array
    {
        return [
            self::SALE,
            self::AUTHORIZED,
            self::PREAUTHORIZED,
        ];
    }
}
