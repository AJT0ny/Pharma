<?php

namespace Dao\Mnt;

use Dao\Table;

class Laboratorios extends Table
{
    public static function obtenerLaboratorios()
    {
        $sqlStr = "SELECT * from laboratorio;";
        return self::obtenerRegistros($sqlStr, array());
    }
    public static function obtenerLaboratorio($laboratorioId)
    {
        $sqlStr = "SELECT * from laboratorio where laboratorioId = :laboratorioId;";
        return self::obtenerUnRegistro($sqlStr, array("laboratorioId" => intval($laboratorioId)));
    }
    public static function crearLaboratorio($laboratorioNombre, $laboratorioDescripcion)
    {
        $sqlstr = "INSERT INTO laboratorio (laboratorioNombre, laboratorioDescripcion) values (:laboratorioNombre, :laboratorioDescripcion);";
        $parametros = array(
            "laboratorioNombre" => $laboratorioNombre,
            "laboratorioDescripcion" => $laboratorioDescripcion
        );
        return self::executeNonQuery($sqlstr, $parametros);
    }

    public static function editarLaboratorio($laboratorioNombre, $laboratorioDescripcion, $laboratorioId)
    {
        $sqlstr = "UPDATE laboratorio set laboratorioNombre=:laboratorioNombre, laboratorioDescripcion=:laboratorioDescripcion where laboratorioId = :laboratorioId;";
        $parametros = array(
            "laboratorioNombre" =>  $laboratorioNombre,
            "laboratorioDescripcion" =>  $laboratorioDescripcion,
            "laboratorioId" => intval($laboratorioId)
        );
        return self::executeNonQuery($sqlstr, $parametros);
    }

    public static function eliminarLaboratorio($laboratorioId)
    {
        $sqlstr = "DELETE FROM laboratorio where laboratorioId=:laboratorioId;";
        $parametros = array(
            "laboratorioId" => intval($laboratorioId)
        );
        return self::executeNonQuery($sqlstr, $parametros);
    }
}
