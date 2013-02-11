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
                    <th>idPedido</th>
                    <th>idRestaurante</th>
                    <th>idUsuario</th>
                    <th>idEstadoPedido</th>
                    <th>Comentario</th>
                    <th>Metodo entrega</th>
                    <th>Tipo pago</th>
                    <th>Número de referencia</th>
                    <th>Total</th>
                    <th>Gasto de envío</th>
                    <th>Comisión</th>
                </tr>
                <?php
                foreach ($pedidos as $pedido) {
                    echo '<tr>';
                    echo '<td>' . $pedido['idPedido'] . '</td>';
                    echo '<td>' . $pedido['idRestaurante'] . '</td>';
                    echo '<td>' . $pedido['idUsuario'] . '</td>';
                    echo '<td>' . $pedido['idEstadoPedido'] . '</td>';
                    echo '<td>' . $pedido['comentario'] . '</td>';
                    echo '<td>' . getTextoMetodoEntrega($pedido['idMetodoEntrega']) . '</td>';
                    echo '<td>' . getTextoFormaDePago($pedido['idTipoPago']) . '</td>';
                    echo '<td>' . $pedido['numReferencia'] . '</td>';
                    echo '<td>' . $pedido['total'] . '</td>';
                    echo '<td>' . $pedido['gastoDeEnvio'] . '</td>';
                    echo '<td>' . $pedido['comision'] . '</td>';
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
    <a href="/adminRestaurante.php">Regresar</a>
</div>
<?php
require_once('layout/footer.php');
?>