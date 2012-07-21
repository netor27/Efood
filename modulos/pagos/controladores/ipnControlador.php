<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once("modulos/ipn/clases/ipnMensaje.php");

function analizarIpnMensaje($ipnMensaje){
    require_once('modulos/ventas/modelos/ventas.php');
    switch ($ipnMensaje->txn_type) {
        case 'subscr_signup':
            subscr_signup($ipnMensaje);
            break;
        case 'subscr_cancel':
            subscr_cancel($ipnMensaje);
            break;
        case 'subscr_eot':
            subscr_eot($ipnMensaje);
            break;
       case 'subscr_payment':
            subscr_payment($ipnMensaje);
            break;
        default:
            error(234, 'Opción de IPNMessage inexistente');
            break;
    }
}

?>
