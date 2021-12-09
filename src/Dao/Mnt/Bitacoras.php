<?php

namespace Dao\Mnt;

use Dao\Table;

class Bitacoras extends Table
{
    public static function obtenerBitacoras()
    {
        $sqlStr = "SELECT * from bitacora;";
        return self::obtenerRegistros($sqlStr, array());
    }
    public static function obtenerBitacora($bitacoracod)
    {
        $sqlStr = "SELECT * from bitacora where bitacoracod = :bitacoracod;";
        return self::obtenerUnRegistro($sqlStr, array("bitacoracod" => intval($bitacoracod)));
    }
}
