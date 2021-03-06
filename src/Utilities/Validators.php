<?php

namespace Utilities;

class Validators {

    static public function IsEmpty($valor)
    {
        return preg_match("/^\s*$/", $valor) && true;
    }

    static public function IsValidUsername($valor)
    {
        return preg_match("/^[A-Z]{1}[a-z]{2,15}\s[A-Z]{1}[a-z]{2,15}$/", $valor) && true;
    }

    static public function IsValidEmail($valor)
    {
        return preg_match("/^([a-z0-9_\.-]+\@[\da-z\.-]+\.[a-z\.]{2,6})$/", $valor) && true;
    }

    static public function IsValidPassword($valor){
        return preg_match("/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[^\w\d\s:])([^\s]){8,32}$/", $valor) && true;
    }

    static public function MatchesRegex($regex, $valor) {
        return preg_match($regex, $valor);
    }

    private function __construct()
    {
        
    }
    private function __clone()
    {
        
    }
}

?>
