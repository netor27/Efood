<?php
require_once('layout/headers/headInicio.php');
require_once('layout/headers/headFin.php');
?>
<h1>Login Restaurante</h1>
<form method="post" action="adminRestaurante.php?a=login">
    <h2>Nombre de usuario</h2>
    <input type="text" name="usuario">
    <h2>Password</h2>
    <input type="password" name="pass">
    <br><br>
    <input type="submit" name="Aceptar" value="  Aceptar  ">
    <?php
    if (isset($pagina)) {
        echo '<input type="hidden" name="pagina" value="' . $pagina . '"/>';
    }
    ?>
</form>
<br><br>
<h2><a href="/">Regresar</a></h2>
<?php
require_once('layout/footer.php');
?>