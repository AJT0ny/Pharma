<?php

namespace Controllers;

use Controllers\PublicController;
use Views\Renderer;

class Bitclient extends PublicController
{
    public function run(): void
    {
        $viewData = array();
        $viewData["items"] = \Dao\Bitclient::obtenerBitacorasde1($_SESSION["login"]["userId"]);
        Renderer::render("bitclient", $viewData);
    }
}
