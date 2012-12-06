<?php

require_once("modulos/pagos/clases/ipnMensaje.php");

function analizarIpnMensaje($ipnMensaje) {
    //Falta hacer esta parte
    //verificamos que tipo de mensaje es
    switch ($ipnMensaje->txn_type) {
        case 'cart':
        case 'express_checkout':
        case 'web_accept':
            //Si es este tipo de mensaje, entonces alguien realizó un pago
            //hay que recargar el saldo
            if ($ipnMensaje->payment_status == "Completed") {
                require_once 'modulos/pagos/controladores/pagosControlador.php';
                return manejarMensajePagoSatisfactorio($ipnMensaje->custom, $ipnMensaje->mc_gross);
            } else {
                return "<br>El mensaje no es de un pago completo<br>";
            }
            break;
        //cualquier otro tipo de mensajes, no los tomamos en cuenta, esos se
        //verificarán manualmente
        default:
            //Caso no reconocido, no hacer nada
            return '<br>Caso no reconocido.';
            break;
    }
}

?>
