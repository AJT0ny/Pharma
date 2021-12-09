<?php

namespace Controllers\Checkout;

use Controllers\PublicController;
class Accept extends PublicController{
    public function returnOrder()
    {
        \Utilities\Site::redirectToWithMsg("index.php?page=checkout_checkout", "No hay una orden para procesar!");
    }

    public function run():void
    {
        \Utilities\Site::addLink("public/css/Accept.css");
        $dataview = array(
            "continuar" => false
        );
        $token = $_GET["token"] ?: "";
        $session_token = $_SESSION["orderid"] ?: "";
        if ($token !== "" && $token == $session_token) {
            $result = \Utilities\Paypal\PayPalCapture::captureOrder($session_token);
            $dataview["orderjson"] = json_encode($result, JSON_PRETTY_PRINT);

            $orden = \Dao\Checkout::getOrden($_SESSION["login"]["userId"]);
            if(\Dao\Checkout::guardarCompra(
                "Programa",
                "Orden Aceptada",
                $orden["ordenTotal"],
                $orden["ordenSubtotal"],
                $_SESSION["login"]["userId"],
                "ACP",
                $orden["ordenImpuestos"]
            )){

            }

            if(\Dao\Checkout::deleteProductosOrden($orden["ordenId"]))
            {
                if(\Dao\Checkout::deleteOrden($_SESSION["login"]["userId"]))
                {
                    $dataview["continuar"] = true;
                }
            }
        } else {
            $this->returnOrder();
        }
        \Views\Renderer::render("paypal/accept", $dataview);
    }
}

?>
