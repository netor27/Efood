<?php
require_once('layout/headers/headInicio.php');
require_once('layout/headers/headFin.php');
?>
<h2>Todos los restaurantes</h2>
<h4><a href="tiposComida.php">Administrar tipos de comida</a></h4>
<h4><a href="restaurantes.php?a=alta">Agregar restaurante</a></h4>
<div style="width:100%;overflow-x: scroll;">
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
</div>
<a href="index.php">Regresar</a>
<?php
require_once('layout/footer.php');
?>