<?php

namespace Dao;

use Dao\Table;

class Cart extends Table
{
    public static function getCarritoId($userId)
    {
        $sqlStr = "SELECT carritoId FROM carrito WHERE usuario_usercod = :userId;";
        $parametros = array(
            "userId" => $userId
        );
        return self::obtenerUnRegistro($sqlStr, $parametros);
    }

    public static function obtenerProductosEnCarrito($carritoId)
    {
        $sqlStr = "SELECT * from carritoproducto a 
        inner join carrito b on a.carritoId = b.carritoId
        inner join producto c on a.productoId = c.productoId 
        where b.carritoId=:carritoId;";
        $parametros = array(
            "carritoId" => $carritoId
        );
        return self::obtenerRegistros($sqlStr, $parametros);
    }
}

?>