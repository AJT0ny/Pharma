<?php

namespace Dao;

use Dao\Table;

class bitclient extends Table
{
    public static function obtenerBitacorasde1($id)
    {
        $sqlStr = "SELECT * from bitacora where bitusuario = :bitusuario;";
        return self::obtenerRegistros($sqlStr, array("bitusuario" => intval($id)));
    }
}
