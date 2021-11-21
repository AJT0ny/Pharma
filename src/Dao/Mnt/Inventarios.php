<?php

namespace Dao\Mnt;

use Dao\Table;

class Inventarios extends Table
{
    public static function obtenerInventarios()
    {
        $sqlStr = "SELECT * from inventario;";
        return self::obtenerRegistros($sqlStr, array());
    }
    public static function obtenerinventario($inventarioId)
    {
        $sqlStr = "SELECT * from inventario where inventarioId = :inventarioId;";
        return self::obtenerUnRegistro($sqlStr, array("inventarioId" => intval($inventarioId)));
    }
    public static function crearinventario($inventarioExistencias, $inventarioFechaCaducidad, $productoId)
    {
        $sqlstr = "INSERT INTO inventario (inventarioExistencias, inventarioFechaCaducidad, productoId) values (:inventarioExistencias, :inventarioFechaCaducidad, :productoId);";
        $parametros = array(
            "inventarioExistencias" => floatval($inventarioExistencias),
            "inventarioFechaCaducidad" => $inventarioFechaCaducidad,
            "productoId" =>  intval($productoId)
        );
        return self::executeNonQuery($sqlstr, $parametros);
    }

    public static function editarinventario($inventarioExistencias, $inventarioFechaCaducidad, $productoId, $inventarioId)
    {
        $sqlstr = "UPDATE inventario set inventarioExistencias=:inventarioExistencias, inventarioFechaCaducidad=:inventarioFechaCaducidad, productoId=:productoId where inventarioId = :inventarioId;";
        $parametros = array(
            "inventarioExistencias" =>  floatval($inventarioExistencias),
            "inventarioFechaCaducidad" =>  $inventarioFechaCaducidad,
            "productoId" => $productoId,
            "inventarioId" => intval($inventarioId)
        );
        return self::executeNonQuery($sqlstr, $parametros);
    }

    public static function eliminarinventario($inventarioId)
    {
        $sqlstr = "DELETE FROM inventario where inventarioId=:inventarioId;";
        $parametros = array(
            "inventarioId" => intval($inventarioId)
        );
        return self::executeNonQuery($sqlstr, $parametros);
    }
}
