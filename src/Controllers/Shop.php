<?php

namespace Controllers;

use Controllers\PublicController;

class Shop extends PublicController
{
    public function run() :void
    {
        \Utilities\Site::addLink("public/css/shop.css");

        $viewData = array(
            "totalProductos" => 0,
            "totalTienda" => 0,
            "totalList" => ""
        );

        $numPerPage = 9;

        if(isset($_GET["list"])){
            $list=$_GET["list"];
            $viewData["list"] = $list;
        }else{
            $list=1;
            $viewData["list"] = 1;
        }

        if(isset($_GET["presentacion"]))
        {
            $presentacion = $_GET["presentacion"];
            $viewData["existePresentacion"] = true;
            $viewData["presentacion"] = $presentacion;

            $viewData["lista"] = \Dao\Shop::obtenerNumProductosB($presentacion);

            foreach ($viewData["lista"] as $producto) {
                $viewData["totalTienda"] = $viewData["totalTienda"] + 1; 
            }

            if($viewData["totalTienda"] == 0 ){
                $viewData["noData"] = true;
            }
        
            $viewData["totalList"] = ceil($viewData["totalTienda"]/$numPerPage);
        
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
        }else{
            $presentacion = "";
            $viewData["existePresentacion"] = false;
            $viewData["lista"] = \Dao\Shop::obtenerNumProductos();

            foreach ($viewData["lista"] as $producto) {
                $viewData["totalTienda"] = $viewData["totalTienda"] + 1; 
            }

            if($viewData["totalTienda"] == 0 ){
                $viewData["noData"] = true;
            }
        
            $viewData["totalList"] = ceil($viewData["totalTienda"]/$numPerPage);
        
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

        $viewData["productoReciente"] = \Dao\Shop::productosRecientes();
        $viewData["producto"] = \Dao\Shop::obtenerProductos($list, $presentacion, $numPerPage);
        $viewData["presentacion"] = \Dao\Shop::obtenerPresentaciones();

        foreach ($viewData["producto"] as $producto) {
            $viewData["totalProductos"] = $viewData["totalProductos"] + 1;
        }

        \Views\Renderer::render("shop", $viewData);
    }
}
?>