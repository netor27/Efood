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
        //el ultimo numero no se bien que va, estoy poniendo el email del usuario
        $botonPaypal = encriptarInformacionBotonPago("Pedido a ".$restaurante->nombre, $errores, $_SESSION['precioTotal'], $_SESSION['email']); //errores trae el id del insert del pedido
        //pero dice errores porque es un booleano que trae true si el insert no se pudo realizar        
        echo $botonPaypal;
    }
}
?>
<a href="#" id="terminap">Pedir</a>
</form>

<?php
    require_once('layout/footer.php');
?>