<?php
require_once('layout/headers/headInicio.php');
require_once('layout/headers/headFin.php');
?>
<h1>efood</h1>
<h2>Ingredientes del grupo: <?php echo $grupoIngredientes->nombre; ?></h2>
<h3 style="color:red;"><?php echo getSessionMessage(); ?></h4>
<h4>
    <a href="<?php echo "ingredientes.php?a=agregarIngrediente&g=". $grupoIngredientes->idGrupoIngredientes; ?>">
        Agregar ingrediente
    </a>
</h4>
<table border="1">
    <?php
    require_once 'modulos/platillos/clases/Ingrediente.php';
    Ingrediente::printIngredienteHeader();
    if (isset($ingredientes)) {
        foreach ($ingredientes as $ingrediente) {
            $ingrediente->printIngrediente();
        }
    }
    ?>
</table>
<a href="grupoIngredientes.php?&i=<?php echo $grupoIngredientes->idPlatillo; ?>">Regresar</a>

<?php
require_once('layout/footer.php');
?>