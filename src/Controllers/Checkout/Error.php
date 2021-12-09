<?php

namespace Controllers\Checkout;

use Controllers\PublicController;
class Error extends PublicController
{
    public function run(): void
    {
        echo "error";
        $orden = \Dao\Checkout::getOrden($_SESSION["login"]["userId"]);
        if(Dao\Checkout::guardarCompra(
            "Programa",
            "Orden Rechazada",
            $orden["ordenTotal"],
            $orden["ordenSubtotal"],
            $_SESSION["login"]["userId"],
            "RCH",
            $orden["ordenImpuestos"]
        )){
            
        }
        die();
    }
}

?>
