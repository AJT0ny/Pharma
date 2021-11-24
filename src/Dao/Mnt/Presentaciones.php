<?php

namespace Dao\Mnt;

use Dao\Table;

class Presentaciones extends Table
{
    public static function obtenerPresentaciones($list, $search, $numPerPage)
    {
        $startFrom = (intval($list)-1)*$numPerPage;
        if(!empty($search)){
            $sqlStr = "SELECT * FROM presentacion WHERE `presentacionNombre` LIKE :search LIMIT :startFrom,:numPerPage;";
            $parametros = array(
                "search" => "%$search%",
                "startFrom" => $startFrom,
                "numPerPage" => $numPerPage
            );
        }else{
            $sqlStr = "SELECT * FROM presentacion LIMIT :startFrom,:numPerPage;";
            $parametros = array(
                "startFrom" => $startFrom,
                "numPerPage" => $numPerPage
            );
        }
        return self::obtenerRegistros($sqlStr, $parametros);
    }

    public static function obtenerNumPresentaciones()
    {
        $sqlStr = "SELECT * from presentacion;";
        return self::obtenerRegistros($sqlStr, array());
    }

    public static function obtenerNPresentacionesB($search)
    {
        $sqlStr = "SELECT * FROM presentacion WHERE `presentacionNombre` LIKE :search;";
        $parametros = array(
            "search" => "%$search%"
        );
        return self::obtenerRegistros($sqlStr, $parametros);
    }

    public static function obtenerPresentacion($presentacionId)
    {
        $sqlStr = "SELECT * from presentacion where presentacionId = :presentacionId;";
        return self::obtenerUnRegistro($sqlStr, array("presentacionId" => intval($presentacionId)));
    }
    public static function crearPresentacion($presentacionNombre, $presentacionDescripcion)
    {
        $sqlstr = "INSERT INTO presentacion (presentacionNombre, presentacionDescripcion) values (:presentacionNombre, :presentacionDescripcion);";
        $parametros = array(
            "presentacionNombre" => $presentacionNombre,
            "presentacionDescripcion" => $presentacionDescripcion
        );
        return self::executeNonQuery($sqlstr, $parametros);
    }

    public static function editarPresentacion($presentacionNombre, $presentacionDescripcion, $presentacionId)
    {
        $sqlstr = "UPDATE presentacion set presentacionNombre=:presentacionNombre, presentacionDescripcion=:presentacionDescripcion where presentacionId = :presentacionId;";
        $parametros = array(
            "presentacionNombre" =>  $presentacionNombre,
            "presentacionDescripcion" =>  $presentacionDescripcion,
            "presentacionId" => intval($presentacionId)
        );
        return self::executeNonQuery($sqlstr, $parametros);
    }

    public static function eliminarPresentacion($presentacionId)
    {
        $sqlstr = "DELETE FROM presentacion where presentacionId=:presentacionId;";
        $parametros = array(
            "presentacionId" => intval($presentacionId)
        );
        return self::executeNonQuery($sqlstr, $parametros);
    }
}
