<?php

namespace Controllers;

use Controllers\PublicController;

class Details extends PublicController
{
    public function run() :void
    {
        \Utilities\Site::addLink("public/css/details.css");

        $viewData = array(
            
        );
        if(isset($_GET["productoId"])){
            $productoId = $_GET["productoId"];
        }else{
            $productoId=1;
        }
       $viewData ["Producto"] =\dao\Details::obtenerProducto($productoId);
       

        \Views\Renderer::render("details", $viewData);
    }
}
?>