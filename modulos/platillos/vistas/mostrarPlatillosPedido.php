<?php
require_once('layout/headers/headInicio.php');
require_once('layout/headers/headSuperbox.php');
require_once('layout/headers/headBlockUI.php');
require_once('layout/headers/headValidate.php');
require_once('layout/headers/headPedidos.php');
require_once('layout/headers/headFin.php');
?>
<h1>efood</h1>
<h2>Platillos del restaurante <?php echo $restaurante->nombre; ?></h2>
<?php
echo "Pedido M&iacute;nimo: " . $restaurante->pedidoMinimo;
$_SESSION['pedidoMinimo'] = $restaurante->pedidoMinimo;
echo "<br>Gasto de Env&iacute;o: " . $restaurante->gastoEnvio;
$_SESSION['pedidoMinimo'] = $restaurante->gastoEnvio;
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

<div id="pedidos" name="pedidos">
    <?php
    $pedidos = obtenPedidos();
    $total = 0;
    if (isset($pedidos)) {
        foreach ($pedidos as $key => $value) {
            foreach($value as $clave=>$valor){
                echo $valor[1] . " "; //cantidad
                echo $valor[0] . " "; //nombre
                //echo $value[2]; //especificaciones
                echo $valor[3] . " "; //total
                $total+=$valor[3];
                echo "<br>";
            }
        }
        echo "Total: " . $total;
        echo "<br><a href='pedidos.php?a=pedir'>Pedir</a>";
    }
    ?>
</div>

<?php
require_once('layout/footer.php');
?>