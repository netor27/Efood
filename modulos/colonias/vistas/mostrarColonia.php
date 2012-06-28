<?php
require_once('layout/headers/headInicio.php');
require_once('layout/headers/headFin.php');
?>
<h1>efood</h1>
<h2>Colonia <?php echo $colonia->nombre; ?></h2>
<h4></h4>
<table border="1">
    <?php
    require_once 'modulos/colonias/clases/Colonia.php';
    Colonia::printColoniaHeader();
    if (isset($colonia)) {
        $colonia->printColonia();
    }
    ?>
</table>
<a href="restaurantes.php">Regresar</a>

<?php
require_once('layout/footer.php');
?>