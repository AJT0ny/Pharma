<?php

namespace Dao;

use Dao\Table;

class Details extends Table
{
    public static function obtenerProducto($productoId)
    {
        $sqlStr = "SELECT * from producto a 
        inner join inventario b on a.productoId = b.productoId 
        inner join laboratorio c on a.laboratorioId = c.laboratorioId
        inner join presentacion d on a.presentacionId = d.presentacionId
        where b.productoId=:productoId;";
        return self::obtenerUnRegistro($sqlStr, array("productoId" => intval($productoId)));
    }
    
    public static function obtenerProductosRelacionados($presentacionId, $productoId)
    {
        $limitN = 4;
        $sqlStr = "SELECT * FROM producto WHERE presentacionId = :presentacionId AND NOT productoId = :productoId LIMIT :limitN;";
        $parametros = array(
            "presentacionId" => $presentacionId,
            "productoId" => $productoId,
            "limitN" => $limitN
        );
        return self::obtenerRegistros($sqlStr, $parametros);
    }
}

?>