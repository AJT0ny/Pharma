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
}

?>