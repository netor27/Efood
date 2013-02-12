<?php
require_once('layout/headers/headInicio.php');
require_once('layout/headers/headFin.php');
?>
<div class="row-fluid"><div class="span12"></div></div>
<div class="row-fluid"><div class="span12"></div></div>
<h1>Pedidos activos</h1>
<br>
<div style="margin-left: 15px;">
    <div class="row-fluid">
        <?php
        if (isset($pedidos)) {
            ?>
            <table border="1">
                <tr>
                    <th style="width:1%">Id Pedido</th>
                    <th style="width:1%">Estado del Pedido</th>                    
                    <th style="width:1%">Metodo entrega</th>
                    <th style="width:1%">Tipo pago</th>
                    <th style="width:1%">Número de referencia</th>
                    <th style="width:1%">Total</th>
                    <th style="width:1%">Gasto de envío</th>
                    <th style="width:1%">Comisión</th>
                    <th style="width:1%">Ver detalles</th>
                </tr>
                <?php
                foreach ($pedidos as $pedido) {
                    echo '<tr>';
                    echo '<td>' . $pedido['idPedido'] . '</td>';
                    echo '<td>' . getTextoEstadoPedido($pedido['idEstadoPedido']) . '</td>';
                    echo '<td>' . getTextoMetodoEntrega($pedido['idMetodoEntrega']) . '</td>';
                    echo '<td>' . getTextoFormaDePago($pedido['idTipoPago']) . '</td>';
                    echo '<td>' . $pedido['numReferencia'] . '</td>';
                    echo '<td>' . $pedido['total'] . '</td>';
                    echo '<td>' . $pedido['gastoDeEnvio'] . '</td>';
                    echo '<td>' . $pedido['comision'] . '</td>';
                    echo '<td><a href="/adminRestaurante.php?a=detallesDePedido&i=' . $pedido['idPedido'] . '" class="btn">Ver detalles</a></td>';
                    echo '</tr>';
                }
                ?>
            </table>
            <?php
        } else {
            echo '<h3>No hay pedidos</h3>';
        }
        ?>
    </div>
    <a href="/adminRestaurante.php?a=adminPedidos">Regresar</a>
</div>
<?php
require_once('layout/footer.php');
?>