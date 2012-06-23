<?php
require_once('layout/headers/headInicio.php');
require_once('layout/headers/headSuperbox.php');
require_once('layout/headers/headBlockUI.php');
require_once('layout/headers/headPedidos.php');
require_once('layout/headers/headFin.php');
?>
<h1>efood</h1>
<h2>Platillos del restaurante <?php echo $restaurante->nombre; ?></h2>
<?php 
    echo "Pedido M&iacute;nimo: ".$restaurante->pedidoMinimo;
    echo "<br>Gasto de Env&iacute;o: ".$restaurante->gastoEnvio;
?>
<table border="1">
    <?php
    require_once 'modulos/platillos/clases/Platillo.php';
    Platillo::printPlatilloPedidoHeader();
    if (isset($platillos)) {
        foreach ($platillos as $platillo) {
            $platillo->printPlatilloPedido();
        }
    }
    ?>
</table>
<a href="index.php">Regresar</a>

<?php
require_once('layout/footer.php');
?>
