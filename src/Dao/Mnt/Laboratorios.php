<?php

namespace Dao\Mnt;

use Dao\Table;
use Views\Renderer;

class Laboratorios extends Table
{
    public static function obtenerLaboratorios($list, $search, $numPerPage)
    {
        $startFrom = (intval($list) - 1) * $numPerPage;
        if (!empty($search)) {
            $sqlStr = "SELECT * FROM laboratorio WHERE `laboratorioNombre` LIKE :search LIMIT :startFrom,:numPerPage;";
            $parametros = array(
                "search" => "%$search%",
                "startFrom" => $startFrom,
                "numPerPage" => $numPerPage
            );
        } else {
            $sqlStr = "SELECT * FROM laboratorio LIMIT :startFrom,:numPerPage;";
            $parametros = array(
                "startFrom" => $startFrom,
                "numPerPage" => $numPerPage
            );
        }
        return self::obtenerRegistros($sqlStr, $parametros);
    }

    public static function obtenerNumLaboratorios()
    {
        $sqlStr = "SELECT * from laboratorio;";
        return self::obtenerRegistros($sqlStr, array());
    }

    public static function obtenerNLaboratoriosB($search)
    {
        $sqlStr = "SELECT * FROM laboratorio WHERE `laboratorioNombre` LIKE :search;";
        $parametros = array(
            "search" => "%$search%"
        );
        return self::obtenerRegistros($sqlStr, $parametros);
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
    public static function listarLaboratorios()
    {
        $sqlStr = "SELECT laboratorioId, laboratorioNombre FROM laboratorio;";
        return self::obtenerRegistros($sqlStr, array());
    }
    public static function countrows()
    {
        $sqlStr = "SELECT COUNT(*) FROM laboratorio;";
        return self::obtenerUnRegistro($sqlStr, array());
    }
}
