<?php

//Application Configurations
$app_id = "112970332196149";
$app_secret = "4e369323f213a2fa02d601fd3ac07bbb";
$site_url = "http://efood.localhost";
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
    require_once 'modulos/principal/modelos/login.php';
    require_once 'modulos/usuarios/modelos/usuarioModelo.php';
    //validamos si este usuario ya tiene su email registrado, sino creamos un usuario nuevo
    $usuario = getUsuarioFromEmail($email);
    if (!isset($usuario) || $usuario->email == "") {
        //el usuario no existe en la bd, crearlo!
        require_once 'modulos/usuarios/clases/Usuario.php';
        require_once 'modulos/principal/modelos/login.php';
        require_once 'modulos/usuarios/modelos/usuarioModelo.php';
        $usuario = new Usuario();
        $usuario->email = $email;
        $usuario->habilitado = 1;
        $usuario->password = md5(getUniqueCode(10));
        $usuario->tipo = 0;

        $id = crearUsuario($usuario);
        $usuario->idUsuario = $id;
    }
    //el usuario ya existe en la bd, loggearlo!
    getLogin($usuario->email, $usuario->password);
    //Redireccionarlo a la página
    if (isset($_SESSION['paginaLoginFacebook'])) {
        $pagina = $_SESSION['paginaLoginFacebook'];
        //redirect($pagina);
        $_SESSION['paginaLoginFacebook'] = null;
    }
}
?>