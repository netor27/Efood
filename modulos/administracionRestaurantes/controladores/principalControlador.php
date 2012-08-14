<?php

function principal() {
    if (validarRestauranteLoggeado()) {
        $restaurante = getRestauranteLoggeado();
        require_once 'modulos/administracionRestaurantes/vistas/index.php';
    }
}

function login() {
    $user = $_POST['usuario'];
    $pass = $_POST['pass'];
    $pass = md5($pass);
    $pagina = "adminRestaurante.php";
    if (isset($_POST['pagina']))
        $pagina = $_POST['pagina'];

    require_once 'modulos/restaurantes/modelos/RestauranteModelo.php';
    $restaurante = getRestaurantePorLogin($user, $pass);
    if (isset($restaurante)) {
        $_SESSION['restauranteUsuario'] = $restaurante;
    } else {
        //login inválido
        echo 'mal';
        setSessionMessage("<h2 style='color:red;'>Nombre de usuario/contraseña inválido<h2>");
    }
    redirect($pagina);
}

?>