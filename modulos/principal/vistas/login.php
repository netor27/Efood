
<?php
$pagina = getUrl();
if (isset($_COOKIE['email']) && isset($_COOKIE['clv'])) {
    require_once 'modulos/principal/modelos/login.php';
    getLogin($_COOKIE['email'], $_COOKIE['clv']);
}
if (isset($_SESSION['email'])) {
    if (isset($_SESSION['habilitado']) && $_SESSION['habilitado'] != '1') {
        
    }
    $aux = explode("@", $_SESSION['email']);
    $nombreDePila = $aux[0];
    ?>
    <div class="row-fluid">
        <div class="span6">
            <div class="saludoTextRed">
                Hola <?php echo $nombreDePila; ?>!!
            </div>
        </div>
        <div class="span6 headerSocial">
            <div class="span5 centerText">
                <a href="https://twitter.com/eFoodMX" class="socialRedText" target="_blank">
                    <img src="layout/imagenes/Home/twitterCheff.png"><br>
                    <span >Síguenos</span>
                </a>
            </div>
            <div class="span7 centerText">
                <a href="http://www.facebook.com/eFoodMX" class="socialRedText" target="_blank">
                    <img src="layout/imagenes/Home/facebookCheff.png"><br>
                    <span >Se nuestro fan</span>
                </a>
            </div>
        </div>
    </div>
    <?php
} else {
    ?>
    <div class="row-fluid">    
        <div class="span12">
            <div class="headerTextRed">Hola! Te puedes registrar <a class="entrarBtn"> aquí </a></div>
        </div>
    </div>
    <div class="row-fluid">    
        <div class="span12">
            <div class="span3 headerTextRed">o mejor</div>
            <div class="span9">
                <a href="
                <?php
                global $loginUrl;
                echo $loginUrl;
                ?>"
                   >
                    <img src="layout/imagenes/Home/btn_EntraConFB_193x23.png">
                </a>
            </div>
        </div>
    </div>


    <div id="modalDialogLogin" title="Bienvenido" style="display: none;">
        <div class="row-fluid">
            <h4><strong>Inicia Sesión</strong></h4>
            <form action="login.php?a=login" method="post">
                <div class="row-fluid">
                    <label class="span4">Correo electrónico:</label>
                    <input class="span8" type="text" name="usuario" id="usuario" />
                </div>
                <div class="row-fluid">
                    <label class="span4">Contraseña:</label>
                    <input class="span8" type="password" name="password" id="password"/>
                </div>
                <div class="row-fluid">
                    <div class="span5">
                        <input type="checkbox" name="recuerdame" id="recuerdame" value="1">No cerrar sesión
                    </div>
                    <div class="span5">
                        <input type="image" src="layout/imagenes/Home/btn_entrar_149x20.png" />
                    </div>
                </div>
                <input type="hidden" name="pagina" value="<?php echo $pagina; ?>">
            </form>
        </div>
        <div class="row-fluid">
            <div class="span8 offset2">
                <img src="layout/imagenes/login/barraSeparacionLogin.png">
            </div>
        </div>
        <div class="row-fluid">
            <h4><strong>Regístrate</strong></h4>
            <form action="usuarios.php?a=altaSubmit" method="post">
                <div class="row-fluid">
                    <label class="span4">Correo electrónico:</label>
                    <input class="span8" type="text" name="email" id="usuario" />
                </div>
                <div class="row-fluid">
                    <label class="span4">Contraseña:</label>
                    <input class="span8" type="password" name="password" id="password"/>
                </div>
                <div class="row-fluid">
                    <label class="span4">Confirma contraseña:</label>
                    <input class="span8" type="password" name="passwordr" id="password"/>
                </div>
                <div class="row-fluid">
                    <div class="span12">
                        <input type="checkbox" name="terminos" id="terminos" value="1">
                        He leido y acepto <a href="#">los términos y condiciones</a>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span5 offset5">
                        <input type="image" src="layout/imagenes/login/btnRegistrame.png" />
                    </div>
                </div>
                <input type="hidden" name="pagina" value="<?php echo $pagina; ?>">
            </form>
        </div>
    </div>

    <!--        <div class="right" id="entrarConFacebook">
                <span>O mejor</span>
                <img src="layout/imagenes/Home/btn_EntraConFB_193x23.png" alt="entra con facebook">
            </div>-->
    <?php
}
if (isset($msgLogin))
    echo '<div class="error">' . $msgLogin . '</div>';
?>