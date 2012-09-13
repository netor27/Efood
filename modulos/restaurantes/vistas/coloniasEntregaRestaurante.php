<?php
require_once('layout/headers/headInicio.php');
require_once('layout/headers/headColoniasEntrega.php');
require_once('layout/headers/headFin.php');
?>

<h2>Colonias de entrega de:"<?php echo $restaurante->nombre; ?>"</h2>
<?php
if (isset($error)) {
    echo '<h2 style="color: red">' . $error . '</h2>';
}
?>


<div class="ui-widget">
    <label>Agregar colonia:</label>
    <input id="colonias" name="colonia" />       
    <input type="hidden" id="idRestaurante" name="idRestaurante" value="<?php echo $restaurante->idRestaurante; ?>">    
</div>

<div class="ui-widget-content" id="coloniasContainer" style="margin-top:2em; min-height: 200px; width: 400px; font-family:Arial">
    <?php
    foreach ($colonias as $colonia) {
        ?>
        <div class="coloniaEntregaContainer" style="width: 100%; overflow: hidden;">
            <div class="ui-state-highlight" style="float: left; width: 395px; ">
                <?php echo $colonia->nombre; ?>
                <div style="float: right;" class="borrarColoniaEntrega">
                    <a class="deleteColoniaEntrega" colonia="<?php echo $colonia->idColonia; ?>" restaurante="<?php echo $restaurante->idRestaurante; ?>">Borrar</a>
                </div>
            </div>

        </div>
    <?php }
    ?>
</div>
<br>
<a href="restaurantes.php">Regresar</a>

<?php
require_once('layout/footer.php');
?>