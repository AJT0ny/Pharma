<?php

namespace Utilities;

class Nav
{

    public static function setNavContext()
    {
        $tmpNAVIGATION = array();
        $userID = \Utilities\Security::getUserId();

        if (\Utilities\Security::isAuthorized($userID, "WW_Usuarios")) {
            $tmpNAVIGATION[] = array(
                "nav_url" => "index.php?page=mnt_usuarios",
                "nav_label" => "Usuarios"
            );
        }
        if (\Utilities\Security::isAuthorized($userID, "WW_Roles")) {
            $tmpNAVIGATION[] = array(
                "nav_url" => "index.php?page=mnt_roles",
                "nav_label" => "Roles"
            );
        }
        if (\Utilities\Security::isAuthorized($userID, "WW_Funciones")) {
            $tmpNAVIGATION[] = array(
                "nav_url" => "index.php?page=mnt_funciones",
                "nav_label" => "Funciones"
            );
        }

        if (\Utilities\Security::isAuthorized($userID, "WW_Inventario")) {
            $tmpNAVIGATION[] = array(
                "nav_url" => "index.php?page=pharmamnt_inventarios",
                "nav_label" => "Inventario"
            );
        }

        if (\Utilities\Security::isAuthorized($userID, "WW_Productos")) {
            $tmpNAVIGATION[] = array(
                "nav_url" => "index.php?page=pharmamnt_productos",
                "nav_label" => "Productos"
            );
        }

        if (\Utilities\Security::isAuthorized($userID, "WW_Laboratorios")) {
            $tmpNAVIGATION[] = array(
                "nav_url" => "index.php?page=mnt_laboratorios",
                "nav_label" => "Laboratorios"
            );
        }
        if (\Utilities\Security::isAuthorized($userID, "WW_Presentaciones")) {
            $tmpNAVIGATION[] = array(
                "nav_url" => "index.php?page=mnt_presentaciones",
                "nav_label" => "Presentaciones"
            );
        }
        if (\Utilities\Security::isAuthorized($userID, "WW_Bitacora")) {
            $tmpNAVIGATION[] = array(
                "nav_url" => "index.php?page=pharmamnt_bitacoras",
                "nav_label" => "Gestion de Compras"
            );
        }

        \Utilities\Context::setContext("NAVIGATION", $tmpNAVIGATION);
    }


    private function __construct()
    {
    }
    private function __clone()
    {
    }
}
