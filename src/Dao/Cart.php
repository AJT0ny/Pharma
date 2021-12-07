<?php

namespace Dao;

use Dao\Table;

class Cart extends Table
{
    public static function getCarritoId($userId)
    {
        $sqlStr = "SELECT carritoId FROM carrito WHERE usuario_usercod = :userId;";
        $parametros = array(
            "userId" => $userId
        );
        return self::obtenerUnRegistro($sqlStr, $parametros);
    }

    public static function countProductosEnCarrito($carritoId)
    {
        $sqlStr = "SELECT COUNT(carritoProductoId) AS numeroDeProductos FROM carritoproducto WHERE carritoId = :carritoId;";
        $parametros = array(
            "carritoId" => $carritoId
        );
        return self::obtenerUnRegistro($sqlStr, $parametros);
    }

    public static function obtenerProductosEnCarrito($carritoId)
    {
        $sqlStr = "SELECT * from carritoproducto a 
        inner join carrito b on a.carritoId = b.carritoId
        inner join producto c on a.productoId = c.productoId 
        where b.carritoId=:carritoId;";
        $parametros = array(
            "carritoId" => $carritoId
        );
        return self::obtenerRegistros($sqlStr, $parametros);
    }

    public static function sumProductos($carritoId)
    {
        $sqlStr = "SELECT ROUND(SUM(`carritoProductoTotal`), 2) AS sumaProductos
        FROM carritoproducto
        WHERE carritoId = :carritoId;";
        $parametros = array(
            "carritoId" => $carritoId
        );
        return self::obtenerUnRegistro($sqlStr, $parametros);
    }

    public static function getOrdenes($usuario_usercod)
    {
        $sqlStr = "SELECT COUNT(ordenId) AS ordenExiste FROM orden WHERE usuario_usercod = :usuario_usercod;";
        return self::obtenerUnRegistro($sqlStr, array("usuario_usercod" =>$usuario_usercod));
    }

    public static function getOrdenId($usuario_usercod)
    {
        $sqlStr = "SELECT ordenId FROM orden WHERE usuario_usercod=:usuario_usercod;";
        return self::obtenerUnRegistro($sqlStr, array("usuario_usercod" => $usuario_usercod));
    }

    public static function agregarOrden($usuarioId, $ordenEstado, $ordenSubtotal, $ordenDescuento, $ordenImpuestos, $ordenTotal, $usuario_usercod)
    {
        $sqlStr = "INSERT INTO orden (`usuarioId`,`ordenEstado`,`ordenSubtotal`,`ordenDescuento`,`ordenImpuestos`,`ordenTotal`,`ordenCreadoEl`,`ordenActualizadoEl`,`usuario_usercod`)
        VALUES (:usuarioId , :ordenEstado, :ordenSubtotal, :ordenDescuento, :ordenImpuestos, :ordenTotal, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, :usuario_usercod);";
        $parametros = array(
            "usuarioId" => $usuarioId,
            "ordenEstado" => $ordenEstado,
            "ordenSubtotal" => $ordenSubtotal,
            "ordenDescuento" => $ordenDescuento,
            "ordenImpuestos" => $ordenImpuestos,
            "ordenTotal" => $ordenTotal,
            "usuario_usercod" => intval($usuario_usercod),
        );
        return self::executeNonQuery($sqlStr, $parametros);
    }

    public static function agregarProductoAOrden($productoId, $ordenId, $ordenProductoCantidad, $ordenProductoTotal)
    {
        $sqlStr = "INSERT INTO ordenproducto (`productoId`, `ordenId`, `ordenProductoCantidad`, `ordenProductoTotal`)
        VALUES (:productoId, :ordenId, :ordenProductoCantidad, :ordenProductoTotal);";
        $parametros = array(
            "productoId" => $productoId,
            "ordenId" => $ordenId,
            "ordenProductoCantidad" => $ordenProductoCantidad,
            "ordenProductoTotal" => $ordenProductoTotal
        );
        return self::executeNonQuery($sqlStr, $parametros);
    }
}

?>