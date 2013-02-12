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
        //Eliminamos los datos de la session si es que había usuario comun loggeado
        $_SESSION['idUsuario'] = null;
        $_SESSION['tipo'] = null;
        $_SESSION['email'] = null;
        $_SESSION['telefono'] = null;
        $_SESSION['habilitado'] = null;
    } else {
        //login inválido
        //echo 'mal';
        setSessionMessage("<h2 style='color:red;'>Nombre de usuario/contraseña inválido<h2>");
    }
    redirect($pagina);
}

function logout() {
    $_SESSION['restauranteUsuario'] = null;
    redirect("adminRestaurante.php");
}

function adminPedidos(){
    require_once 'modulos/administracionRestaurantes/vistas/adminPedidos.php';
}

function pedidosPorAceptar() {
    require_once 'modulos/pedidos/modelos/pedidoModelo.php';
    if (isset($_SESSION['restauranteUsuario'])) {
        $restaurante = $_SESSION['restauranteUsuario'];
        $estado = 1; //Son pedidos no aceptados
        $pedidos = getPedidosDeRestaurante($restaurante->idRestaurante,$estado);
        require_once 'modulos/administracionRestaurantes/vistas/pedidosPorAceptar.php';
    } else {
        goToIndex();
    }
}

function pedidosActivos() {
    require_once 'modulos/pedidos/modelos/pedidoModelo.php';
    if (isset($_SESSION['restauranteUsuario'])) {
        $restaurante = $_SESSION['restauranteUsuario'];
        $estado = 2; //Son pedidos aceptados
        $pedidos = getPedidosDeRestaurante($restaurante->idRestaurante,$estado);
        require_once 'modulos/administracionRestaurantes/vistas/pedidosActivos.php';
    } else {
        goToIndex();
    }
}

function detallesDePedido(){
    $idPedido = $_GET['i'];
    require_once 'modulos/pedidos/modelos/pedidoModelo.php';
    $platillos = getDetallesDePedido($idPedido);
    print_r($platillos);
}
?>