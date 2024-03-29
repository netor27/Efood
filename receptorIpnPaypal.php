<?php

$emailtext = "mensaje recibido";
$subject = "IPN MSG";

$url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
$host = 'Host: www.sandbox.paypal.com';

//Si en paypal esta configurado un email como variable de get, enviamos a ese mail
//sino, se envía por default a un mail establecido
if (isset($_GET['email']))
    $email = $_GET['email'];
else
    $email = 'neto.webmaster.r27@gmail.com';
//Se tiene que regresar el mismo post a paypal con cmd=_notify-validate
//para validar que lo que se haya recibido si venga de paypal
$req = 'cmd=' . urlencode('_notify-validate');

//Concatenamos todas las variables que recibimos de paypal
foreach ($_POST as $key => $value) {
    $value = urlencode(stripslashes($value));
    $req .= "&$key=$value";
}

//Se hace un post a paypal y se le la respuesta
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_HTTPHEADER, array($host));
$res = curl_exec($ch);
curl_close($ch);

//Si la respuesta contiene VERIFIED, si es un mensaje de paypal válido,
//lo procesamos
if (strcmp($res, "VERIFIED") == 0) {
    require_once('modulos/pagos/modelos/ipnModelo.php');

    $ipnMensaje = new IpnMensaje();
    $ipnMensaje->complete_post = $req;
    //Guardamos los datos que recibimos de paypal en un objeto
    if (isset($_POST['txn_type']))
        $ipnMensaje->txn_type = $_POST['txn_type'];
    if (isset($_POST['txn_id']))
        $ipnMensaje->txn_id = $_POST['txn_id'];
    if (isset($_POST['receiver_email']))//EL MAIL REGISTRADO EN PAYPAL DE PARTE DE EFOOD
        $ipnMensaje->receiver_email = $_POST['receiver_email'];
    if (isset($_POST['item_name']))
        $ipnMensaje->item_name = $_POST['item_name'];
    if (isset($_POST['item_number']))
        $ipnMensaje->item_number = $_POST['item_number'];
    if (isset($_POST['payment_status']))//CORRECT BIEN O ALGO ASI
        $ipnMensaje->payment_status = $_POST['payment_status'];
    if (isset($_POST['parent_txn_id']))
        $ipnMensaje->parent_txn_id = $_POST['parent_txn_id'];
    if (isset($_POST['mc_gross'])) //CUANTO PAGO EL USUARIO A PAYPAL
        $ipnMensaje->mc_gross = $_POST['mc_gross'];
    if (isset($_POST['mc_fee']))//LO QUE COBRO PAYPAL DE COMISION
        $ipnMensaje->mc_fee = $_POST['mc_fee'];
    if (isset($_POST['mc_currency']))//MX
        $ipnMensaje->mc_currency = $_POST['mc_currency'];
    if (isset($_POST['first_name']))
        $ipnMensaje->first_name = $_POST['first_name'];
    if (isset($_POST['last_name']))
        $ipnMensaje->last_name = $_POST['last_name'];
    if (isset($_POST['payer_email']))//MAIL DEL USUARIO, AL Q SE MANDA EL MAIL DE Q SU PAGO SE PROCESO NO SE TOMA EN CUENTA
        $ipnMensaje->payer_email = $_POST['payer_email'];
    if (isset($_POST['payment_date']))//FECHA Y HORA DEL PAGO
        $ipnMensaje->payment_date = $_POST['payment_date'];
    if (isset($_POST['test_ipn']))//1 ES UNA TRANSACCION DE PRUEBA SI 0 TRANSACCION REAL
        $ipnMensaje->test_ipn = $_POST['test_ipn'];
    if (isset($_POST['custom']))//ID DEL PEDIDO QUE YO GENERÉ
        $ipnMensaje->custom = $_POST['custom'];

    $mensaje = "";
    //validamos que no hayamos recibido antes este mensaje, ya que paypal puede enviarlos dobles
    if (txnRecibido($ipnMensaje->txn_id)) {
        $mensaje = "El txn_id=" . $ipnMensaje->txn_id . " ya había sido recibido";
    } else {
        //el mensaje no se había recibido, entonces agregamos el mensaje a la bd y procesamos
        //la información
        $id = agregarIpnMensaje($ipnMensaje);
        if (is_array($id)) {
            $mensaje = "ERROR al agregar a la bd errorInfo => " . implode(", ", $id);
        } else {
            if ($id < 0) {
                $mensaje = "ERROR al agregar a la bd <br><br><br>";
            } else {
                $mensaje = "Se agregó correctamente el mensaje<br><br>";
                require_once 'modulos/pagos/controladores/ipnControlador.php';
                analizarIpnMensaje($ipnMensaje);
            }
        }
    }
    $subject = "IPN Paypal Valido";
    $emailtext = $mensaje . "<br>" . $ipnMensaje->toString();
} else if (strcmp($res, "INVALID") == 0) {
    // El mensaje que llego no es válido, INVESTIGAR
    $emailtext = "";
    foreach ($_POST as $key => $value) {
        $emailtext .= $key . " = " . $value . "<br>";
    }
    $msg = "Se recibio un IPN de paypal invalido. <br> estos son los datos:<br><br>";

    $subject = "IPN Paypal Invalido";
    $emailtext = $msg . "<br><br>" . $emailtext;
}
require_once 'modulos/mail/modelos/mailModelo.php';
enviaMailSMTP($subject, $emailtext, "no-reply@efood.com.mx", $email);
?>