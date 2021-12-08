<?php

namespace Dao\Action;

use Dao\Table;

class Delete extends Table
{
    public static function deleteProductoCarrito($carritoProductoId)
    {
        $sqlStr = "DELETE FROM `carritoproducto` WHERE `carritoProductoId` = :carritoProductoId;";
        return self::executeNonQuery($sqlStr, array("carritoProductoId" => $carritoProductoId));
    }

    public static function deleteOrden($ordenId)
    {
        $sqlStr = "DELETE FROM `orden` WHERE ordenId = :ordenId;";
        return self::executeNonQuery($sqlStr, array("ordenId" => $ordenId));
    }

    public static function deleteProductoOrden($ordenId)
    {
        $sqlStr = "DELETE FROM `ordenproducto` WHERE ordenId = :ordenId;";
        return self::executeNonQuery($sqlStr, array("ordenId" => $ordenId));
    }
}

?>