<?php
require_once('layout/headers/headInicio.php');
require_once('layout/headers/headFin.php');
?>
<div class="row-fluid"><div class="span12"></div></div>
<div class="row-fluid"><div class="span12"></div></div>
<div style="margin-left: 15px;">
    <div class="row-fluid">
        <legend>Detalles del pedido</legend>
        <?php
        if (isset($platillos)) {
            $aux = $platillos[0];
            ?>
            <div class="row-fluid">
                <div class="span4">
                    <strong>Id Pedido: </strong> <?php echo $aux['idPedido']; ?>
                </div>
                <div class="span4">
                    <strong>Método de entrega: </strong> <?php echo getTextoMetodoEntrega($aux['idMetodoEntrega']); ?>
                </div>
                <div class="span4">
                    <strong>Tipo de pago: </strong> <?php echo getTextoFormaDePago($aux['idTipoPago']); ?>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span4">
                    <strong>Gastos de Envío: </strong> <?php echo $aux['gastoDeEnvio']; ?>    
                </div>
                <div class="span4">
                    <strong>Total: </strong> <?php echo $aux['total']; ?>
                </div>
                <div class="span4">
                    <strong>Comisión: </strong> <?php echo $aux['comision']; ?>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span8">
                    <strong>Número de referencia: </strong> <?php echo $aux['numReferencia']; ?>
                </div>
                <div class="span4">
                    <strong>Estado del pedido: </strong> <?php echo getTextoEstadoPedido($aux['idEstadoPedido']); ?>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span12">
                    <legend>Platillos del pedido</legend>
                </div>
            </div>
            <?php
            $platillosImpresos = array();
            foreach ($platillos as $platillo) {
                $idPlatillo = $platillo['idPlatillo'];
                in_array($idPlatillo, $platillosImpresos);
                ?>
                <div class="row-fluid">
                    <div class="span4">
                        <strong>Nombre: </strong> <?php echo $platillo['nombre']; ?>
                    </div>                    
                    <div class="span4">
                        <strong>Cantidad: </strong> <?php echo $platillo['cantidad']; ?>
                    </div>
                    <div class="span4">
                        <strong>Precio: </strong> <?php echo $platillo['precio']; ?>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span12">
                        <strong>Especificaciones: </strong> <?php echo $platillo['especificaciones']; ?>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span12">
                        <strong>Ingredientes: </strong>
                        <?php
                        foreach ($platillos as $auxPlatillo) {
                            if ($idPlatillo === $auxPlatillo['idPlatillo']) {
                                echo $auxPlatillo['nombreIngrediente'] . ', ';
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="row-fluid">
                    <legend></legend>
                </div>
                <?php
                array_push($platillosImpresos, $idPlatillo);
            }
            ?>
            <div class="row-fluid">
                <?php
                if ($aux['idEstadoPedido'] == 1) {
                    ?>
                    <div class="span2 offset3">
                        <a href="/adminRestaurante.php?a=aceptarPedido&t=<?php echo $t; ?>&i=<?php echo $aux['idPedido']; ?>">Aceptar pedido</a>
                    </div>
                    <div class="span2 offset2">
                        <a href="/adminRestaurante.php?a=rechazarPedido&t=<?php echo $t; ?>&i=<?php echo $aux['idPedido']; ?>">Rechazar pedido</a>
                    </div>
                    <?php
                } else if ($aux['idEstadoPedido'] == 2) {
                    ?>
                    <div class="span2 offset3">
                        <a href="/adminRestaurante.php?a=pedidoEntregado&t=<?php echo $t; ?>&i=<?php echo $aux['idPedido']; ?>">Pedido entregado</a>
                    </div>
                    <div class="span2 offset2">
                        <a href="/adminRestaurante.php?a=rechazarPedido&t=<?php echo $t; ?>&i=<?php echo $aux['idPedido']; ?>">Rechazar pedido</a>
                    </div>
                    <?php
                }
                ?>
            </div>
            <?php
        } else {
            echo '<h3>Error al obtener de la bd los datos del pedido</h3>';
        }
        ?>
    </div>
    <?php
    echo '<a href="/adminRestaurante.php?a=' . $t . '">Regresar</a>';
    ?>

</div>
<?php
require_once('layout/footer.php');
?>