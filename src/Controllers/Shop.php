<?php

namespace Controllers;

use Controllers\PublicController;

class Shop extends PublicController
{
    public function run() :void
    {
        \Utilities\Site::addLink("public/css/shop.css");

        $viewData = array(
            "totalProductos" => 0,
        );
        $viewData["productoReciente"] = \Dao\Shop::productosRecientes();
        $viewData["producto"] = \Dao\Shop::obtenerProductos();
        $viewData["presentacion"] = \Dao\Shop::obtenerPresentaciones();

        foreach ($viewData["producto"] as $producto) {
            $viewData["totalProductos"] = $viewData["totalProductos"] + 1;
        }

        \Views\Renderer::render("shop", $viewData);
    }
}
?>