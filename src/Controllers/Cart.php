<?php

namespace Controllers;

use Controllers\PublicController;

class Cart extends PublicController
{
    private function badEnding()
    {
        \Utilities\Site::redirectToWithMsg("index.php?page=shop", "Ocurrio algo inesperado. Intente nuevamente.");
    }
    private function goodEnding()
    {
        \Utilities\Site::redirectToWithMsg("index.php?page=checkout_checkout", "Orden Guardada Satisfactoriamente.");
    }
    private function crearUsuario()
    {
        \Utilities\Site::redirectToWithMsg("index.php?page=sec_register", "Necesitas una cuenta de usuario para realizar compras.");
    }

    public function run(): void
    {
        \Utilities\Site::addLink("public/css/Cart.css");
        

        $viewData= array(
            "ordenEstado" => 1,
            "descuento" => 0,
            "usuarioId" => "",
            "usuario_usercod" => 0,
            "noHayCarrito" => true
        );

        if($this->isPostBack()){
            $viewData["usuario_usercod"] = $_POST["usuario_usercod"];
            $viewData["sumaProductos"] = $_POST["sumaProductos"];
            $viewData["impuesto"] = $_POST["impuesto"];
            $viewData["totalCarrito"] = $_POST["totalCarrito"];
            $viewData["carritoId"] = $_POST["carritoId"];

            $ordenesUsuario = \Dao\Cart::getOrdenes($viewData["usuario_usercod"]);
            $productoEnCarrito = array();

            if($ordenesUsuario["ordenExiste"] == 0)
            {
                if(\Dao\Cart::agregarOrden(
                    $viewData["usuarioId"],
                    $viewData["ordenEstado"],
                    $viewData["sumaProductos"],
                    $viewData["descuento"],
                    $viewData["impuesto"],
                    $viewData["totalCarrito"],
                    $viewData["usuario_usercod"]
                ))
                {
                    $ordenId = \Dao\Cart::getOrdenId($viewData["usuario_usercod"]);
                    $productoEnCarrito = \Dao\Cart::obtenerProductosEnCarrito($viewData["carritoId"]);
                    foreach ($productoEnCarrito as $producto) {
                        $impuestoProducto = $producto["productoPrecio"] * 0.15;
                        if(\Dao\Cart::agregarProductoAOrden(
                            $producto["productoId"],
                            $ordenId["ordenId"],
                            $producto["carritoProductoCantidad"],
                            round($impuestoProducto, 2),
                            $producto["carritoProductoTotal"]
                        )){
                        }else{
                            $this->badEnding();
                        }
                    }
                    if(\Dao\Cart::deleteProductosCarrito($viewData["carritoId"]))
                    {           
                    }else{
                        $this->badEnding();
                    }
                    $this->goodEnding();
                }else{
                    $this->badEnding();
                }
            }else{
                $ordenId = \Dao\Cart::getOrdenId($viewData["usuario_usercod"]);
                $productoEnCarrito = \Dao\Cart::obtenerProductosEnCarrito($viewData["carritoId"]);
                foreach ($productoEnCarrito as $producto) {
                    $impuestoProducto = $producto["productoPrecio"] * 0.15;
                    if(\Dao\Cart::agregarProductoAOrden(
                        $producto["productoId"],
                        $ordenId["ordenId"],
                        $producto["carritoProductoCantidad"],
                        round($impuestoProducto, 2),
                        $producto["carritoProductoTotal"]
                    )){
                    }else{
                        $this->badEnding();
                    }
                }
                $this->goodEnding();
            }

        }else{
            if(isset($_SESSION["login"]["userId"])){
                $userId = $_SESSION["login"]["userId"];
                if(isset($_SESSION["startTime"]) && ((time() - $_SESSION["startTime"]) > 86400)){
                    $carritoId = \Dao\Cart::getCarritoId($userId);
                    if(\Dao\Cart::deleteProductosCarrito($carritoId["carritoId"]))
                    {           
                    }else{
                        $this->badEnding();
                    }
                    $_SESSION["startTime"] = time();
                }
            }else{
                $this->crearUsuario();
            }
        }

        $viewData["startTime"] = $_SESSION["startTime"];
        $viewData["time"] = time();
        $viewData["usuario_usercod"] = $userId;
        $carritoId = \Dao\Cart::getCarritoId($userId);
    
        if($carritoId != false){
            $viewData["carritoId"] = $carritoId["carritoId"];
            $countProductos = \Dao\Cart::countProductosEnCarrito($viewData["carritoId"]);
            if($countProductos["numeroDeProductos"] > 0){
                $viewData["noHayCarrito"] = false;
                $viewData["productoEnCarrito"] = \Dao\Cart::obtenerProductosEnCarrito($viewData["carritoId"]);
                $carritoSum = \Dao\Cart::sumProductos($viewData["carritoId"]);
                $viewData["sumaProductos"] = $carritoSum["sumaProductos"];

                $impuesto = intval($viewData["sumaProductos"]) * 0.15;
                $viewData["impuesto"] = $impuesto;
                $totalProductos = intval($viewData["sumaProductos"]) + $impuesto;
                $viewData["totalCarrito"] = $totalProductos;
            }
        }

        \Views\Renderer::render("cart", $viewData);
    }
}

?>