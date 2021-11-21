<?php

namespace Controllers\Mnt;

use Controllers\PrivateController;

class Rol extends PrivateController
{
    private function noFunc()
    {
        \Utilities\Site::redirectToWithMsg(
            "index.php?page=mnt_roles",
            "Ocurrió algo inesperado. Intente Nuevamente."
        );
    }
    private function siFunc()
    {
        \Utilities\Site::redirectToWithMsg(
            "index.php?page=mnt_roles",
            "Operación ejecutada Satisfactoriamente!"
        );
    }
    public function run(): void
    {
        $viewData = array(
            "mode_dsc" => "",
            "mode" => "",
            "rolescod" => "",
            "rolesdsc" => "",
            "rolesest_ACT" => "",
            "rolesest_INA" => "",
            "hasErrors" => false,
            "Errors" => array(),
            "showaction" => true,
            "readonly" => false
        );
        $modeDscArr = array(
            "INS" => "Nuevo Rol",
            "UPD" => "Editando Rol (%s) %s",
            "DEL" => "Eliminando Rol (%s) %s",
            "DSP" => "Detalle de Rol (%s) %s"
        );

        if ($this->isPostBack()) {
            // se ejecuta al dar click sobre guardar
            $viewData["mode"] = $_POST["mode"];
            $viewData["rolescod"] = $_POST["rolescod"];
            $viewData["rolesdsc"] = $_POST["rolesdsc"];
            $viewData["rolesest"] = $_POST["rolesest"];
            $viewData["xsrftoken"] = $_POST["xsrftoken"];
            // Validacion XRFS Token
            if (!isset($_SESSION["xsrftoken"]) || $viewData["xsrftoken"] != $_SESSION["xsrftoken"]) {
                $this->noFunc();
            }
            // Validaciones de Errores
            if ($viewData["mode"] !== "DEL") {
                if (\Utilities\Validators::IsEmpty($viewData["rolescod"])) {
                    $viewData["hasErrors"] = true;
                    $viewData["Errors"][] = "El codigo no puede Ir Vacia!";
                }
                if (\Utilities\Validators::IsEmpty($viewData["rolesdsc"])) {
                    $viewData["hasErrors"] = true;
                    $viewData["Errors"][] = "La descripcion no puede Ir Vacia!";
                }
                if (($viewData["rolesest"] == "INA"
                        || $viewData["rolesest"] == "ACT") == false
                ) {
                    $viewData["hasErrors"] = true;
                    $viewData["Errors"][] = "El estado no puede Ir Vacio!";
                }
            } else {
                if (\Utilities\Validators::IsEmpty($viewData["rolescod"])) {
                    $viewData["hasErrors"] = true;
                    $viewData["Errors"][] = "El codigo no puede Ir Vacia!";
                }
                if (\Utilities\Validators::IsEmpty($viewData["rolesdsc"])) {
                    $viewData["hasErrors"] = true;
                    $viewData["Errors"][] = "La descripcion no puede Ir Vacia!";
                }
            }
            if (!$viewData["hasErrors"]) {
                switch ($viewData["mode"]) {
                    case "INS":
                        if (\Dao\Security\Security::addNewRol(
                            $viewData["rolescod"],
                            $viewData["rolesdsc"],
                            $viewData["rolesest"]
                        )) {
                            $this->siFunc();
                        }
                        break;
                    case "UPD":
                        if (\Dao\Security\Security::editRol(
                            $viewData["rolesdsc"],
                            $viewData["rolesest"],
                            $viewData["rolescod"]
                        )) {
                            $this->siFunc();
                        }
                        break;
                    case "DEL":
                        if (\Dao\Security\Security::DeleteRol(
                            $viewData["rolescod"]
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
            if (isset($_GET["rolescod"])) {
                $viewData["rolescod"] = $_GET["rolescod"];
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
            $tmpRol = \Dao\Security\Security::getRol($viewData["rolescod"]);
            $viewData["rolesdsc"] = $tmpRol["rolesdsc"];
            $viewData["rolesest_ACT"] = $tmpRol["rolesest"] == "ACT" ? "selected" : "";
            $viewData["rolesest_INA"] = $tmpRol["rolesest"] == "INA" ? "selected" : "";
            $viewData["mode_dsc"]  = sprintf(
                $modeDscArr[$viewData["mode"]],
                $viewData["rolescod"],
                $viewData["rolesdsc"]
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
        $viewData["xsrftoken"] = md5("rol" . random_int(10000, 99999));
        $_SESSION["xsrftoken"] = $viewData["xsrftoken"];

        \Views\Renderer::render("mnt/rol", $viewData);
    }
}
