<?php

namespace Controllers\Mnt;

use Controllers\PrivateController;
use Views\Renderer;

class presentacion extends PrivateController
{

    private function badEnding()
    {
        \Utilities\Site::redirectToWithMsg("index.php?page=mnt_presentaciones", "Ocurrio algo inesperado. Intente nuevamente.");
    }

    private function goodEnding()
    {
        \Utilities\Site::redirectToWithMsg("index.php?page=mnt_presentaciones", "La operacion se realizo con exito.");
    }

    public function run() :void
    {
        \Utilities\Site::addLink("public/css/Mantenimientos.css");

        $viewData = array(
            "mode_dsc"=>"",
            "mode"=>"",
            "presentacionId"=>"",
            "presentacionNombre"=>"",
            "presentacionDescripcion"=>"",
            "hasErrors"=> false,
            "Errors"=> array(),
            "showaction"=> true,
            "readonly"=> ""
        );
    
        $modeDscArr = array(
            "INS" => "Nueva Presentacion",
            "UPD" => "Editando Presentacion (%s) %s",
            "DEL" => "Eliminando Presentacion (%s) %s",
            "DSP" => "Detalle de Presentacion (%s) %s",
        );
    
        if ($this->isPostBack()){
            // Se ejecuta al dar click sobre guardar
            $viewData["mode"] = $_POST["mode"];
            $viewData["presentacionId"] = $_POST["presentacionId"];
            $viewData["presentacionNombre"] = $_POST["presentacionNombre"];
            $viewData["presentacionDescripcion"] = $_POST["presentacionDescripcion"];
            $viewData["xsrftoken"] = $_POST["xsrftoken"];

            if (!isset($_SESSION["xsrftoken"]) || $viewData["xsrftoken"] != $_SESSION["xsrftoken"]) {
                $this->badEnding();
            }
            //Validaciones de errores
    
            if(\Utilities\Validators::IsEmpty($viewData["presentacionNombre"])){
                $viewData["hasErrors"] = true;
                $viewData["Errors"][] = "El nombre no puede estar vacio.";
            }

            if(\Utilities\Validators::IsEmpty($viewData["presentacionDescripcion"])){
                $viewData["hasErrors"] = true;
                $viewData["Errors"][] = "La descripcion no puede estar vacia.";
            }
    
    
            if(!$viewData["hasErrors"]){
                switch($viewData["mode"]){
                    case "INS":
                        if (\Dao\Mnt\Presentaciones::crearPresentacion(
                            $viewData["presentacionNombre"],
                            $viewData["presentacionDescripcion"]
                        )) {
                            $this->goodEnding();
                        }
                        break;
                    case "UPD":
                        if(\Dao\Mnt\Presentaciones::editarPresentacion(
                            $viewData["presentacionNombre"],
                            $viewData["presentacionDescripcion"],
                            $viewData["presentacionId"],
                        )
                        ){
                            $this->goodEnding();
                        }
                        break;
                    case "DEL":
                        if(\Dao\Mnt\Presentaciones::eliminarPresentacion(
                            $viewData["presentacionId"]
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

            if(isset($_GET["presentacionId"])){
                $viewData["presentacionId"] = $_GET["presentacionId"];
            } else {
                if($viewData["mode"] !== "INS"){
                   $this->badEnding();
                }
            }
        }
    
        if($viewData["mode"] == "INS"){
            $viewData["mode_dsc"] = $modeDscArr["INS"];
        } else {
            $tmpUsuario = \Dao\Mnt\Presentaciones::obtenerPresentacion($viewData["presentacionId"]);
            $viewData["presentacionNombre"] = $tmpUsuario["presentacionNombre"];
            $viewData["presentacionDescripcion"] = $tmpUsuario["presentacionDescripcion"];
            $viewData["mode_dsc"] = sprintf(
                $modeDscArr[$viewData["mode"]],
                $viewData["presentacionId"],
                $viewData["presentacionNombre"]
            );
            if ($viewData["mode"] == "DSP"){
                $viewData["showaction"] = false;
                $viewData["readonly"] = "readonly";
            }
            if ($viewData["mode"] == "DEL"){
                $viewData["readonly"] = "readonly";
            }

            $viewData["xsrftoken"] = md5($this->name . random_int(10000, 99999));
            $_SESSION["xsrftoken"] = $viewData["xsrftoken"];
        }
    
        Renderer::render("mnt/presentacion", $viewData);

    }

}
