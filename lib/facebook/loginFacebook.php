<?php

//Application Configurations
$app_id = "499264860093463";
$app_secret = "f6ea22c4aab9f138fbd2eaea06f3dd69";
$site_url = "http://www.efood.com.mx";
try {
    include_once "lib/facebook/src/facebook.php";
} catch (Exception $e) {
    error_log($e);
    echo $e;
}
// Create our application instance
$facebook = new Facebook(array(
            'appId' => $app_id,
            'secret' => $app_secret,
        ));

// Get User ID
$user = $facebook->getUser();

if ($user) {
    // Get logout URL
    $logoutUrl = $facebook->getLogoutUrl();
    $queries = array(
        array('method' => 'GET', 'relative_url' => '/' . $user)
    );

    try {
        $batchResponse = $facebook->api('?batch=' . json_encode($queries), 'POST');
    } catch (Exception $o) {
        error_log($o);
    }
    $user_info = json_decode($batchResponse[0]['body'], TRUE);
} else {
    //No hay usuario
    // Get login URL
    global $loginUrl;
    $loginUrl = $facebook->getLoginUrl(array(
        'scope' => 'email',
        'redirect_uri' => $site_url
            ));
    //Guardamos la página desde la cual le dieron inciar sesión
    $_SESSION['paginaLoginFacebook'] = getUrl();
}

//si ya inicio sesión en facebook, entonces hacemos varias validaciones
if ($user) {
    //tenemos un usuario logeado en facebook
    //Datos de facebook
    $email = $user_info['email'];
    $nombre = $user_info['name'];
    //$avatar = 'http://graph.facebook.com/' . $user . '/picture?type=normal';
    require_once 'modulos/principal/modelos/login.php';
    require_once 'modulos/usuarios/modelos/usuarioModelo.php';
    //validamos si este usuario ya tiene su email registrado, sino creamos un usuario nuevo
    $usuario = getUsuarioFromEmail($email);
    //si no es su mail principal, validamos si lo tiene guardado como mailFacebook
    if (!isset($usuario)) {
        //el usuario no existe en la bd, crearlo!
        require_once 'modulos/usuarios/clases/Usuario.php';
        $usuario = new Usuario();
        $usuario->email = $email;
        $usuario->habilitado = 1;
        $usuario->password = md5(getUniqueCode(10));
        $usuario->tipo = 0;

        $id = crearUsuario($usuario);
        $usuario->idUsuario = $id;
        if ($id >= 0) {
            if (loginUsuario($email, md5($password)) == 1) {
                setSessionMessage("<h4 class='success'>¡Bienvenido " . getUsuarioActual()->nombreUsuario . "!</h4>");
            }
        }
    }
    //el usuario ya existe en la bd, loggearlo!
    getLogin($usuario->email, $usuario->password);
    //Redireccionarlo a la página
    if (isset($_SESSION['paginaLoginFacebook'])) {
        $_SESSION['paginaLoginFacebook'] = null;
        redirect($_SESSION['paginaLoginFacebook']);
    } 
}
?>