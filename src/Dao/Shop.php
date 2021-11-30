<?php

namespace Dao;

use Dao\Table;

class Shop extends Table
{
    public static function obtenerProductos()
    {
        $sqlStr = "SELECT * FROM producto;";
        return self::obtenerRegistros($sqlStr, array());
    }
    public static function obtenerPresentaciones()
    {
        $sqlStr = "SELECT * from presentacion;";
        return self::obtenerRegistros($sqlStr, array());
    }
    public static function productosRecientes()
    {
        $limitN = 3;
        $sqlStr = "SELECT * FROM producto ORDER BY productoId DESC LIMIT :limitN;";
        $parametros= array(
            "limitN" => $limitN
        );
        return self::obtenerRegistros($sqlStr, $parametros);
    }
}

?>