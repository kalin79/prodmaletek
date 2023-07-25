<?php
namespace App\Http\Enums;

class TypeCantidadCuerpos extends Enum {

    const DOS    = 7;

    protected static $masterId = 2;

    public static function master()
    {
        return self::$masterId;
    }
}
