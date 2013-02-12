<?php
require_once('layout/headers/headInicio.php');
require_once('layout/headers/headFin.php');
?>
<div class="row-fluid"><div class="span12"></div></div>
<div class="row-fluid"><div class="span12"></div></div>
<h1>Pagina de inicio de administracion de restaurantes</h1>
<br>
<div style="margin-left: 15px;">
    <h3><a href="adminRestaurante.php?a=adminPedidos">Administración de pedidos</a></h3>
    <h3><a href="restaurantes.php?a=editar&i=<?php echo $restaurante->idRestaurante; ?>">Datos del restaurante</a></h3>
    <h3><a href="restaurantes.php?a=menu&i=<?php echo $restaurante->idRestaurante; ?>">Menu</a></h3>
    <h3><a >Estado de cuenta</a></h3>
    <h3><a href="adminRestaurante.php?a=logout">Logout</a></h3>
    <br><br>
    <h5><a href="/">Regresar</a></h5>
</div>
<?php
require_once('layout/footer.php');
?>