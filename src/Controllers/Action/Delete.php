<?php

namespace Controllers\Action;

use Controllers\PublicController;
use Views\Renderer;

class Delete extends PublicController
{
    private function goodEnding()
    {
        \Utilities\Site::redirectToWithMsg("index.php?page=cart", "Producto Eliminado del carrito.");
    }
    private function badEnding()
    {
        \Utilities\Site::redirectToWithMsg("index.php?page=cart", "Ocurrio algo inesperado. Intente nuevamente.");
    }

    public function run() :void
    {

        if(isset($_GET["carritoProductoId"])){
            $carritoProductoId = $_GET["carritoProductoId"];
            if(\Dao\Action\Delete::deleteProductoCarrito($carritoProductoId)){
                $this->goodEnding();
            }else{
                $this->badEnding();
            }
        }else{
            $this->badEnding();
        }

        Renderer::render("action/delete", array());
    }
}

?>