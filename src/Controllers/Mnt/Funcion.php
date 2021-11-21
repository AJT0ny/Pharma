<?php

namespace Controllers\Mnt;

use Controllers\PrivateController;

class Funcion extends PrivateController
{
    private function noFunc()
    {
        \Utilities\Site::redirectToWithMsg(
            "index.php?page=mnt_funciones",
            "Ocurrió algo inesperado. Intente Nuevamente."
        );
    }
    private function siFunc()
    {
        \Utilities\Site::redirectToWithMsg(
            "index.php?page=mnt_funciones",
            "Operación ejecutada Satisfactoriamente!"
        );
    }
    public function run(): void
    {
        $viewData = array(
            "mode_dsc" => "",
            "mode" => "",
            "fncod" => "",
            "fndsc" => "",
            "fnest_ACT" => "",
            "fnest_INA" => "",
            "fntyp_CTR" => "",
            "fntyp_PLN" => "",
            "hasErrors" => false,
            "Errors" => array(),
            "showaction" => true,
            "readonly" => false
        );
        $modeDscArr = array(
            "INS" => "Nueva Funcion",
            "UPD" => "Editando Funcion (%s) %s",
            "DEL" => "Eliminando Funcion (%s) %s",
            "DSP" => "Detalle de Funcion (%s) %s"
        );

        if ($this->isPostBack()) {
            // se ejecuta al dar click sobre guardar
            $viewData["mode"] = $_POST["mode"];
            $viewData["fncod"] = $_POST["fncod"];
            $viewData["fndsc"] = $_POST["fndsc"];
            $viewData["fnest"] = $_POST["fnest"];
            $viewData["fntyp"] = $_POST["fntyp"];
            $viewData["xsrftoken"] = $_POST["xsrftoken"];
            // Validacion XRFS Token
            if (!isset($_SESSION["xsrftoken"]) || $viewData["xsrftoken"] != $_SESSION["xsrftoken"]) {
                $this->noFunc();
            }
            // Validaciones de Errores
            if ($viewData["mode"] !== "DEL") {
                if (\Utilities\Validators::IsEmpty($viewData["fncod"])) {
                    $viewData["hasErrors"] = true;
                    $viewData["Errors"][] = "La descripcion no puede Ir Vacia!";
                }
                if (\Utilities\Validators::IsEmpty($viewData["fndsc"])) {
                    $viewData["hasErrors"] = true;
                    $viewData["Errors"][] = "La descripcion no puede Ir Vacia!";
                }
                if (($viewData["fnest"] == "INA"
                        || $viewData["fnest"] == "ACT") == false
                ) {
                    $viewData["hasErrors"] = true;
                    $viewData["Errors"][] = "El estado no puede Ir Vacio!";
                }
                if (($viewData["fntyp"] == "CTR"
                        || $viewData["fntyp"] == "PLN") == false
                ) {
                    $viewData["hasErrors"] = true;
                    $viewData["Errors"][] = "El Tipo no puede Ir Vacio!";
                }
            } else {
                if (\Utilities\Validators::IsEmpty($viewData["fncod"])) {
                    $viewData["hasErrors"] = true;
                    $viewData["Errors"][] = "La descripcion no puede Ir Vacia!";
                }
                if (\Utilities\Validators::IsEmpty($viewData["fndsc"])) {
                    $viewData["hasErrors"] = true;
                    $viewData["Errors"][] = "La descripcion no puede Ir Vacia!";
                }
            }

            if (!$viewData["hasErrors"]) {
                switch ($viewData["mode"]) {
                    case "INS":
                        if (\Dao\Security\Security::addNewFeature(
                            $viewData["fncod"],
                            $viewData["fndsc"],
                            $viewData["fnest"],
                            $viewData["fntyp"]
                        )) {
                            $this->siFunc();
                        }
                        break;
                    case "UPD":
                        if (\Dao\Security\Security::editFeature(
                            $viewData["fndsc"],
                            $viewData["fnest"],
                            $viewData["fntyp"],
                            $viewData["fncod"]
                        )) {
                            $this->siFunc();
                        }
                        break;
                    case "DEL":
                        if (\Dao\Security\Security::DeleteFeature(
                            $viewData["fncod"]
                        )) {
                            $this->siFunc();
                        }
                        break;
                }
            }
        } else {
            // se ejecuta si se refresca o viene la peticion
            // desde la lista
            if (isset($_GET["mode"])) {
                if (!isset($modeDscArr[$_GET["mode"]])) {
                    $this->noFunc();
                }
                $viewData["mode"] = $_GET["mode"];
            } else {
                $this->noFunc();
            }
            if (isset($_GET["fncod"])) {
                $viewData["fncod"] = $_GET["fncod"];
            } else {
                if ($viewData["mode"] !== "INS") {
                    $this->noFunc();
                }
            }
        }

        // Hacer elementos en comun

        if ($viewData["mode"] == "INS") {
            $viewData["mode_dsc"]  = $modeDscArr["INS"];
        } else {
            $tmpFuncion = \Dao\Security\Security::getFeature($viewData["fncod"]);
            $viewData["fndsc"] = $tmpFuncion["fndsc"];
            $viewData["fnest_ACT"] = $tmpFuncion["fnest"] == "ACT" ? "selected" : "";
            $viewData["fnest_INA"] = $tmpFuncion["fnest"] == "INA" ? "selected" : "";
            $viewData["fntyp_CTR"] = $tmpFuncion["fntyp"] == "CTR" ? "selected" : "";
            $viewData["fntyp_PLN"] = $tmpFuncion["fntyp"] == "PLN" ? "selected" : "";
            $viewData["mode_dsc"]  = sprintf(
                $modeDscArr[$viewData["mode"]],
                $viewData["fncod"],
                $viewData["fndsc"]
            );
            if ($viewData["mode"] == "DSP") {
                $viewData["showaction"] = false;
                $viewData["readonly"] = "readonly";
            }
            if ($viewData["mode"] == "DEL") {
                $viewData["readonly"] = "readonly";
            }
        }
        //Generar un token XSRF para evitar esos ataques
        $viewData["xsrftoken"] = md5("funcion" . random_int(10000, 99999));
        $_SESSION["xsrftoken"] = $viewData["xsrftoken"];

        \Views\Renderer::render("mnt/funcion", $viewData);
    }
}
