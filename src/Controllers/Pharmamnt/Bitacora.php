<?php

namespace Controllers\Pharmamnt;

use Controllers\PrivateController;

class Bitacora extends PrivateController
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
            "bitacoracod" => "",
            "bitacorafch" => "",
            "bitprograma" => "",
            "bitdescripcion" => "",
            "bitTotal" => "",
            "bitSubTotal" => "",
            "bitusuario" => "",
            "bitImpuesto" => "",
            "hasErrors" => false,
            "Errors" => array(),
            "showaction" => true,
            "readonly" => false
        );
        $modeDscArr = array(
            "INS" => "Nuevo Producto",
            "UPD" => "Editando Producto (%s) %s",
            "DEL" => "Eliminando Producto (%s) %s",
            "DSP" => "Detalle de Bitacora (%s) "
        );

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
        if (isset($_GET["bitacoracod"])) {
            $viewData["bitacoracod"] = $_GET["bitacoracod"];
        } else {
            if ($viewData["mode"] !== "INS") {
                $this->noFunc();
            }
        }


        // Hacer elementos en comun

        if ($viewData["mode"] == "INS") {
            $viewData["mode_dsc"]  = $modeDscArr["INS"];
        } else {
            $tmpBitacora = \Dao\Mnt\Bitacoras::obtenerBitacora($viewData["bitacoracod"]);
            $viewData["bitacorafch"] = $tmpBitacora["bitacorafch"];
            $viewData["bitprograma"] = $tmpBitacora["bitprograma"];
            $viewData["bitdescripcion"] = $tmpBitacora["bitdescripcion"];
            $viewData["bitTotal"] = $tmpBitacora["bitTotal"];
            $viewData["bitSubTotal"] = $tmpBitacora["bitSubTotal"];
            $viewData["bitusuario"] = $tmpBitacora["bitusuario"];
            $viewData["bitImpuesto"] = $tmpBitacora["bitImpuesto"];

            $viewData["mode_dsc"]  = sprintf(
                $modeDscArr[$viewData["mode"]],
                $viewData["bitacoracod"]
            );
            if ($viewData["mode"] == "DSP") {
                $viewData["showaction"] = false;
                $viewData["readonly"] = "readonly";
            }
        }
        //Generar un token XSRF para evitar esos ataques
        $viewData["xsrftoken"] = md5("bitacora" . random_int(10000, 99999));
        $_SESSION["xsrftoken"] = $viewData["xsrftoken"];

        \Views\Renderer::render("pharmamnt/bitacora", $viewData);
    }
}
