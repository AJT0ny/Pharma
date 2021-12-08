<?php

namespace Controllers\Action;

use Controllers\PublicController;
use Views\Renderer;

class deleteOrder extends PublicController
{
    private function goodEnding()
    {
        \Utilities\Site::redirectToWithMsg("index.php?page=cart", "Orden Eliminada.");
    }
    private function badEnding()
    {
        \Utilities\Site::redirectToWithMsg("index.php?page=cart", "Ocurrio algo inesperado. Intente nuevamente.");
    }

    public function run() :void
    {

        if(isset($_GET["ordenId"])){
            $ordenId = $_GET["ordenId"];
            if(\Dao\Action\Delete::deleteProductoOrden($ordenId)){
                if (\Dao\Action\Delete::deleteOrden($ordenId)) {
                    $this->goodEnding();
                }
            }else{
                $this->badEnding();
            }
        }else{
            $this->badEnding();
        }

        Renderer::render("action/deleteorder", array());
    }
}

?>