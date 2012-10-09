<?php

//require_once('modulos/pagos/modelos/ipnModelo.php');
//
//$ipnMensaje = new IpnMensaje();
//
//if (txnRecibido($ipnMensaje->txn_id)) {
//    echo "El txn_id=" . $ipnMensaje->txn_id . " ya había sido recibido";
//} else {
//    $id = agregarIpnMensaje($ipnMensaje);
//    if ($id >= 0) {
//        echo "Se agregó correctamente el mensaje\n\n\n";
//    }else{
//        echo "error al agregar a la bd";
//    }
//}
//

$total = 100;
$cadena = "($total * 0.05) + 2";
$otraVariable = "Other";
$segunda = "2da";
$otroCambio="cambios diferentes";
$cargoExtra = 0;
eval('$cargoExtra = ' . $cadena . ';');

//aqui cargoextra ya tiene el valor del gasto de envi
echo $cargoExtra;
?>
