<?php

namespace Dao;

use Dao\Table;

class Checkout extends Table
{
    public static function getOrden($usuario_usercod)
    {
        $sqlStr = "SELECT * FROM orden WHERE usuario_usercod=:usuario_usercod;";
        return self::obtenerUnRegistro($sqlStr, array("usuario_usercod" => $usuario_usercod));
    }
    
    public static function fillProductosOrden($ordenId)
    {
        $sqlStr = "SELECT * from ordenproducto a inner join producto b on a.productoId = b.productoId WHERE ordenId=:ordenId;";
        return self::obtenerRegistros($sqlStr, array("ordenId" => $ordenId));
    }
}

?>