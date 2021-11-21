<?php

namespace Dao\Mnt;

use Dao\Table;

class Productos extends Table
{
    public static function obtenerProductos()
    {
        $sqlStr = "SELECT * from producto;";
        return self::obtenerRegistros($sqlStr, array());
    }
    public static function obtenerproducto($productoId)
    {
        $sqlStr = "SELECT * from producto where productoId = :productoId;";
        return self::obtenerUnRegistro($sqlStr, array("productoId" => intval($productoId)));
    }
    public static function crearproducto($productoNombre, $productoDescripcion, $productoCodigo, $productoPrecio, $productoFechaCreado, $productoFechaPublicado, $productoFechaEditado, $productoActivo, $presentacionId, $laboratorioId, $productoImagen)
    {
        $sqlstr = "INSERT INTO producto (productoNombre, productoDescripcion, productoCodigo, productoPrecio, productoFechaCreado, productoFechaPublicado, productoFechaEditado, productoActivo, presentacionId, laboratorioId, productoImagen) values (:productoNombre, :productoDescripcion, :productoCodigo, :productoPrecio, :productoFechaCreado, :productoFechaPublicado, :productoFechaEditado, :productoActivo, :presentacionId, :laboratorioId, :productoImagen);";
        $parametros = array(
            "productoNombre" => $productoNombre,
            "productoDescripcion" => $productoDescripcion,
            "productoCodigo" =>  $productoCodigo,
            "productoPrecio" =>  $productoPrecio,
            "productoFechaCreado" =>  $productoFechaCreado,
            "productoFechaPublicado" =>  $productoFechaPublicado,
            "productoFechaEditado" =>  $productoFechaEditado,
            "productoActivo" =>  $productoActivo,
            "presentacionId" =>  $presentacionId,
            "laboratorioId" =>  $laboratorioId,
            "productoImagen" =>  $productoImagen
        );
        return self::executeNonQuery($sqlstr, $parametros);
    }

    public static function editarproducto($productoNombre, $productoDescripcion, $productoCodigo, $productoPrecio, $productoFechaCreado, $productoFechaPublicado, $productoFechaEditado, $productoActivo, $presentacionId, $laboratorioId, $productoImagen, $productoId)
    {
        $sqlstr = "UPDATE producto set productoNombre=:productoNombre, productoDescripcion=:productoDescripcion, productoCodigo=:productoCodigo, productoPrecio=:productoPrecio, productoFechaCreado:productoFechaCreado, productoFechaPublicado=:productoFechaPublicado, productoFechaEditado=:productoFechaEditado, productoActivo=:productoActivo, presentacionId=:presentacionId, laboratorioId=:laboratorioId, productoImagen=:productoImagen where productoId = :productoId;";
        $parametros = array(
            "productoNombre" => $productoNombre,
            "productoDescripcion" => $productoDescripcion,
            "productoCodigo" =>  $productoCodigo,
            "productoPrecio" =>  $productoPrecio,
            "productoFechaCreado" =>  $productoFechaCreado,
            "productoFechaPublicado" =>  $productoFechaPublicado,
            "productoFechaEditado" =>  $productoFechaEditado,
            "productoActivo" =>  $productoActivo,
            "presentacionId" =>  $presentacionId,
            "laboratorioId" =>  $laboratorioId,
            "productoImagen" =>  $productoImagen,
            "productoId" => intval($productoId)
        );
        return self::executeNonQuery($sqlstr, $parametros);
    }

    public static function eliminarproducto($productoId)
    {
        $sqlstr = "DELETE FROM producto where productoId=:productoId;";
        $parametros = array(
            "productoId" => intval($productoId)
        );
        return self::executeNonQuery($sqlstr, $parametros);
    }
}
