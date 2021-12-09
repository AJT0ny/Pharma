<?php

namespace Controllers\Pharmamnt;

use Controllers\PrivateController;
use Views\Renderer;

class Productos extends PrivateController
{
    public function run(): void
    {
        $viewData = array();
        $viewData["items"] = \Dao\Mnt\Productos::obtenerProductos();
        $viewData["new_enabled"] = true;
        $viewData["edit_enabled"] = true;
        $viewData["delete_enabled"] = true;
        Renderer::render("pharmamnt/productos", $viewData);
    }
}
