<?php
require_once('layout/headers/headInicio.php');
require_once('layout/headers/headFin.php');
?>
<div class="row-fluid"><div class="span12"></div></div>
<div class="row-fluid"><div class="span12"></div></div>
<h1>Pagina administracion de pedidos</h1>
<br>
<div style="margin-left: 15px;">
    <h3><a href="adminRestaurante.php?a=pedidosPorAceptar">Pedidos Por Aceptar</a></h3>
    <h3><a href="adminRestaurante.php?a=pedidosActivos">Pedidos Activos</a></h3>
    <h3><a href="adminRestaurante.php?a=pedidosRechazados">Pedidos Rechazados</a></h3>
    <h3><a href="adminRestaurante.php?a=pedidosEntregados">Pedidos Entregados</a></h3>
    <h5><a href="/adminRestaurante.php">Regresar</a></h5>
</div>
<?php
require_once('layout/footer.php');
?>