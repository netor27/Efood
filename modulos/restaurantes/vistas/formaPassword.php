<?php
require_once('layout/headers/headInicio.php');
require_once('layout/headers/headFin.php');
?>
<h1>Cambiar password</h1>
<form method="post" action="restaurantes.php?a=establecerPasswordSubmit">
    <input type="hidden" name="i" value="<?php echo $idRestaurante; ?>">
    <h2>Password</h2>
    <input type="password" name="pass">
    <h2>Repetir password</h2>
    <input type="password" name="pass2">
    <br>
    <input type="submit" value="  Aceptar  ">
</form>
<?php
require_once('layout/footer.php');
?>