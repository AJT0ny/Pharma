<?php

namespace Controllers\Mnt;

use Controllers\PublicController;

class AddRol extends PublicController{

    /*
    Se intento hacer el añadir rol a usuario, pero la unica informacion que se podia mandar era el "usercod" a traves del get.
    Pensamos en alguna forma de traer la informacion del rol solicitado, pero no encontramos alguna sin pensar en hacer una nueva view.
    */

    private function badEnding()
    {
        \Utilities\Site::redirectToWithMsg("index.php?page=mnt_usuarios", "Ocurrio algo inesperado. Intente nuevamente.");
    }

    private function goodEnding()
    {
        \Utilities\Site::redirectToWithMsg("index.php?page=mnt_usuarios", "La operacion se realizo con exito.");
    }

    public function run():void
    {
        $viewData = array(
            "usercod" => "",
            "rolescod" => "",
            "roleuserest" => ""
        );
        
        $viewData["role"] = \Dao\Security\Security::getRoles();
        $viewData["FONT_AWESOME_KIT"] = "dc88af8176";

        if ($this->isPostBack()){
            /*
            $viewData["usercod"] = $_POST["usercod"];
            $viewData["rolescod"] = $_POST["useremail"];
            $viewData["roleuserest"] = $_POST["roleuserest"];
            $viewData["xsrftoken"] = $_POST["xsrftoken"];
            

            if (!isset($_SESSION["xsrftoken"]) || $viewData["xsrftoken"] != $_SESSION["xsrftoken"]) {
                $this->badEnding();
            }

            if(\Dao\Security\Security::addRolToUsuario(
                $viewData["usercod"],
                $viewData["rolescod"],
                $viewData["roleuserest"],
            )
            ){
                $this->goodEnding();
            }
            */

            $this->goodEnding();

        }else{
            if(isset($_GET["usercod"])){
                $viewData["usercod"] = $_GET["usercod"];
            }
        }

        $tmpRol = \Dao\Security\Security::getRol($viewData["rolescod"]);
        $viewData["roleuserest"] = $tmpRol["roleuserest"];
        
        /*
        $viewData["xsrftoken"] = md5($this->name . random_int(10000, 99999));
        $_SESSION["xsrftoken"] = $viewData["xsrftoken"];
        */

        \Views\Renderer::render("mnt/addRol", $viewData);
    }
}

?>