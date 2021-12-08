<?php

namespace Controllers\Checkout;

use Controllers\PublicController;

class Checkout extends PublicController{
    public function badEnding()
    {
        \Utilities\Site::redirectToWithMsg("index.php?page=sec_register", "Necesitas una cuenta de usuario para realizar esta compra!");
    }
    public function noProducts()
    {
        \Utilities\Site::redirectToWithMsg("index.php?page=shop", "No puedes ingresar a esta pagina si no hay productos!");
    }
    public function run():void
    {
        \Utilities\Site::addLink("public/css/Checkout.css");
        $viewData = array();
        if ($this->isPostBack()) {
            $PayPalOrder = new \Utilities\Paypal\PayPalOrder(
                "test".(time() - 10000000),
                "http://localhost/Pharma/Pharma/index.php?page=checkout_error",
                "http://localhost/Pharma/Pharma/index.php?page=checkout_accept"
            );
            $orden = \Dao\Checkout::getOrden($_SESSION["login"]["userId"]);
            $productos = \Dao\Checkout::fillProductosOrden($orden["ordenId"]);
            $i = 0;
            $i = $i+1;
            foreach ($productos as $item) {
                $PayPalOrder->addItem($item["productoNombre"], $item["productoDescripcion"], "PRD-" . $i, floatval($item["productoPrecio"]), floatval($item["ordenProductoImpuesto"]), intval($item["ordenProductoCantidad"]), "DIGITAL_GOODS");
            }
            $response = $PayPalOrder->createOrder();
            $_SESSION["orderid"] = $response[1]->result->id;
            \Utilities\Site::redirectTo($response[0]->href);
            die();
        }else{
            if(isset($_SESSION["login"]["userId"])){
                $userId = $_SESSION["login"]["userId"];
            }else{
                $this->badEnding();
            }
        }

        $orden = \Dao\Checkout::getOrden($userId);

        if($orden != false){
            $viewData["ordenId"] = $orden["ordenId"]; 
            $viewData["ordenSubtotal"] = $orden["ordenSubtotal"];
            $viewData["ordenImpuestos"] = $orden["ordenImpuestos"];
            $viewData["ordenTotal"] = $orden["ordenTotal"];
            $viewData["ordenProducto"] = \Dao\Checkout::fillProductosOrden($viewData["ordenId"]);
        }else{
            $this->noProducts();
        }

        if($viewData["ordenProducto"] == false){
            $this->noProducts();
        }

        \Views\Renderer::render("paypal/checkout", $viewData);
    }
}
?>
