<?php
require_once('layout/headers/headInicio.php');
require_once('layout/headers/headSuperbox.php');
require_once('layout/headers/headBlockUI.php');
require_once('layout/headers/headValidate.php');
require_once('layout/headers/headPedidos.php');
require_once('layout/headers/headFin.php');
?>
<h1>efood</h1>
<h2>Pedidos</h2>
<table border="1">
    <?php
    foreach($pedidos as $pedido)    
        $pedido->printPedido();
    ?>
</table>
<a href="index.php">Regresar</a>

<?php
require_once('layout/footer.php');
?>