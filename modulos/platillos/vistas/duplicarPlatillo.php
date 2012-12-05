<?php
require_once('layout/headers/headInicio.php');
require_once('layout/headers/headFin.php');
?>

<div class="row-fluid"><div class="span12"></div></div>
<div class="row-fluid"><div class="span12"></div></div>
<div class="row-fluid">
    <div class="span8 offset2">
        <h2>Duplicar platillo</h2>
        <form method="post" action="platillos.php?a=duplicarSubmit">
            <input type="hidden" name="idRestaurante" value="<?php echo $idRestaurante; ?>">
            <br>
            <select name="idPlatillo">
                <?php
                foreach ($platillos as $platillo) {
                    echo '<option value="' . $platillo->idPlatillo . '">' . $platillo->nombre . '</option>';
                }
                ?>
            </select>
            <br><br>
            <input type="submit" value="Aceptar">
        </form>
        <br><br>
        <a  class="offset1" href="restaurantes.php?a=menu&i=<?php echo $idRestaurante; ?>">Regresar</a>
    </div>
</div>
<?php
require_once('layout/footer.php');
?>