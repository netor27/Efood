<?php
require_once('layout/headers/headInicio.php');
require_once('layout/headers/headTiposComida.php');
require_once('layout/headers/headFin.php');
?>
<h1>efood</h1>
<h2>Tipos de comida de:"<?php echo $restaurante->nombre; ?>"</h2>
<?php
if (isset($error)) {
    echo '<h2 style="color: red">' . $error . '</h2>';
}
?>


<div class="ui-widget">
    <label>Agregar tipo comida:</label>
    <input id="tipoComida" name="tipoComida" />       
    <input type="hidden" id="idRestaurante" name="idRestaurante" value="<?php echo $restaurante->idRestaurante; ?>">    
</div>

<div class="ui-widget-content" id="tiposComidaContainer" style="margin-top:2em; min-height: 200px; width: 400px; font-family:Arial">
    <?php
    foreach ($tiposComida as $tipoComida) {
        ?>
        <div class="tipoComidaContainer" style="width: 100%; overflow: hidden;">
            <div class="ui-state-highlight" style="float: left; width: 395px; ">
                <?php echo $tipoComida->nombre; ?>
                <div style="float: right;" class="borrarTipoComida">
                    <a class="deleteTipoComida" tipoComida="<?php echo $tipoComida->idTipoComida; ?>" restaurante="<?php echo $restaurante->idRestaurante; ?>">Borrar</a>
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