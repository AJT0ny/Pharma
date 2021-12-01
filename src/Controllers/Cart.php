<?php

namespace Controllers;

use Controllers\PublicController;

class Cart extends PublicController
{
    public function run(): void
    {
        \Utilities\Site::addLink("public/css/cart.css");

        $viewData= array();

        \Views\Renderer::render("cart", $viewData);
    }
}

?>