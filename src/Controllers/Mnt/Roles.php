<?php

namespace Controllers\Mnt;

use Controllers\PrivateController;
use Views\Renderer;

class Roles extends PrivateController
{
    public function run(): void
    {
        $viewData = array();
        $viewData["items"] = \Dao\Security\Security::getRols();
        $viewData["new_enabled"] = true;
        $viewData["edit_enabled"] = true;
        $viewData["delete_enabled"] = true;
        Renderer::render("mnt/roles", $viewData);
    }
}
