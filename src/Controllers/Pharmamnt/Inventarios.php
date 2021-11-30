<?php

namespace Controllers\Pharmamnt;

use Controllers\PublicController;
use Views\Renderer;

class Inventarios extends PublicController
{
    public function run(): void
    {
        $viewData = array();
        $viewData["items"] = \Dao\Mnt\Inventarios::obtenerInventarios();
        $viewData["new_enabled"] = true;
        $viewData["edit_enabled"] = true;
        $viewData["delete_enabled"] = true;
        Renderer::render("pharmamnt/inventarios", $viewData);
    }
}
