<?php

namespace Controllers\Pharmamnt;

use Controllers\PublicController;

class Producto extends PublicController
{
    private function noFunc()
    {
        \Utilities\Site::redirectToWithMsg(
            "index.php?page=pharmamnt_productos",
            "Ocurrió algo inesperado. Intente Nuevamente."
        );
    }
    private function siFunc()
    {
        \Utilities\Site::redirectToWithMsg(
            "index.php?page=pharmamnt_productos",
            "Operación ejecutada Satisfactoriamente!"
        );
    }
    public function run(): void
    {
        $viewData = array(
            "mode_dsc" => "",
            "mode" => "",
            "productoId" => "",
            "productoNombre" => "",
            "productoDescripcion" => "",
            "productoCodigo" => "",
            "productoPrecio" => "",
            "productoFechaCreado" => "",
            "productoFechaPublicado" => "",
            "productoFechaEditado" => "",
            "presentacionId" => "",
            "laboratorioId" => "",
            "productoImgen" => "",
            "productoActivo_ACT" => "",
            "productoActivo_INA" => "",
            "hasErrors" => false,
            "Errors" => array(),
            "showaction" => true,
            "readonly" => false
        );
        $modeDscArr = array(
            "INS" => "Nuevo Producto",
            "UPD" => "Editando Producto (%s) %s",
            "DEL" => "Eliminando Producto (%s) %s",
            "DSP" => "Detalle de Producto (%s) %s"
        );

        //combobox
        $tmpLaboratorios = \Dao\Mnt\Laboratorios::listarLaboratorios();
        $conteo = \Dao\Mnt\Laboratorios::countrows();
        $testeo = $conteo["COUNT(*)"];
        //ordenar en Option

        for ($i = 0; $i < $testeo; $i++) {

            $viewData["prueba"] = $viewData["prueba"] . " <option value=" . $tmpLaboratorios[$i]["laboratorioId"] . " >" . $tmpLaboratorios[$i]["laboratorioNombre"] . "</option> ";
        }

        if ($this->isPostBack()) {
            // se ejecuta al dar click sobre guardar
            $viewData["mode"] = $_POST["mode"];
            $viewData["productoId"] = $_POST["productoId"];
            $viewData["productoNombre"] = $_POST["productoNombre"];
            $viewData["productoDescripcion"] = $_POST["productoDescripcion"];
            $viewData["productoCodigo"] = $_POST["productoCodigo"];
            $viewData["productoPrecio"] = $_POST["productoPrecio"];
            $viewData["productoFechaCreado"] = $_POST["productoFechaCreado"];
            $viewData["productoFechaPublicado"] = $_POST["productoFechaPublicado"];
            $viewData["productoFechaEditado"] = $_POST["productoFechaEditado"];
            $viewData["productoActivo"] = $_POST["productoActivo"];
            $viewData["presentacionId"] = $_POST["presentacionId"];
            $viewData["laboratorioId"] = $_POST["laboratorioId"];
            $viewData["productoImagen"] = $_POST["productoImagen"];
            $viewData["xsrftoken"] = $_POST["xsrftoken"];
            // Validacion XRFS Token
            if (!isset($_SESSION["xsrftoken"]) || $viewData["xsrftoken"] != $_SESSION["xsrftoken"]) {
                $this->noFunc();
            }
            // Validaciones de Errores
            if ($viewData["mode"] !== "DEL") {
                if (\Utilities\Validators::IsEmpty($viewData["productoNombre"])) {
                    $viewData["hasErrors"] = true;
                    $viewData["Errors"][] = "El nombre del Producto no puede Ir Vacia!";
                }
                if (\Utilities\Validators::IsEmpty($viewData["productoDescripcion"])) {
                    $viewData["hasErrors"] = true;
                    $viewData["Errors"][] = "La descripcion del producto no puede Ir Vacia!";
                }
                if (\Utilities\Validators::IsEmpty($viewData["productoCodigo"])) {
                    $viewData["hasErrors"] = true;
                    $viewData["Errors"][] = "El Codigo del producto no puede Ir Vacia!";
                }
                if (\Utilities\Validators::IsEmpty($viewData["productoPrecio"])) {
                    $viewData["hasErrors"] = true;
                    $viewData["Errors"][] = "El Codigo del precio no puede Ir Vacia!";
                }
                if (($viewData["productoActivo"] == "0"
                        || $viewData["productoActivo"] == "1") == false
                ) {
                    $viewData["hasErrors"] = true;
                    $viewData["Errors"][] = "El estado no puede Ir Vacio!";
                }
                if (\Utilities\Validators::IsEmpty($viewData["presentacionId"])) {
                    $viewData["hasErrors"] = true;
                    $viewData["Errors"][] = "El Codigo del precio no puede Ir Vacia!";
                }
            } else {
                if (\Utilities\Validators::IsEmpty($viewData["productoNombre"])) {
                    $viewData["hasErrors"] = true;
                    $viewData["Errors"][] = "El nombre del Producto no puede Ir Vacia!";
                }
                if (\Utilities\Validators::IsEmpty($viewData["productoDescripcion"])) {
                    $viewData["hasErrors"] = true;
                    $viewData["Errors"][] = "La descripcion del producto no puede Ir Vacia!";
                }
                if (\Utilities\Validators::IsEmpty($viewData["productoCodigo"])) {
                    $viewData["hasErrors"] = true;
                    $viewData["Errors"][] = "El Codigo del producto no puede Ir Vacia!";
                }
                if (\Utilities\Validators::IsEmpty($viewData["productoPrecio"])) {
                    $viewData["hasErrors"] = true;
                    $viewData["Errors"][] = "El Codigo del precio no puede Ir Vacia!";
                }
                if (\Utilities\Validators::IsEmpty($viewData["presentacionId"])) {
                    $viewData["hasErrors"] = true;
                    $viewData["Errors"][] = "El Codigo del precio no puede Ir Vacia!";
                }
            }
            if (!$viewData["hasErrors"]) {
                switch ($viewData["mode"]) {
                    case "INS":
                        if (\Dao\Mnt\Productos::crearproducto(
                            $viewData["productoNombre"],
                            $viewData["productoDescripcion"],
                            $viewData["productoCodigo"],
                            $viewData["productoPrecio"],
                            $viewData["productoFechaCreado"],
                            $viewData["productoFechaPublicado"],
                            $viewData["productoFechaEditado"],
                            $viewData["productoActivo"],
                            $viewData["presentacionId"],
                            $viewData["laboratorioId"],
                            $viewData["productoImagen"],
                        )) {
                            $this->siFunc();
                        }
                        break;
                    case "UPD":
                        if (\Dao\Mnt\Productos::editarproducto(
                            $viewData["productoNombre"],
                            $viewData["productoDescripcion"],
                            $viewData["productoCodigo"],
                            $viewData["productoPrecio"],
                            $viewData["productoFechaCreado"],
                            $viewData["productoFechaPublicado"],
                            $viewData["productoFechaEditado"],
                            $viewData["productoActivo"],
                            $viewData["presentacionId"],
                            $viewData["laboratorioId"],
                            $viewData["productoImagen"],
                            $viewData["productoId"]
                        )) {
                            $this->siFunc();
                        }
                        break;
                    case "DEL":
                        if (\Dao\Mnt\Productos::eliminarproducto(
                            $viewData["productoId"]
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
            if (isset($_GET["productoId"])) {
                $viewData["productoId"] = $_GET["productoId"];
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
            $tmpProductos = \Dao\Mnt\Productos::obtenerproducto($viewData["productoId"]);
            $viewData["productoNombre"] = $tmpProductos["productoNombre"];
            $viewData["productoDescripcion"] = $tmpProductos["productoDescripcion"];
            $viewData["productoCodigo"] = $tmpProductos["productoCodigo"];
            $viewData["productoPrecio"] = $tmpProductos["productoPrecio"];
            $viewData["productoFechaCreado"] = $tmpProductos["productoFechaCreado"];
            $viewData["productoFechaPublicado"] = $tmpProductos["productoFechaPublicado"];
            $viewData["productoFechaEditado"] = $tmpProductos["productoFechaEditado"];
            $viewData["presentacionId"] = $tmpProductos["presentacionId"];
            $viewData["laboratorioId"] = $tmpProductos["laboratorioId"];
            $viewData["productoImagen"] = $tmpProductos["productoImagen"];
            $viewData["productoActivo_ACT"] = $tmpProductos["productoActivo"] == 1 ? "selected" : "";
            $viewData["productoActivo_INA"] = $tmpProductos["productoActivo"] == 0 ? "selected" : "";

            //combobox
            //ordenar en Option
            for ($i = 0; $i < $testeo; $i++) {
                if ($tmpLaboratorios[$i]["laboratorioId"] == $tmpProductos["laboratorioId"]) {
                    $viewData["prueba"] = $viewData["prueba"] . " <option value=" . $tmpLaboratorios[$i]["laboratorioId"] . " selected >" . $tmpLaboratorios[$i]["laboratorioNombre"] . "</option> ";
                }
                $viewData["prueba"] = $viewData["prueba"] . " <option value=" . $tmpLaboratorios[$i]["laboratorioId"] . " >" . $tmpLaboratorios[$i]["laboratorioNombre"] . "</option> ";
            }

            $viewData["mode_dsc"]  = sprintf(
                $modeDscArr[$viewData["mode"]],
                $viewData["productoId"],
                $viewData["productoNombre"]
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
        $viewData["xsrftoken"] = md5("producto" . random_int(10000, 99999));
        $_SESSION["xsrftoken"] = $viewData["xsrftoken"];

        \Views\Renderer::render("pharmamnt/producto", $viewData);
    }
}
