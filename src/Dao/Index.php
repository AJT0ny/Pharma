<?php
namespace Dao;

use Dao\Table;

class Index extends Table
{
    public static function productosRecientes()
    {
        $limitN = 4;
        $sqlStr = "SELECT * FROM producto ORDER BY productoId DESC LIMIT :limitN;";
        $parametros= array(
            "limitN" => $limitN
        );
        return self::obtenerRegistros($sqlStr, $parametros);
    }
}

?>
