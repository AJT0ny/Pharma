<?php

namespace Controllers\Mnt;

use Controllers\PublicController;
use Views\Renderer;

class UsuarioAccion extends PublicController
{

    private function badEnding()
    {
        \Utilities\Site::redirectToWithMsg("index.php?page=mnt_usuario", "Ocurrio algo inesperado. Intente nuevamente.");
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
            "rolescod" => "",
            "hasErrors"=> false,
            "Errors"=> array(),
            "showaction"=> true,
            "readonly"=> false
        );
    
        $modeDscArr = array(
            "DEL" => "Eliminando rol de usuario (%s): %s",
            "DSP" => "Detalle de rol de usuario (%s): %s",
        );
    
        if ($this->isPostBack()){
            // Se ejecuta al dar click sobre guardar
            $viewData["mode"] = $_POST["mode"];
            $viewData["usercod"] = $_POST["usercod"];
            $viewData["rolescod"] = $_POST["rolescod"];
            //Validaciones de errores
    
            if(!$viewData["hasErrors"]){
                switch($viewData["mode"]){
                    case "DEL":
                        if(\Dao\Security\Security::removeRolFromUser(
                            $viewData["usercod"],
                            $viewData["rolescod"]
                        )
                        ){
                            $this->goodEnding();
                        }
                    break;
                }
            }
    
        } else {
            if(isset($_GET["mode"])){
                if(!isset($modeDscArr[$_GET["mode"]])){
                    $this->badEnding();
                }
                $viewData["mode"] = $_GET["mode"];
            } else {
                $this->badEnding();
            }

            if(isset($_GET["usercod"]) && isset($_GET["rolescod"])){
                $viewData["usercod"] = $_GET["usercod"];
                $viewData["rolescod"] = $_GET["rolescod"];
            } else {
                $this->badEnding();
            }
        }

        $viewData["mode_dsc"] = sprintf(
            $modeDscArr[$viewData["mode"]],
            $viewData["usercod"],
            $viewData["rolescod"]
        );
            
        if ($viewData["mode"] == "DSP"){
            $viewData["showaction"] = false;
            $viewData["readonly"] = "readonly";
        }
            
        if ($viewData["mode"] == "DEL"){
            $viewData["readonly"] = "readonly";
        }
    
        Renderer::render("mnt/usuarioAccion", $viewData);

    }

}

?>