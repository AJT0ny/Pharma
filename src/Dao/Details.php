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

    public static function crearCarrito($userId, $carritoEstado, $usuario_usercod)
    {
        $sqlStr = "INSERT INTO carrito (`usuarioId`, `carritoCreadoEl`, `carritoActualizadoEl`, `carritoEstado`, `usuario_usercod`) 
        VALUES (:userId, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, :carritoEstado, :usuario_usercod);";
        $parametros = array(
            "userId" => $userId,
            "carritoEstado" => $carritoEstado,
            "usuario_usercod" => $usuario_usercod
        );
        return self::executeNonQuery($sqlStr, $parametros);
    }

    public static function getCarritoId($usuario_usercod)
    {
        $sqlStr = "SELECT carritoId FROM carrito WHERE usuario_usercod=:usuario_usercod;";
        return self::obtenerUnRegistro($sqlStr, array("usuario_usercod" => $usuario_usercod));
    }

    public static function infoCarrito($usuario_usercod)
    {
        $sqlStr = "SELECT * FROM carrito WHERE usuario_usercod = :usuario_usercod;";
        $parametros = array(
            "usuario_usercod" => $usuario_usercod
        );
        return self::obtenerUnRegistro($sqlStr, $parametros);
    }

    public static function existeCarrito($usuario_usercod)
    {
        $sqlStr = "SELECT * FROM carrito WHERE usuario_usercod = :usuario_usercod;";
        $parametros = array(
            "usuario_usercod" => $usuario_usercod
        );
        return self::obtenerRegistros($sqlStr, $parametros);
    }

    public static function agregarProductoACarrito($productoId, $carritoId, $carritoProductoCantidad, $carritoProductoTotal, $carritoProductoActivo)
    {
        $sqlStr = "INSERT INTO carritoproducto (`productoId`, `carritoId`, `carritoProductoFechaAñadido`, `carritoProductoFechaActualizado`, `carritoProductoCantidad`, `carritoProductoTotal`, `carritoProductoActivo`) 
        VALUES (:productoId, :carritoId, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, :carritoProductoCantidad, :carritoProductoTotal, :carritoProductoActivo);";
        $parametros = array(
            "productoId" => intval($productoId),
            "carritoId" => intval($carritoId),
            "carritoProductoCantidad" => intval($carritoProductoCantidad),
            "carritoProductoTotal" => $carritoProductoTotal,
            "carritoProductoActivo" => $carritoProductoActivo
        );
        return self::executeNonQuery($sqlStr, $parametros);
    }
}

?>