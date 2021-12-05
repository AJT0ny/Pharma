<?php

namespace Controllers;

use Controllers\PublicController;

class Cart extends PublicController
{
    private function badEnding()
    {
        \Utilities\Site::redirectToWithMsg("index.php?page=shop", "Ocurrio algo inesperado. Intente nuevamente.");
    }
    private function goodEnding()
    {
        \Utilities\Site::redirectToWithMsg("index.php?page=cart", "xd.");
    }

    public function run(): void
    {
        \Utilities\Site::addLink("public/css/Cart.css");

        $viewData= array(
            "noHayCarrito" => true
        );

        if(isset($_SESSION["login"]["userId"])){
            $userId = $_SESSION["login"]["userId"];
        }else{
            $this->badEnding();
        }

        $carritoId = \Dao\Cart::getCarritoId($userId);
    
        if($carritoId != false){
            $viewData["carritoId"] = $carritoId["carritoId"];
            $countProductos = \Dao\Cart::countProductosEnCarrito($viewData["carritoId"]);
                if($countProductos["numeroDeProductos"] > 0){
                $viewData["noHayCarrito"] = false;
                $viewData["productoEnCarrito"] = \Dao\Cart::obtenerProductosEnCarrito($viewData["carritoId"]);
                $carritoSum = \Dao\Cart::sumProductos($viewData["carritoId"]);
                $viewData["sumaProductos"] = $carritoSum["sumaProductos"];
    
                $totalProductos = intval($viewData["sumaProductos"]) + (intval($viewData["sumaProductos"]) * 0.15);
                $viewData["totalCarrito"] = $totalProductos;
            }
        }

        \Views\Renderer::render("cart", $viewData);
    }
}

?>