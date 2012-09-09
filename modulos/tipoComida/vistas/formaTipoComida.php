<?php
require_once('layout/headers/headInicio.php');
require_once('layout/headers/headFin.php');
?>

<h2><?php echo $tipo; ?> tipo comida</h2>
<?php
if (isset($error)) {
    echo '<h2 style="color: red">' . $error . '</h2>';
}
?>

<form action="tiposComida.php?a=formaTipoComidaSubmit&t=<?php echo $tipo; ?>" method="POST" enctype="multipart/form-data">
    <?php
    if ($tipo == "editar")
        echo '<input type="hidden" name="idTipoComida" value="' . $tipoComida->idTipoComida . '">';
    ?>
    <ul>
        <li>
            <label>Nombre</label>
            <input type="text" name="nombre" value="<?php echo $tipoComida->nombre; ?>">
        </li>
        <li>
            <label>Sube una imágen de 70x70 pixeles</label>
            <?php
            if ($tipo == "editar") {
                ?>
                <h3>Imagen actual:</h3>
                <img src="<?php echo $tipoComida->imagen; ?>"/><br>
                <?php
            }
            ?>
            <br>
            <input type="file" name="logo" id="logo" /> 
        </li>
        <li>
            <label></label><br><br><br>
            <input type="submit" value="  Aceptar  "/>
        </li>
    </ul>
</form>

<?php
$tipoComidaLoggeado = getRestauranteLoggeado();
if (isset($tipoComidaLoggeado)) {
    echo '<a href="adminRestaurante.php">Regresar</a>';
} else {
    echo '<a href="restaurantes.php">Regresar</a>';
}
?>

<?php
require_once('layout/footer.php');
?>