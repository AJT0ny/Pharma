<?php

namespace Controllers\Mnt;

use Controllers\PrivateController;
use Views\Renderer;

class Laboratorio extends PrivateController
{

    private function badEnding()
    {
        \Utilities\Site::redirectToWithMsg("index.php?page=mnt_laboratorios", "Ocurrio algo inesperado. Intente nuevamente.");
    }

    private function goodEnding()
    {
        \Utilities\Site::redirectToWithMsg("index.php?page=mnt_laboratorios", "La operacion se realizo con exito.");
    }

    public function run() :void
    {
        $viewData = array(
            "mode_dsc"=>"",
            "mode"=>"",
            "laboratorioId"=>"",
            "laboratorioNombre"=>"",
            "laboratorioDescripcion"=>"",
            "hasErrors"=> false,
            "Errors"=> array(),
            "showaction"=> true,
            "readonly"=> ""
        );
    
        $modeDscArr = array(
            "INS" => "Nuevo Laboratorio",
            "UPD" => "Editando Laboratorio (%s) %s",
            "DEL" => "Eliminando Laboratorio (%s) %s",
            "DSP" => "Detalle de Laboratorio (%s) %s",
        );
    
        if ($this->isPostBack()){
            // Se ejecuta al dar click sobre guardar
            $viewData["mode"] = $_POST["mode"];
            $viewData["laboratorioId"] = $_POST["laboratorioId"];
            $viewData["laboratorioNombre"] = $_POST["laboratorioNombre"];
            $viewData["laboratorioDescripcion"] = $_POST["laboratorioDescripcion"];
            $viewData["xsrftoken"] = $_POST["xsrftoken"];

            if (!isset($_SESSION["xsrftoken"]) || $viewData["xsrftoken"] != $_SESSION["xsrftoken"]) {
                $this->badEnding();
            }
            //Validaciones de errores
    
            if(\Utilities\Validators::IsEmpty($viewData["laboratorioNombre"])){
                $viewData["hasErrors"] = true;
                $viewData["Errors"][] = "El nombre no puede estar vacio.";
            }

            if(\Utilities\Validators::IsEmpty($viewData["laboratorioDescripcion"])){
                $viewData["hasErrors"] = true;
                $viewData["Errors"][] = "La descripcion no puede estar vacia.";
            }
    
    
            if(!$viewData["hasErrors"]){
                switch($viewData["mode"]){
                    case "INS":
                        if (\Dao\Mnt\Laboratorios::crearLaboratorio(
                            $viewData["laboratorioNombre"],
                            $viewData["laboratorioDescripcion"]
                        )) {
                            $this->goodEnding();
                        }
                        break;
                    case "UPD":
                        if(\Dao\Mnt\Laboratorios::editarLaboratorio(
                            $viewData["laboratorioNombre"],
                            $viewData["laboratorioDescripcion"],
                            $viewData["laboratorioId"],
                        )
                        ){
                            $this->goodEnding();
                        }
                        break;
                    case "DEL":
                        if(\Dao\Mnt\Laboratorios::eliminarLaboratorio(
                            $viewData["laboratorioId"]
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

            if(isset($_GET["laboratorioId"])){
                $viewData["laboratorioId"] = $_GET["laboratorioId"];
            } else {
                if($viewData["mode"] !== "INS"){
                   $this->badEnding();
                }
            }
        }
    
        if($viewData["mode"] == "INS"){
            $viewData["mode_dsc"] = $modeDscArr["INS"];
        } else {
            $tmpUsuario = \Dao\Mnt\Laboratorios::obtenerLaboratorio($viewData["laboratorioId"]);
            $viewData["laboratorioNombre"] = $tmpUsuario["laboratorioNombre"];
            $viewData["laboratorioDescripcion"] = $tmpUsuario["laboratorioDescripcion"];
            $viewData["mode_dsc"] = sprintf(
                $modeDscArr[$viewData["mode"]],
                $viewData["laboratorioId"],
                $viewData["laboratorioNombre"]
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
    
        Renderer::render("mnt/laboratorio", $viewData);

    }

}
