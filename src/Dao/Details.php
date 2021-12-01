<?php

namespace Dao;

use Dao\Table;

class Details extends Table
{
    public static function obtenerProducto($productoId)
    {
        $sqlStr = "SELECT * from producto where productoId = :productoId;";
        return self::obtenerUnRegistro($sqlStr, array("productoId" => intval($productoId)));
    }
}

?>