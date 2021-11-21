<?php

namespace Controllers\Mnt;

use Controllers\PrivateController;
use Views\Renderer;

class Funciones extends PrivateController
{
    public function run(): void
    {
        $viewData = array();
        $viewData["items"] = \Dao\Security\Security::getFeatures();
        $viewData["new_enabled"] = $this->isFeatureAutorized(("mnt_funciones_new"));
        $viewData["edit_enabled"] = $this->isFeatureAutorized(("mnt_funciones_edit"));
        $viewData["delete_enabled"] = $this->isFeatureAutorized(("mnt_funciones_delete"));
        Renderer::render("mnt/funciones", $viewData);
    }
}
