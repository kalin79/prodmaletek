<?php


namespace App\Http\Enums;


class TypeChapas  extends Enum {



    protected static $masterId = 6;

    public static function master()
    {
        return self::$masterId;
    }
}
