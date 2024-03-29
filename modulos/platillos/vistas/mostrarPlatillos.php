<?php
require_once('layout/headers/headInicio.php');
?>
<script src="js/mostrarPlatillos.js"></script>
<?php
require_once('layout/headers/headFin.php');
?>
<div id="modalDialogBorrarPlatillo"></div>
<div class="row-fluid"><div class="span12"></div></div>
<div class="row-fluid"><div class="span12"></div></div>
<h2>Platillos del restaurante <?php echo $restaurante->nombre; ?></h2>
<h4><a href="platillos.php?c=categorias&i=<?php echo $restaurante->idRestaurante; ?>">Administrar categorías de platillos</a></h4>
<h4><a href="platillos.php?a=alta&r=<?php echo $restaurante->idRestaurante; ?>">Agregar platillo</a></h4>
<h4><a href="platillos.php?a=duplicar&r=<?php echo $restaurante->idRestaurante; ?>">Duplicar platillo</a></h4>
<div style="width: 100%;overflow-x: scroll;">
    <table border="1">
        <?php
        require_once 'modulos/platillos/clases/Platillo.php';
        Platillo::printHeader();
        if (isset($platillos)) {
            foreach ($platillos as $platillo) {
                $platillo->printPlatillo();
            }
        }
        ?>
    </table>
</div>
<?php
$restauranteLoggeado = getRestauranteLoggeado();
if (isset($restauranteLoggeado)) {
    echo '<a href="adminRestaurante.php">Regresar</a>';
} else {
    echo '<a href="restaurantes.php">Regresar</a>';
}
?>

<?php
require_once('layout/footer.php');
?>