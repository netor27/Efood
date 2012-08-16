
<?php
if (isset($_COOKIE['email']) && isset($_COOKIE['clv'])) {
    require_once 'modulos/principal/modelos/login.php';
    getLogin($_COOKIE['email'], $_COOKIE['clv']);
}
if (isset($_SESSION['email'])) {
    $mensaje = "Bienvenido " . $_SESSION['email'] . "<br><a href='login.php?a=logout'>Logout</a>";
    if (isset($_SESSION['habilitado']) && $_SESSION['habilitado'] != '1') {
        $mensaje.="<br>Por favor confirma el correo para usar todas las caracteristicas del sitio";
    }
    echo $mensaje;
} else {
    ?>
    <form action="login.php?a=login" method="post" >
        Username: <input type="text" name="usuario" id="usuario" /><br>
        Password: <input type="password" name="password" id="password" /><br>
        <input type="checkbox" name="recuerdame" id="recuerdame" value="1"> Recu&eacute;rdame<br>
        <input type="submit" value="Enter"/>
    </form>
    <?php
}
if (isset($msgLogin))
    echo '<div class="error">' . $msgLogin . '</div>';
?>