<?php

namespace Dao\Security;

if (version_compare(phpversion(), '7.4.0', '<')) {
    define('PASSWORD_ALGORITHM', 1);  //BCRYPT
} else {
    define('PASSWORD_ALGORITHM', '2y');  //BCRYPT
}
/*
usercod     bigint(10) AI PK
useremail   varchar(80)
username    varchar(80)
userpswd    varchar(128)
userfching  datetime
userpswdest char(3)
userpswdexp datetime
userest     char(3)
useractcod  varchar(128)
userpswdchg varchar(128)
usertipo    char(3)

 */

use Exception;

class Security extends \Dao\Table
{
    static public function getUsuarios($filter = "", $page = -1, $items = 0)
    {
        $sqlstr = "";
        if ($filter == "" && $page == -1 && $items == 0) {
            $sqlstr = "SELECT * FROM usuario;";
        } else {
            //TODO: Terminar consultas FACET
            if ($page = -1 and $items = 0) {
                $sqlstr = sprintf("SELECT * FROM usuarios %s;", $filter);
            } else {
                $offset = ($page - 1 * $items);
                $sqlstr = sprintf(
                    "SELECT * FROM usuarios %s limit %d, %d;",
                    $filter,
                    $offset,
                    $items
                );
            }
        }
        return self::obtenerRegistros($sqlstr, array());
    }

    static public function getUsuario($userCod)
    {
        $sqlStr = "SELECT * FROM usuario WHERE usercod=:userCod;";
        $parametros = array(
            "userCod" => intval($userCod)
        );
        return self::obtenerUnRegistro($sqlStr, $parametros);
    }

    static public function newUsuario($username, $email, $password)
    {
        if (!\Utilities\Validators::IsValidUsername($username)) {
            throw new Exception("Usuario no es válido");
        }
        if (!\Utilities\Validators::IsValidEmail($email)) {
            throw new Exception("Correo no es válido");
        }
        if (!\Utilities\Validators::IsValidPassword($password)) {
            throw new Exception("Contraseña debe ser almenos 8 caracteres, 1 número, 1 mayúscula, 1 símbolo especial");
        }

        $newUser = self::_usuarioStruct();
        //Tratamiento de la Contraseña
        $hashedPassword = self::_hashPassword($password);

        unset($newUser["usercod"]);
        unset($newUser["userfching"]);
        unset($newUser["userpswdchg"]);

        $newUser["useremail"] = $email;
        $newUser["username"] = $username;
        $newUser["userpswd"] = $hashedPassword;
        $newUser["userpswdest"] = Estados::ACTIVO;
        $newUser["userpswdexp"] = date('Y-m-d', time() + 7776000);  //(3*30*24*60*60) (m d h mi s)
        $newUser["userest"] = Estados::ACTIVO;
        $newUser["useractcod"] = hash("sha256", $email . time());
        $newUser["usertipo"] = UsuarioTipo::PUBLICO;

        $sqlIns = "INSERT INTO `usuario` (`useremail`, `username`, `userpswd`,
            `userfching`, `userpswdest`, `userpswdexp`, `userest`, `useractcod`,
            `userpswdchg`, `usertipo`)
            VALUES
            ( :useremail, :username, :userpswd,
            now(), :userpswdest, :userpswdexp, :userest, :useractcod,
            now(), :usertipo);";

        return self::executeNonQuery($sqlIns, $newUser);
    }

    static public function editUsuario($useremail, $userest, $usercod)
    {
        $sqlStr = "UPDATE usuario SET useremail=:useremail, userest=:userest WHERE usercod=:usercod;";
        $parametros = array(
            "useremail" => $useremail,
            "userest" => $userest,
            "usercod" => intval($usercod)
        );
        return self::executeNonQuery($sqlStr, $parametros);
    }

    static public function deleteUsuario($userCod)
    {
        $sqlStr = "DELETE FROM usuario WHERE usercod=:userCod;";
        $parametros = array(
            "userCod" => intval($userCod)
        );
        return self::executeNonQuery($sqlStr, $parametros);
    }

    static public function getUsuarioByEmail($email)
    {
        $sqlstr = "SELECT * from `usuario` where `useremail` = :useremail ;";
        $params = array("useremail" => $email);

        return self::obtenerUnRegistro($sqlstr, $params);
    }

    static private function _saltPassword($password)
    {
        return hash_hmac(
            "sha256",
            $password,
            \Utilities\Context::getContextByKey("PWD_HASH")
        );
    }

    static private function _hashPassword($password)
    {
        return password_hash(self::_saltPassword($password), PASSWORD_ALGORITHM);
    }

    static public function verifyPassword($raw_password, $hash_password)
    {
        return password_verify(
            self::_saltPassword($raw_password),
            $hash_password
        );
    }


    static private function _usuarioStruct()
    {
        return array(
            "usercod"      => "",
            "useremail"    => "",
            "username"     => "",
            "userpswd"     => "",
            "userfching"   => "",
            "userpswdest"  => "",
            "userpswdexp"  => "",
            "userest"      => "",
            "useractcod"   => "",
            "userpswdchg"  => "",
            "usertipo"     => "",
        );
    }

    public static function getFeatures()
    {
        $sqlStr = "SELECT * from funciones;";
        return self::obtenerRegistros($sqlStr, array());
    }

    static public function getFeature($fncod)
    {
        $sqlstr = "SELECT * from funciones where fncod=:fncod;";
        return self::obtenerUnRegistro($sqlstr, array("fncod" => $fncod));
    }

    static public function addNewFeature($fncod, $fndsc, $fnest, $fntyp)
    {
        $sqlins = "INSERT INTO `funciones` (`fncod`, `fndsc`, `fnest`, `fntyp`)
            VALUES (:fncod , :fndsc , :fnest , :fntyp );";

        return self::executeNonQuery(
            $sqlins,
            array(
                "fncod" => $fncod,
                "fndsc" => $fndsc,
                "fnest" => $fnest,
                "fntyp" => $fntyp
            )
        );
    }

    public static function editFeature($fndsc, $fnest, $fntyp, $fncod)
    {
        $sqlstr = "UPDATE funciones set fndsc=:fndsc, fnest=:fnest, fntyp=:fntyp where fncod = :fncod;";
        $parametros = array(
            "fndsc" => $fndsc,
            "fnest" =>  $fnest,
            "fntyp" =>  $fntyp,
            "fncod" => $fncod
        );
        return self::executeNonQuery($sqlstr, $parametros);
    }

    public static function DeleteFeature($fncod)
    {
        $sqlstr = "DELETE FROM funciones where fncod=:fncod;";
        $parametros = array(
            "fncod" => $fncod
        );
        return self::executeNonQuery($sqlstr, $parametros);
    }

    static public function getFeatureByUsuario($userCod, $fncod)
    {
        $sqlstr = "select * from
        funciones_roles a inner join roles_usuarios b on a.rolescod = b.rolescod
        where a.fnrolest = 'ACT' and b.roleuserest='ACT' and b.usercod=:usercod
        and a.fncod=:fncod limit 1;";
        $resultados = self::obtenerRegistros(
            $sqlstr,
            array(
                "usercod" => $userCod,
                "fncod" => $fncod
            )
        );
        return count($resultados) > 0;
    }
    public static function getRols()
    {
        $sqlStr = "SELECT * from roles;";
        return self::obtenerRegistros($sqlStr, array());
    }
    static public function getRol($rolescod)
    {
        $sqlstr = "SELECT * from roles where rolescod=:rolescod;";
        return self::obtenerUnRegistro($sqlstr, array("rolescod" => $rolescod));
    }

    static public function addNewRol($rolescod, $rolesdsc, $rolesest)
    {
        $sqlins = "INSERT INTO `roles` (`rolescod`, `rolesdsc`, `rolesest`)
        VALUES (:rolescod, :rolesdsc, :rolesest);";

        return self::executeNonQuery(
            $sqlins,
            array(
                "rolescod" => $rolescod,
                "rolesdsc" => $rolesdsc,
                "rolesest" => $rolesest
            )
        );
    }

    public static function editRol($rolesdsc, $rolesest, $rolescod)
    {
        $sqlstr = "UPDATE roles set rolesdsc=:rolesdsc, rolesest=:rolesest where rolescod = :rolescod;";
        $parametros = array(
            "rolesdsc" => $rolesdsc,
            "rolesest" =>  $rolesest,
            "rolescod" => $rolescod
        );
        return self::executeNonQuery($sqlstr, $parametros);
    }

    public static function DeleteRol($rolescod)
    {
        $sqlstr = "DELETE FROM roles where rolescod=:rolescod;";
        $parametros = array(
            "rolescod" => $rolescod
        );
        return self::executeNonQuery($sqlstr, $parametros);
    }

    static public function addRolToUsuario($usercod, $rolescod, $roleuserest)
    {
        $sqlstr = "INSERT INTO roles_usuarios (usercod, rolescod, roleuserest, roleuserfch, roleuserexp) 
        VALUES (:usercod, :rolescod, :roleuserest, CURRENT_TIMESTAMP, '2031-12-03 20:00:00');";
        $parametros = array(
            "usercod" => intval($usercod),
            "rolescod" => $rolescod,
            "roleuserest" => $roleuserest
        );
        return self::executeNonQuery($sqlstr, $parametros);
    }

    static public function isUsuarioInRol($userCod, $rolescod)
    {
        $sqlstr = "select * from roles a inner join
        roles_usuarios b on a.rolescod = b.rolescod where a.rolesest = 'ACT'
        and b.usercod=:usercod and a.rolescod=:rolescod limit 1;";
        $resultados = self::obtenerRegistros(
            $sqlstr,
            array(
                "usercod" => $userCod,
                "rolescod" => $rolescod
            )
        );
        return count($resultados) > 0;
    }

    static public function getRoles()
    {
        $sqlstr = "SELECT * FROM roles;";
        return self::obtenerRegistros($sqlstr, array());
    }

    static public function getRolesByUsuario($userCod)
    {
        $sqlstr = "select * from roles a inner join
        roles_usuarios b on a.rolescod = b.rolescod where b.roleuserest = 'ACT'
        and b.usercod=:usercod;";
        $resultados = self::obtenerRegistros(
            $sqlstr,
            array(
                "usercod" => $userCod
            )
        );
        return $resultados;
    }

    static public function removeRolFromUser($userCod, $rolescod)
    {
        $sqldel = "UPDATE roles_usuarios set roleuserest='INA' 
        where rolescod=:rolescod and usercod=:usercod;";
        return self::executeNonQuery(
            $sqldel,
            array("rolescod" => $rolescod, "usercod" => $userCod)
        );
    }

    static public function removeFeatureFromRol($fncod, $rolescod)
    {
        $sqldel = "UPDATE funciones_roles set roleuserest='INA'
        where fncod=:fncod and rolescod=:rolescod;";
        return self::executeNonQuery(
            $sqldel,
            array("fncod" => $fncod, "rolescod" => $rolescod)
        );
    }
    static public function getUnAssignedFeatures($rolescod)
    {
    }
    static public function getUnAssignedRoles($userCod)
    {
    }
    private function __construct()
    {
    }
    private function __clone()
    {
    }
}
