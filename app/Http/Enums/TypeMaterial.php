<?php
namespace App\Http\Enums;

class TypeMaterial extends Enum {

    const PLASTIVO_PVC    = 6;
    const PLASTICO_PROLIPROPELENO     = 7;

    protected static $masterId = 4;

    public static function master()
    {
        return self::$masterId;
    }
}
