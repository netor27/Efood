<?php
require_once('layout/headers/headInicio.php');
require_once('layout/headers/headFin.php');
?>
<h1>efood</h1>
<h2>Duplicar platillo</h2>
<form method="post" action="platillos.php?a=duplicarSubmit">
    <input type="hidden" name="idRestaurante" value="<?php echo $idRestaurante; ?>">
    <br>
    <select name="idPlatillo">
        <?php
        foreach ($platillos as $platillo) {
            echo '<option value="' . $platillo->idPlatillo .'">' . $platillo->nombre . '</option>';
        }
        ?>

    </select>
    <br><br>
    <input type="submit">
</form>
<br><br>
<a href="restaurantes.php?a=menu&i=<?php echo $idRestaurante; ?>">Regresar</a>

<?php
require_once('layout/footer.php');
?>