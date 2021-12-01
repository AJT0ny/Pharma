<?php

namespace Controllers;

use Controllers\PublicController;

class Details extends PublicController
{
    private function badEnding()
    {
        \Utilities\Site::redirectToWithMsg("index.php?page=mnt_laboratorios", "Ocurrio algo inesperado. Intente nuevamente.");
    }

    public function run() :void
    {
        \Utilities\Site::addLink("public/css/details1.css");

        $viewData = array(
            "productoNombre" => "",
            "productoDescripcion" => "",
            "productoPrecio" => "",
            "productoImagen" => "",
            "laboratorioNombre" => "",
            "inventarioExistencias" => "",
            "presentacionNombre" => ""
        );

        if(isset($_GET["productoId"])){
            $productoId = $_GET["productoId"];
        }else{
            $this->badEnding();
        }

        $tmpProducto = \Dao\Details::obtenerProducto($productoId);
        $viewData["productoId"] = $productoId;
        $viewData["arraytmp"] = json_encode($tmpProducto);
        $viewData["productoNombre"] = $tmpProducto["productoNombre"];
        $viewData["productoDescripcion"] = $tmpProducto["productoDescripcion"];
        $viewData["productoImagen"] = $tmpProducto["productoImagen"];
        $viewData["productoPrecio"] = $tmpProducto["productoPrecio"];
        $viewData["inventarioExistencias"] = $tmpProducto["inventarioExistencias"];
        $viewData["presentacionId"] = $tmpProducto["presentacionId"];
        $viewData["presentacionNombre"] = $tmpProducto["presentacionNombre"];
        $viewData["laboratorioNombre"] = $tmpProducto["laboratorioNombre"];

        $presentacionId = $viewData["presentacionId"];
       
        $viewData ["ProductosRelacionados"] =\dao\Details::obtenerProductosRelacionados($presentacionId, $productoId);
       
       

        \Views\Renderer::render("details", $viewData);
    }
}
?>