<?php
namespace App\Http\Enums;

class TypeCantidadPuertas extends Enum {

    const UNO    = 1;
    const DOS     = 2;

    protected static $masterId = 1;

    public static function master()
    {
        return self::$masterId;
    }
}
