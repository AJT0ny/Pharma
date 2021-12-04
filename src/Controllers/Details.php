<?php

namespace Controllers;

use Controllers\PublicController;

class Details extends PublicController
{
    private function badEnding()
    {
        \Utilities\Site::redirectToWithMsg("index.php?page=shop", "Ocurrio algo inesperado. Intente nuevamente.");
    }
    private function goodEnding()
    {
        \Utilities\Site::redirectToWithMsg("index.php?page=cart", "El producto se ha añadido al carrito.");
    }

    public function run() :void
    {
        \Utilities\Site::addLink("public/css/details.css");

        $viewData = array(
            "productoId" => 0,
            "productoNombre" => "",
            "productoDescripcion" => "",
            "productoPrecio" => "",
            "productoImagen" => "",
            "laboratorioNombre" => "",
            "inventarioExistencias" => "",
            "presentacionNombre" => "",
            "carritoEstado" => "Actual",
            "usuario_usercod" => 0,
            "carritoId" => 0,
            "carritoProductoCantidad" => 1,
            "carritoProductoActivo" => 1
        );

        if($this->isPostBack()){
            $viewData["userId"] = $_POST["userId"];
            $viewData["carritoEstado"] = $_POST["carritoEstado"];
            $viewData["usuario_usercod"] = $_POST["usuario_usercod"];
            $viewData["productoId"] = $_POST["productoId"];
            $viewData["carritoProductoCantidad"] = $_POST["carritoProductoCantidad"];
            $viewData["carritoProductoActivo"] = $_POST["carritoProductoActivo"];

            $existeCarrito = \Dao\Details::existeCarrito($viewData["usuario_usercod"]);
            $carritoExiste = 0;

            if($existeCarrito != false){
                foreach ($existeCarrito as $carrito) {
                    $carritoExiste = $carritoExiste + 1;
                }
            }

            if($carritoExiste == 0){
                if(\Dao\Details::crearCarrito(
                    $viewData["userId"],
                    $viewData["carritoEstado"],
                    $viewData["usuario_usercod"]
                )){
                    if(\Dao\Details::agregarProductoACarrito(
                        $viewData["productoId"],
                        $viewData["carritoId"],
                        $viewData["carritoProductoCantidad"],
                        $viewData["carritoProductoActivo"],
                    )){
                        $this->goodEnding();
                    }else{
                        $this->badEnding();
                    }
                }else{
                    $this->badEnding();
                }
            }else{
                $viewData["carritoId"] = $_POST["carritoId"];
                if(\Dao\Details::agregarProductoACarrito(
                    $viewData["productoId"],
                    $viewData["carritoId"],
                    $viewData["carritoProductoCantidad"],
                    $viewData["carritoProductoActivo"],
                )){
                    $this->goodEnding();
                }else{
                    $this->badEnding();
                }
            }

        }else{
            if(isset($_GET["productoId"]) && isset($_SESSION["login"]["userId"])){
                $productoId = $_GET["productoId"];
                $userId = $_SESSION["login"]["userId"];
            }else{
                $this->badEnding();
            }
        }

        $tmpProducto = \Dao\Details::obtenerProducto($productoId);
        $viewData["usuario_usercod"] = $userId;
        $viewData["productoId"] = $tmpProducto["productoId"];
        $viewData["productoNombre"] = $tmpProducto["productoNombre"];
        $viewData["productoDescripcion"] = $tmpProducto["productoDescripcion"];
        $viewData["productoImagen"] = $tmpProducto["productoImagen"];
        $viewData["productoPrecio"] = $tmpProducto["productoPrecio"];
        $viewData["inventarioExistencias"] = $tmpProducto["inventarioExistencias"];
        $viewData["presentacionId"] = $tmpProducto["presentacionId"];
        $viewData["presentacionNombre"] = $tmpProducto["presentacionNombre"];
        $viewData["laboratorioNombre"] = $tmpProducto["laboratorioNombre"];

        $existeCarrito = \Dao\Details::existeCarrito($userId);
        $carritoExiste = 0;

        if($existeCarrito != false){
            foreach ($existeCarrito as $carrito) {
                $carritoExiste = $carritoExiste + 1;
            }
        }

        if($carritoExiste > 0){
            $infoCarrito = \Dao\Details::infoCarrito($userId);
            $viewData["carritoId"] = $infoCarrito["carritoId"];
        }

        $viewData["carritoExiste"] = $carritoExiste;

        $presentacionId = $viewData["presentacionId"];
       
        $viewData ["ProductosRelacionados"] =\dao\Details::obtenerProductosRelacionados($presentacionId, $productoId);
       

        \Views\Renderer::render("details", $viewData);
    }
}
?>