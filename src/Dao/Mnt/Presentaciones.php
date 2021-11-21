<?php

namespace Dao\Mnt;

use Dao\Table;

class Presentaciones extends Table
{
    public static function obtenerPresentaciones()
    {
        $sqlStr = "SELECT * from presentacion;";
        return self::obtenerRegistros($sqlStr, array());
    }
    public static function obtenerpresentacion($presentacionId)
    {
        $sqlStr = "SELECT * from presentacion where presentacionId = :presentacionId;";
        return self::obtenerUnRegistro($sqlStr, array("presentacionId" => intval($presentacionId)));
    }
    public static function crearpresentacion($presentacionNombre, $presentacionDescripcion)
    {
        $sqlstr = "INSERT INTO presentacion (presentacionNombre, presentacionDescripcion) values (:presentacionNombre, :presentacionDescripcion);";
        $parametros = array(
            "presentacionNombre" => $presentacionNombre,
            "presentacionDescripcion" => $presentacionDescripcion
        );
        return self::executeNonQuery($sqlstr, $parametros);
    }

    public static function editarpresentacion($presentacionNombre, $presentacionDescripcion, $presentacionId)
    {
        $sqlstr = "UPDATE presentacion set presentacionNombre=:presentacionNombre, presentacionDescripcion=:presentacionDescripcion where presentacionId = :presentacionId;";
        $parametros = array(
            "presentacionNombre" =>  $presentacionNombre,
            "presentacionDescripcion" =>  $presentacionDescripcion,
            "presentacionId" => intval($presentacionId)
        );
        return self::executeNonQuery($sqlstr, $parametros);
    }

    public static function eliminarpresentacion($presentacionId)
    {
        $sqlstr = "DELETE FROM presentacion where presentacionId=:presentacionId;";
        $parametros = array(
            "presentacionId" => intval($presentacionId)
        );
        return self::executeNonQuery($sqlstr, $parametros);
    }
}
