<?php
namespace App\Http\Enums;

class TypeTransmision extends Enum {
    
    const MECANICO    = 4;
    const AUTOMATICO     = 5;
    const SEMIAUTOMATICO     = 6;

    protected static $masterId = 2;
    
    public static function master()
    {
        return self::$masterId;
    }
}