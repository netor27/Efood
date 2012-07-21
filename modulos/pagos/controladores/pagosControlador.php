<?php

function principal() {
    echo 'principal';
}

function pagoSatisfactorio() {    
    require_once 'modulos/pagos/vistas/pagoSatisfactorio.php';    
}

function receptorMensajeIpnPayPal(){
    require_once 'modulos/pagos/clases/manejadorPagosPayPal.php';
    handlePaypalIpnMessage();
}