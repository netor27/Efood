<?php
require_once('layout/headers/headInicio.php');
require_once('layout/headers/headFin.php');
?>
<h1>efood</h1>

<?php
if (isset($error)) {
    echo '<h2 style="color: red">' . $error . '</h2>';
}
?>

<br>
<h2>Logo actual</h2>
<img src="<?php echo $restaurante->logo; ?>" alt="logo">
<h2>Actualizar Logo</h2>
<form action="restaurantes.php?a=actualizarLogoSubmit" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="idRestaurante" value="<?php echo $idRestaurante; ?>">
       <ul>
        <li>
            <label>Logo</label>
            <input type="file" name="logo" id="logo" /> 
        </li>
        <li>
            <label></label>
            <input type="submit" value="  Aceptar  "/>
        </li>
    </ul>
</form>
<br><br>
<a href="restaurantes.php">Regresar</a>

<?php
require_once('layout/footer.php');
?>