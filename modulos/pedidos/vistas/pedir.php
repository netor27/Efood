<?php
require_once('layout/headers/headInicio.php');
require_once('layout/headers/headSuperbox.php');
require_once('layout/headers/headBlockUI.php');
require_once('layout/headers/headValidate.php');
require_once('layout/headers/headPedidos.php');
require_once('layout/headers/headFin.php');
?>
<h1>efood</h1>

<?php
if($errores)
    print_r('Ocurrió un error durante la generación de su pedido');
else
    print_r('Se generó correctamente su pedido');
require_once('layout/footer.php');
?>