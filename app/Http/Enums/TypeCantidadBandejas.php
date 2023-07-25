<?php
namespace App\Http\Enums;

class TypeCantidadBandejas extends Enum {

    const UNA    = 8;
    const DOS     = 9;
    const TRES     = 10;
    const CUATRO     = 11;
    const CINCO     = 12;
    protected static $masterId = 5;

    public static function master()
    {
        return self::$masterId;
    }
}
