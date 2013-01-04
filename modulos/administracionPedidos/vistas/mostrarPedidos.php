<?php
require_once('layout/headers/headInicio.php');
require_once('layout/headers/headValidate.php');
require_once('layout/headers/headPedidos.php');
require_once('layout/headers/headFin.php');
?>
<div class="row-fluid"><div class="span12"></div></div>
<div class="row-fluid"><div class="span12"></div></div>
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