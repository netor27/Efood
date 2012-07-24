<?php

$emailtext = "mensaje recibido";
$subject = "IPN MSG";

if (isset($_GET['email']))
    $email = $_GET['email'];
else
    $email = 'neto.webmaster.r27@gmail.com';

// read the post from PayPal system and add 'cmd'
$req = 'cmd=' . urlencode('_notify-validate');

foreach ($_POST as $key => $value) {
    $value = urlencode(stripslashes($value));
    $req .= "&$key=$value";
}


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.sandbox.paypal.com/cgi-bin/webscr');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Host: www.sandbox.paypal.com'));
$res = curl_exec($ch);
curl_close($ch);

if (strcmp($res, "VERIFIED") == 0) {
    require_once('modulos/pagos/modelos/ipnModelo.php');

    $ipnMensaje = new IpnMensaje();
    $ipnMensaje->complete_post = $req;

    if (isset($_POST['txn_type']))
        $ipnMensaje->txn_type = $_POST['txn_type'];
    if (isset($_POST['txn_id']))
        $ipnMensaje->txn_id = $_POST['txn_id'];
    if (isset($_POST['receiver_email']))
        $ipnMensaje->receiver_email = $_POST['receiver_email'];
    if (isset($_POST['item_name']))
        $ipnMensaje->item_name = $_POST['item_name'];
    if (isset($_POST['item_number']))
        $ipnMensaje->item_number = $_POST['item_number'];
    if (isset($_POST['payment_status']))
        $ipnMensaje->payment_status = $_POST['payment_status'];
    if (isset($_POST['parent_txn_id']))
        $ipnMensaje->parent_txn_id = $_POST['parent_txn_id'];
    if (isset($_POST['mc_gross']))
        $ipnMensaje->mc_gross = $_POST['mc_gross'];
    if (isset($_POST['mc_fee']))
        $ipnMensaje->mc_fee = $_POST['mc_fee'];
    if (isset($_POST['mc_currency']))
        $ipnMensaje->mc_currency = $_POST['mc_currency'];
    if (isset($_POST['first_name']))
        $ipnMensaje->first_name = $_POST['first_name'];
    if (isset($_POST['last_name']))
        $ipnMensaje->last_name = $_POST['last_name'];
    if (isset($_POST['payer_email']))
        $ipnMensaje->payer_email = $_POST['payer_email'];
    if (isset($_POST['payment_date']))
        $ipnMensaje->payment_date = $_POST['payment_date'];
    if (isset($_POST['test_ipn']))
        $ipnMensaje->test_ipn = $_POST['test_ipn'];
    if (isset($_POST['custom']))
        $ipnMensaje->custom = $_POST['custom'];

    $mensaje = "";
    if (txnRecibido($ipnMensaje->txn_id)) {
        $mensaje = "El txn_id=" . $ipnMensaje->txn_id . " ya había sido recibido";
    } else {
        $id = agregarIpnMensaje($ipnMensaje);
        if (is_array($id)) {
            $mensaje = "ERROR al agregar a la bd errorInfo => " . implode(", ", $id);
        } else {
            if ($id < 0) {
                $mensaje = "ERROR al agregar a la bd \n\n\n";
            } else {
                $mensaje = "Se agregó correctamente el mensaje\n\n\n";
                //analizarIpnMensaje($ipnMensaje);
            }
        }
    }
    $subject = "IPN Paypal Valido";
    $emailtext = $mensaje . "/n/n/n" . $ipnMensaje->toString();
} else if (strcmp($res, "INVALID") == 0) {
    // log for manual investigation
    // If 'INVALID', send an email. TODO: Log for manual investigation.
    $emailtext = "";
    foreach ($_POST as $key => $value) {
        $emailtext .= $key . " = " . $value . "/n";
    }
    $msg = "Se recibio un IPN de paypal invalido. /n estos son los datos:/n/n";

    $subject = "IPN Paypal Invalido";
    $emailtext = $msg . "/n/n" . $emailtext;
}

mail($email, $subject, $emailtext);
?>