<?php

namespace Controllers\Mnt;

use Controllers\PrivateController;

class Laboratorios extends PrivateController
{
    public function run():void
    {
        \Utilities\Site::addLink("public/css/Laboratorios.css");

        $viewData = array(
            "totalLabs" => 0,
            "totalList" => "",
        );

        $numPerPage = 5;

        if(isset($_GET["list"])){
            $list=$_GET["list"];
            $viewData["list"] = $list;
        }
        else{
            $list=1;
            $viewData["list"] = 1;
        }

        $viewData["lista"] = \Dao\Mnt\Laboratorios::obtenerNumLaboratorios();

        foreach ($viewData["lista"] as $producto) {
            $viewData["totalLabs"] = $viewData["totalLabs"] + 1; 
        }
    
        $viewData["totalList"] = ceil($viewData["totalLabs"]/$numPerPage);
    
        for ($i=1; $i <= $viewData["totalList"]; $i++) {
            $viewData["nList"]["number"] = $i;
            $viewData["nPages"][] = $viewData["nList"];
        }



        $viewData["laboratorio"] = \Dao\Mnt\Laboratorios::obtenerLaboratorios($list, $numPerPage);

        if($list<$viewData["totalList"]){
            $viewData["next"] = true;
            $viewData["nextBtn"] = $list+1;
        }
        
        if ($list>1) {
            $viewData["previous"] = true;
            $viewData["prevBtn"] = $list - 1;
        }

        \Views\Renderer::render("mnt/Laboratorios", $viewData);
    }
}

?>