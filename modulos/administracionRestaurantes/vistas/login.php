<!DOCTYPE html>
<html lang="es" xml:lang="es">
    <meta charset="utf-8" />
    <body>
        <h1>Login Restaurante</h1>
        <?php
        require_once 'funcionesPHP/funcionesGenerales.php';
        $mensaje = getSessionMessage();
        if (isset($mensaje)) {
            echo $mensaje;
        }
        ?>
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
    </body>
</html>