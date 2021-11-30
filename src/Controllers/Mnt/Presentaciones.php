<?php

namespace Controllers\Mnt;

use Controllers\PrivateController;

class Presentaciones extends PrivateController
{
    public function run():void
    {
        \Utilities\Site::addLink("public/css/Mantenimientos.css");

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
        

        if(isset($_GET["search"])){
            $search = $_GET["search"];
            $viewData["search"] = true;
            $viewData["numberPages"] = false;
            $viewData["searchValue"] = $search;
            $viewData["lista"] = \Dao\Mnt\Presentaciones::obtenerNPresentacionesB($search);

            foreach ($viewData["lista"] as $producto) {
                $viewData["totalLabs"] = $viewData["totalLabs"] + 1; 
            }

            if($viewData["totalLabs"] == 0 ){
                $viewData["noData"] = true;
            }
    
            $viewData["totalList"] = ceil($viewData["totalLabs"]/$numPerPage);
    
            for ($i=1; $i <= $viewData["totalList"]; $i++) {
                $viewData["nList"]["number"] = $i;
                $viewData["nPages"][] = $viewData["nList"];
                $viewData["searchValue"] = $search;
            }

            if($list<$viewData["totalList"]){
                $viewData["next"] = true;
                $viewData["nextBtn"] = $list+1;
            }
            
            if ($list>1) {
                $viewData["previous"] = true;
                $viewData["prevBtn"] = $list - 1;
            }

        }else{
            $search = "";
            $viewData["search"] = false;
            $viewData["numberPages"] = true;
            $viewData["lista"] = \Dao\Mnt\Presentaciones::obtenerNumPresentaciones();

            foreach ($viewData["lista"] as $producto) {
                $viewData["totalLabs"] = $viewData["totalLabs"] + 1; 
            }

            if($viewData["totalLabs"] == 0 ){
                $viewData["noData"] = true;
            }
        
            $viewData["totalList"] = ceil($viewData["totalLabs"]/$numPerPage);
        
            for ($i=1; $i <= $viewData["totalList"]; $i++) {
                $viewData["nList"]["number"] = $i;
                $viewData["nPages"][] = $viewData["nList"];
            }

            if($list<$viewData["totalList"]){
                $viewData["next"] = true;
                $viewData["nextBtn"] = $list+1;
            }
            
            if ($list>1) {
                $viewData["previous"] = true;
                $viewData["prevBtn"] = $list - 1;
            }
        }

        $viewData["presentacion"] = \Dao\Mnt\Presentaciones::obtenerPresentaciones($list, $search, $numPerPage);

        \Views\Renderer::render("mnt/Presentaciones", $viewData);
    }
}

?>