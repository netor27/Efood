
<?php
$pagina = getUrl();
if (isset($_COOKIE['email']) && isset($_COOKIE['clv'])) {
    require_once 'modulos/principal/modelos/login.php';
    getLogin($_COOKIE['email'], $_COOKIE['clv']);
}
if (isset($_SESSION['email'])) {
    $mensaje = "<div class='right'>Bienvenido " . $_SESSION['email'] . "</div><br><div class='right'><a href='login.php?a=logout'>Cerrar Sesión</a></div>";
    if (isset($_SESSION['habilitado']) && $_SESSION['habilitado'] != '1') {
        //$mensaje.="<br>Por favor confirma el correo <br>para usar todas las caracteristicas del sitio";
    }
    echo $mensaje;
} else {
    ?>
    <form action="login.php?a=login" method="post" id="formaLogin">
        <div class="inputElement left">
            <label>Correo electrónico:</label><br>
            <input type="text" name="usuario" id="usuario" class="ui-corner-all"/>
        </div>
        <div class="inputElement left">
            <label>Contraseña:</label><br>
            <input type="password" name="password" id="password" class="ui-corner-all"/><br>            
        </div>
        <br>
        <div class="inputElement left">
            <input type="checkbox" name="recuerdame" id="recuerdame" value="1">No cerrar sesión<br>
        </div>
        <br>
        <div class="inputButton right">
            <input type="image" src="layout/imagenes/Home/btn_entrar_149x20.png" />
        </div>
        <input type="hidden" name="pagina" value="<?php echo $pagina; ?>">
    </form>
    <div class="right" id="entrarConFacebook">
        <span>O mejor</span>
        <img src="layout/imagenes/Home/btn_EntraConFB_193x23.png" alt="entra con facebook">
    </div>
    <?php
}
if (isset($msgLogin))
    echo '<div class="error">' . $msgLogin . '</div>';
?>