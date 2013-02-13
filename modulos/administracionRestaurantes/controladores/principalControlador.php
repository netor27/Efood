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

function adminPedidos() {
    require_once 'modulos/administracionRestaurantes/vistas/adminPedidos.php';
}

function pedidosPorAceptar() {
    $t = "pedidosPorAceptar";
    $titulo = "Pedidos Por Aceptar";
    require_once 'modulos/pedidos/modelos/pedidoModelo.php';
    if (isset($_SESSION['restauranteUsuario'])) {
        $restaurante = $_SESSION['restauranteUsuario'];
        $estado = 1; //Son pedidos no aceptados
        $pedidos = getPedidosDeRestaurante($restaurante->idRestaurante, $estado);
        require_once 'modulos/administracionRestaurantes/vistas/listaPedidos.php';
    } else {
        goToIndex();
    }
}

function pedidosActivos() {
    $t = "pedidosActivos";
    $titulo = "Pedidos Activos";
    require_once 'modulos/pedidos/modelos/pedidoModelo.php';
    if (isset($_SESSION['restauranteUsuario'])) {
        $restaurante = $_SESSION['restauranteUsuario'];
        $estado = 2; //Son pedidos aceptados
        $pedidos = getPedidosDeRestaurante($restaurante->idRestaurante, $estado);
        require_once 'modulos/administracionRestaurantes/vistas/listaPedidos.php';
    } else {
        goToIndex();
    }
}

function pedidosRechazados() {
    $t = "pedidosRechazados";
    $titulo = "Pedidos Rechazados";
    require_once 'modulos/pedidos/modelos/pedidoModelo.php';
    if (isset($_SESSION['restauranteUsuario'])) {
        $restaurante = $_SESSION['restauranteUsuario'];
        $estado = 4; //Son pedidos rechazados
        $pedidos = getPedidosDeRestaurante($restaurante->idRestaurante, $estado);
        require_once 'modulos/administracionRestaurantes/vistas/listaPedidos.php';
    } else {
        goToIndex();
    }
}

function pedidosEntregados() {
    $t = "pedidosEntregados";
    $titulo = "Pedidos Entregados";
    require_once 'modulos/pedidos/modelos/pedidoModelo.php';
    if (isset($_SESSION['restauranteUsuario'])) {
        $restaurante = $_SESSION['restauranteUsuario'];
        $estado = 3; //Son pedidos entregados
        $pedidos = getPedidosDeRestaurante($restaurante->idRestaurante, $estado);
        require_once 'modulos/administracionRestaurantes/vistas/listaPedidos.php';
    } else {
        goToIndex();
    }
}

function detallesDePedido() {
    $t = "pedidoPorAceptar";
    if (isset($_GET['t'])) {
        $t = $_GET['t'];
    }
    if (isset($_GET['i'])) {
        $idPedido = $_GET['i'];
        require_once 'modulos/pedidos/modelos/pedidoModelo.php';
        $platillos = getDetallesDePedido($idPedido);
        require_once 'modulos/administracionRestaurantes/vistas/detallesDePedido.php';
    } else {
        goToIndex();
    }
}

function aceptarPedido() {
    $idPedido = $_GET['i'];
    $t = $_GET['t'];
    require_once 'modulos/pedidos/modelos/pedidoModelo.php';
    $estado = 2; //pedido aceptado
    cambiarEstadoDePedido($idPedido, $estado);
    setSessionMessage("Haz aceptado este pedido");
    redirect('/adminRestaurante.php?a=detallesDePedido&t=' . $t . '&i=' . $idPedido);
}

function rechazarPedido() {
    $idPedido = $_GET['i'];
    $t = $_GET['t'];
    require_once 'modulos/pedidos/modelos/pedidoModelo.php';
    $estado = 4; //pedido rechazado
    cambiarEstadoDePedido($idPedido, $estado);
    setSessionMessage("Haz rechazado este pedido");
    redirect('/adminRestaurante.php?a=detallesDePedido&t=' . $t . '&i=' . $idPedido);
}

function pedidoEntregado() {
    $idPedido = $_GET['i'];
    $t = $_GET['t'];
    require_once 'modulos/pedidos/modelos/pedidoModelo.php';
    $estado = 3; //pedido entregado
    cambiarEstadoDePedido($idPedido, $estado);
    setSessionMessage("Haz entregado este pedido");
    redirect('/adminRestaurante.php?a=detallesDePedido&t=' . $t . '&i=' . $idPedido);
}

?>