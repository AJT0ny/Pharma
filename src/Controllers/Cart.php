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

        $viewData= array();

        if(isset($_SESSION["login"]["userId"])){
            $userId = $_SESSION["login"]["userId"];
        }else{
            $this->badEnding();
        }

        $carritoId = \Dao\Cart::getCarritoId($userId);
        $viewData["carritoId"] = $carritoId["carritoId"];
        $viewData["productoEnCarrito"] = \Dao\Cart::obtenerProductosEnCarrito($viewData["carritoId"]);

        \Views\Renderer::render("cart", $viewData);
    }
}

?>