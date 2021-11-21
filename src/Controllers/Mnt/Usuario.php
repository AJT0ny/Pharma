<?php

namespace Controllers\Mnt;

use Controllers\PrivateController;
use Views\Renderer;

class Usuario extends PrivateController
{

    private function badEnding()
    {
        \Utilities\Site::redirectToWithMsg("index.php?page=mnt_usuarios", "Ocurrio algo inesperado. Intente nuevamente.");
    }

    private function goodEnding()
    {
        \Utilities\Site::redirectToWithMsg("index.php?page=mnt_usuarios", "La operacion se realizo con exito.");
    }

    public function run() :void
    {
        $viewData = array(
            "mode_dsc"=>"",
            "mode"=>"",
            "usercod"=>"",
            "useremail"=>"",
            "userest_ACT"=>"",
            "userest_INA"=>"",
            "userest_PLN"=>"",
            "hasErrors"=> false,
            "Errors"=> array(),
            "showaction"=> true,
            "readonly"=> ""
        );
    
        $modeDscArr = array(
            "INS" => "Nuevo Usuario",
            "UPD" => "Editando Usuario (%s) %s",
            "DEL" => "Eliminando Usuario (%s) %s",
            "DSP" => "Detalle de Usuario (%s) %s",
        );
    
        if ($this->isPostBack()){
            // Se ejecuta al dar click sobre guardar
            $viewData["mode"] = $_POST["mode"];
            $viewData["usercod"] = $_POST["usercod"];
            $viewData["useremail"] = $_POST["useremail"];
            $viewData["userest"] = $_POST["userest"];
            $viewData["xsrftoken"] = $_POST["xsrftoken"];

            if (!isset($_SESSION["xsrftoken"]) || $viewData["xsrftoken"] != $_SESSION["xsrftoken"]) {
                $this->badEnding();
            }
            //Validaciones de errores
    
            if(\Utilities\Validators::IsEmpty($viewData["useremail"])){
                $viewData["hasErrors"] = true;
                $viewData["Errors"][] = "El mail no puede estar vacio.";
            }
    
    
            if(!$viewData["hasErrors"]){
                switch($viewData["mode"]){
                    case "UPD":
                        if(\Dao\Security\Security::editUsuario(
                            $viewData["useremail"],
                            $viewData["userest"],
                            $viewData["usercod"],
                        )
                        ){
                            $this->goodEnding();
                        }
                        if (($viewData["userest"] == "INA"
                            || $viewData["userest"] == "ACT"
                            || $viewData["userest"] == "PLN"
                            ) == false
                            ) {
                                $viewData["hasErrors"] = true;
                                $viewData["Errors"][] = "Estado de usuario incorrecto.";
                            }
                        break;
                    case "DEL":
                        if(\Dao\Security\Security::deleteUsuario(
                            $viewData["usercod"]
                        )
                        ){
                            $this->goodEnding();
                        }
                        break;
                }
            }
    
        } else {
            // Se ejecuta si se refresca o viene la peticion
            // desde la lista
            if(isset($_GET["mode"])){
                if(!isset($modeDscArr[$_GET["mode"]])){
                    $this->badEnding();
                }
                $viewData["mode"] = $_GET["mode"];
            } else {
                $this->badEnding();
            }

            if(isset($_GET["usercod"])){
                $viewData["usercod"] = $_GET["usercod"];
            } else {
                if($viewData["mode"] !== "INS"){
                   $this->badEnding();
                }
            }
        }
    
        if($viewData["mode"] == "INS"){
            $viewData["mode_dsc"] = $modeDscArr["INS"];
        } else {
            $tmpUsuario = \Dao\Security\Security::getUsuario($viewData["usercod"]);
            $viewData["role"] = \Dao\Security\Security::getRolesByUsuario($viewData["usercod"]);
            $viewData["useremail"] = $tmpUsuario["useremail"];
            $viewData["userest_ACT"] = $tmpUsuario["userest"] == "ACT" ? "selected" : "";
            $viewData["userest_INA"] = $tmpUsuario["userest"] == "INA" ? "selected" : "";
            $viewData["userest_PLN"] = $tmpUsuario["userest"] == "PLN" ? "selected" : "";
            $viewData["mode_dsc"] = sprintf(
                $modeDscArr[$viewData["mode"]],
                $viewData["usercod"],
                $viewData["useremail"]
            );
            if ($viewData["mode"] == "DSP"){
                $viewData["showaction"] = false;
                $viewData["readonly"] = "readonly";
            }
            if($viewData["mode"] == "UPD"){
                $viewData["showaction"] = true;
                $viewData["canDelete"] = true;
            }
            if ($viewData["mode"] == "DEL"){
                $viewData["readonly"] = "readonly";
            }

            $viewData["xsrftoken"] = md5($this->name . random_int(10000, 99999));
            $_SESSION["xsrftoken"] = $viewData["xsrftoken"];
        }
    
        Renderer::render("mnt/usuario", $viewData);

    }

}
