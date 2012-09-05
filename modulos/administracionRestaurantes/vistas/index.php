<?php
require_once('layout/headers/headInicio.php');
require_once('layout/headers/headFin.php');
?>
<h1>Pagina de inicio de administracion de restaurantes</h1>
<br>
<h2><a href="restaurantes.php?a=editar&i=<?php echo $restaurante->idRestaurante; ?>">Datos del restaurante</a></h2>
<h2><a href="restaurantes.php?a=menu&i=<?php echo $restaurante->idRestaurante; ?>">Menu</a></h2>
<h2><a href="#">Estado de cuenta</a></h2>
<h2><a href="adminRestaurante.php?a=logout">Logout</a></h2>
<br><br>
<h2><a href="/">Regresar</a></h2>
<?php
require_once('layout/footer.php');
?>