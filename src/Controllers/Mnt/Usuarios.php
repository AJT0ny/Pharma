<?php

namespace Controllers\Mnt;

use Controllers\PrivateController;

class Usuarios extends PrivateController{
    public function run():void
    {
        $viewData = array();
        $viewData["Usuarios"] = \Dao\Security\Security::getUsuarios();
        $viewData["CanView"] = true;
        $viewData["CanInsert"] = true;
        $viewData["CanUpdate"] = true;
        $viewData["CanDelete"] = true;
        $viewData["FONT_AWESOME_KIT"] = "dc88af8176";
        \Views\Renderer::render("mnt/usuarios", $viewData);
    }
}

/*
{
    Usuarios: [],
    CanInsert: true,
    CanUpdate: true,
    CanDelete: true,
    CanView: true
}

withContext =
root =
{
    Usuarios: [],
    CanInsert: true,
    CanUpdate: true,
    CanDelete: true,
    CanView: true
}

foreach Usuarios
    withContext = Usuarios
    
    root =
        {
            Usuarios: [],
            CanInsert: true,
            CanUpdate: true,
            CanDelete: true,
            CanView: true
        }
endfor Usuarios
*/
