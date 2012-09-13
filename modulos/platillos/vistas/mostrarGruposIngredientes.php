<?php
require_once('layout/headers/headInicio.php');
require_once('layout/headers/headFin.php');
?>

<h2>Grupos de Ingredientes del platillo <?php echo $platillo->nombre; ?></h2>
<h4>
    <a href="<?php echo "grupoIngredientes.php?a=agregarGrupoIngredientes&p=". $platillo->idPlatillo; ?>">
        Agregar grupo de ingredientes
    </a>
</h4>
<table border="1">
    <?php
    require_once 'modulos/platillos/clases/GrupoIngredientes.php';
    GrupoIngredientes::printGrupoIngredientesHeader();
    if (isset($gruposIngredientes)) {
        foreach ($gruposIngredientes as $grupoIngredientes) {
            $grupoIngredientes->printGrupoIngredientes();
        }
    }
    ?>
</table>
<a href="restaurantes.php?a=menu&i=<?php echo $idRestaurante; ?>">Regresar</a>

<?php
require_once('layout/footer.php');
?>