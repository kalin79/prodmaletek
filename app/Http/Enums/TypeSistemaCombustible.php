<?php
namespace App\Http\Enums;

class TypeSistemaCombustible extends Enum {
    
    const INYECCION_ELECTRONICA    = 11;
    const DISTRIBUCION_POR_CARBURADOR     = 12;
    
    protected static $masterId = 4;
    
    public static function master()
    {
        return self::$masterId;
    }
}