<?php
require_once('layout/headers/headInicio.php');
require_once('layout/headers/headSuperbox.php');
require_once('layout/headers/headBlockUI.php');
require_once('layout/headers/headValidate.php');
require_once('layout/headers/headPedidos.php');
require_once('layout/headers/headFin.php');
?>


<?php
if(isset($pedidoGenerado)){
    print_r("<br><br><br><br><br>".$pedidoGenerado);
}
/*if($errores)
    print_r('Se generó correctamente su pedido');
else
    print_r('Ocurrió un error durante la generación de su pedido');*/
    
if(isset($_SESSION['email'])){
    print_r('Forma de Pago: <br>');
    require_once 'modulos/pagos/modelos/PayPalModelo.php';
    $botonPaypal = encriptarInformacionBotonPago("Pedido a Restaurante", "123456", $_SESSION['precioTotal'], "6934827");
    echo $botonPaypal;
}
require_once('layout/footer.php');
?>