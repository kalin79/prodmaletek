<?php
namespace App\Http\Enums;

class TypeCantidadCajones extends Enum {

    const CUATRO    = 4;
    const CINCO     = 5;

    protected static $masterId = 3;

    public static function master()
    {
        return self::$masterId;
    }
}
