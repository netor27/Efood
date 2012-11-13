<?php
if (isset($_SESSION['email'])) {
    print_r('Forma de Pago: <br>');
?>
Escoge el metodo de pago:<br><br>
<form id="metodoPago" method="POST" action="">
    <input type="radio" name="grupo"/><label>En efectivo</label><br><br>
    <input type="radio" name="grupo"/><label>Paypal</label>
<?php
    require_once 'modulos/pagos/modelos/PayPalModelo.php';
    $botonPaypal = encriptarInformacionBotonPago("Pedido a Restaurante", "123456", $_SESSION['precioTotal'], "6934827");
    echo $botonPaypal;
}
?>
    <input type="button" value="pedir"/>
</form>