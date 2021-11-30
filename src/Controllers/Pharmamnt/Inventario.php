<?php

namespace Controllers\Pharmamnt;

use Controllers\PublicController;

class Inventario extends PublicController
{
    private function noFunc()
    {
        \Utilities\Site::redirectToWithMsg(
            "index.php?page=pharmamnt_inventarios",
            "Ocurrió algo inesperado. Intente Nuevamente."
        );
    }
    private function siFunc()
    {
        \Utilities\Site::redirectToWithMsg(
            "index.php?page=pharmamnt_inventarios",
            "Operación ejecutada Satisfactoriamente!"
        );
    }
    public function run(): void
    {
        $viewData = array(
            "mode_dsc" => "",
            "mode" => "",
            "inventarioId" => "",
            "inventarioExistencias" => "",
            "inventarioFechaCaducidad" => "",
            "productoId" => "",
            "hasErrors" => false,
            "Errors" => array(),
            "showaction" => true,
            "readonly" => false
        );
        $modeDscArr = array(
            "INS" => "Nuevo Inventario",
            "UPD" => "Editando Inventario (%s) ",
            "DEL" => "Eliminando Inventario(%s) ",
            "DSP" => "Detalle de Inventario (%s) "
        );

        //combobox
        $tmpProductos = \Dao\Mnt\Productos::listarproductos();
        $conteo = \Dao\Mnt\Productos::contarrows();
        $testeo = $conteo["COUNT(*)"];
        //ordenar en Option

        for ($i = 0; $i < $testeo; $i++) {

            $viewData["prueba"] = $viewData["prueba"] . " <option value=" . $tmpProductos[$i]["productoId"] . " >" . $tmpProductos[$i]["productoNombre"] . "</option> ";
        }

        if ($this->isPostBack()) {
            // se ejecuta al dar click sobre guardar
            $viewData["mode"] = $_POST["mode"];
            $viewData["inventarioId"] = $_POST["inventarioId"];
            $viewData["inventarioExistencias"] = $_POST["inventarioExistencias"];
            $viewData["inventarioFechaCaducidad"] = $_POST["inventarioFechaCaducidad"];
            $viewData["productoId"] = $_POST["productoId"];
            $viewData["xsrftoken"] = $_POST["xsrftoken"];
            // Validacion XRFS Token
            if (!isset($_SESSION["xsrftoken"]) || $viewData["xsrftoken"] != $_SESSION["xsrftoken"]) {
                $this->noFunc();
            }
            // Validaciones de Errores
            if ($viewData["mode"] !== "DEL") {
                if (\Utilities\Validators::IsEmpty($viewData["inventarioExistencias"])) {
                    $viewData["hasErrors"] = true;
                    $viewData["Errors"][] = "El inventario del Producto no puede Ir Vacia!";
                }
                if (\Utilities\Validators::IsEmpty($viewData["inventarioFechaCaducidad"])) {
                    $viewData["hasErrors"] = true;
                    $viewData["Errors"][] = "La Fecha de caducidad del producto no puede Ir Vacia!";
                }
                if (\Utilities\Validators::IsEmpty($viewData["productoId"])) {
                    $viewData["hasErrors"] = true;
                    $viewData["Errors"][] = "El Codigo del producto no puede Ir Vacia!";
                }
            }
            if (!$viewData["hasErrors"]) {
                switch ($viewData["mode"]) {
                    case "INS":
                        if (\Dao\Mnt\Inventarios::crearinventario(
                            $viewData["inventarioExistencias"],
                            $viewData["inventarioFechaCaducidad"],
                            $viewData["productoId"],
                        )) {
                            $this->siFunc();
                        }
                        break;
                    case "UPD":
                        if (\Dao\Mnt\Inventarios::editarinventario(
                            $viewData["inventarioExistencias"],
                            $viewData["inventarioFechaCaducidad"],
                            $viewData["productoId"],
                            $viewData["inventarioId"]
                        )) {
                            $this->siFunc();
                        }
                        break;
                    case "DEL":
                        if (\Dao\Mnt\Inventarios::eliminarinventario(
                            $viewData["inventarioId"]
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
            if (isset($_GET["inventarioId"])) {
                $viewData["inventarioId"] = $_GET["inventarioId"];
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
            $tmpInventario = \Dao\Mnt\Inventarios::obtenerinventario($viewData["inventarioId"]);
            $viewData["inventarioExistencias"] = $tmpInventario["inventarioExistencias"];
            $viewData["inventarioFechaCaducidad"] = $tmpInventario["inventarioFechaCaducidad"];
            $viewData["productoId"] = $tmpInventario["productoId"];

            //combobox
            //ordenar en Option
            for ($i = 0; $i < $testeo; $i++) {
                if ($tmpProductos[$i]["productoId"] == $tmpInventario["productoId"]) {
                    $viewData["prueba"] = $viewData["prueba"] . " <option value=" . $tmpProductos[$i]["productoId"] . " selected >" . $tmpProductos[$i]["productoNombre"] . "</option> ";
                }
                $viewData["prueba"] = $viewData["prueba"] . " <option value=" . $tmpProductos[$i]["productoId"] . " >" . $tmpProductos[$i]["productoNombre"] . "</option> ";
            }
            //
            $viewData["mode_dsc"]  = sprintf(
                $modeDscArr[$viewData["mode"]],
                $viewData["productoId"]
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
        $viewData["xsrftoken"] = md5("inventario" . random_int(10000, 99999));
        $_SESSION["xsrftoken"] = $viewData["xsrftoken"];

        \Views\Renderer::render("pharmamnt/inventario", $viewData);
    }
}
