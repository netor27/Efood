<?php ?>
<html>
    <body>
        <h1>Cambiar password</h1>
        <?php
        require_once 'funcionesPHP/funcionesGenerales.php';
        $mensaje = getSessionMessage();
        if (isset($mensaje)) {
            echo $mensaje;
        }
        ?>
        <form method="post" action="restaurantes.php?a=establecerPasswordSubmit">
            <input type="hidden" name="i" value="<?php echo $idRestaurante; ?>">
            <h2>Password</h2>
            <input type="password" name="pass">
            <h2>Repetir password</h2>
            <input type="password" name="pass2">
            <br>
            <input type="submit" value="  Aceptar  ">
        </form>
    </body>
</html>