<?php
require_once('layout/headers/headInicio.php');
require_once('layout/headers/headPedidos.php');
require_once('layout/headers/headAutocompleteColonias.php');
require_once('layout/headers/headFin.php');
?>
<?php
if (isset($_SESSION['email'])) {
?>
<!--Escoge el metodo de pago:<br><br>
<form id="metodoPago" method="POST" action="">
    <input type="radio" name="grupo"/><label>En efectivo</label><br><br>
    <input type="radio" name="grupo"/><label>Paypal</label>-->
<?php
    if($_GET['p']==1){
        require_once 'modulos/pagos/modelos/PayPalModelo.php';
        $botonPaypal = encriptarInformacionBotonPago("Pedido a Restaurante", "123456", $_SESSION['precioTotal'], "6934827");
        echo $botonPaypal;
    }
}
?>
    <input type="button" value="pedir"/>
</form>

<?php
    require_once('layout/footer.php');
?>