<?php

namespace Dao;

use Dao\Table;

class Shop extends Table
{
    public static function obtenerNumProductos()
    {
        $sqlStr = "SELECT * from producto;";
        return self::obtenerRegistros($sqlStr, array());
    }

    public static function obtenerNumProductosB($presentacion)
    {
        $sqlStr = "SELECT * from producto WHERE presentacionId = :presentacion;";
        return self::obtenerRegistros($sqlStr, array("presentacion" => $presentacion));
    }
    
    public static function obtenerProductos($list, $presentacion, $numPerPage)
    {
        $startFrom = (intval($list) - 1) * $numPerPage;
        if (!empty($presentacion)) {
            $sqlStr = "SELECT * FROM producto WHERE `presentacionId`=:presentacion LIMIT :startFrom,:numPerPage;";
            $parametros = array(
                "presentacion" => $presentacion,
                "startFrom" => $startFrom,
                "numPerPage" => $numPerPage
            );
        } else {
            $sqlStr = "SELECT * FROM producto LIMIT :startFrom,:numPerPage;";
            $parametros = array(
                "startFrom" => $startFrom,
                "numPerPage" => $numPerPage
            );
        }
        return self::obtenerRegistros($sqlStr, $parametros);
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