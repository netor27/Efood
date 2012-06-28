<?php
require_once('layout/headers/headInicio.php');
require_once('layout/headers/headFin.php');
?>
<h1>efood</h1>
<h2>Todos los restaurantes</h2>
<h4><a href="restaurantes.php?a=alta">Agregar restaurante</a></h4>
<h4 style="color: red;"><?php echo getSessionMessage(); ?></h4>
<table border="1">
    <?php
    require_once 'modulos/restaurantes/clases/Restaurante.php';
    Restaurante::printRestauranteHeader();
    if (isset($restaurantes)) {
        foreach ($restaurantes as $restaurante) {
            $restaurante->printRestaurante();
        }
    }
    ?>
</table>
<a href="index.php">Regresar</a>
<?php
require_once('layout/footer.php');
?>