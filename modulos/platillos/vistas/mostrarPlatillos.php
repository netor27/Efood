<?php
require_once('layout/headers/headInicio.php');
require_once('layout/headers/headFin.php');
?>
<h1>efood</h1>
<h2>Platillos del restaurante <?php echo $restaurante->nombre; ?></h2>
<h4><a href="platillos.php?a=alta&r=<?php echo $restaurante->idRestaurante; ?>">Agregar platillo</a></h4>
<h4><a href="platillos.php?a=duplicar&r=<?php echo $restaurante->idRestaurante; ?>">Duplicar platillo</a></h4>
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