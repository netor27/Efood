<?php
require_once('layout/headers/headInicio.php');
?>
<script src="js/mostrarIngredientes.js"></script>
<?php
require_once('layout/headers/headFin.php');
?>
<div id="modalDialogBorrarIngredientes"></div>
<div class="row-fluid"><div class="span12"></div></div>
<div class="row-fluid"><div class="span12"></div></div>
<h2>Ingredientes del grupo: <?php echo $grupoIngredientes->nombre; ?></h2>
<h4>
    <a href="<?php echo "ingredientes.php?a=agregarIngrediente&g=" . $grupoIngredientes->idGrupoIngredientes; ?>">
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