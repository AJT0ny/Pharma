<?php

namespace Controllers\Pharmamnt;

use Controllers\PrivateController;
use Views\Renderer;

class Bitacoras extends PrivateController
{
    public function run(): void
    {
        $viewData = array();
        $viewData["items"] = \Dao\Mnt\Bitacoras::obtenerBitacoras();
        Renderer::render("pharmamnt/bitacoras", $viewData);
    }
}
