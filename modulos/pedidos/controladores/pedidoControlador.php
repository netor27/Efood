<?php

function buscarRestauranteHome() {
    require_once('funcionesPHP/funcionesGenerales.php');
    require_once 'modulos/restaurantes/modelos/RestauranteModelo.php';
    require_once 'modulos/restaurantes/clases/Restaurante.php';

    //valores necesarios
    $idColonia = -1;
    $idTiposComida = array();
    $domicilio = false;
    $recoger = false;

    //Se va a guardar la busqueda en la sesión para poder regresar sin tener que mandar los datos por post
    //si hay post, sacamos los datos de ahí, si no, de la session
    $banderaValores = false;

    if (isset($_POST['idColonia'])) {
        $idColonia = $_POST['idColonia'];
        $rawAntojos = $_POST['antojos'];
        $domicilio = !$_POST['preferenciaDomicilio'] == -1;
        $recoger = !$_POST['preferenciaRecoger'] == -1;
        foreach ($rawAntojos as $antojo) {
            if ($antojo != -1) {
                array_push($idTiposComida, $antojo);
            }
        }

        $banderaValores = true;
        $valores = array();
        $valores['idColonia'] = $idColonia;
        $valores['idTiposComida'] = $idTiposComida;
        $valores['domicilio'] = $domicilio;
        $valores['recoger'] = $recoger;
        $_SESSION['busquedaRestauranteHome'] = $valores;
        $_SESSION['idColoniaEntrega'] = $idColonia;
    } else if (isset($_SESSION['busquedaRestauranteHome'])) {
        $banderaValores = true;
        $valores = $_SESSION['busquedaRestauranteHome'];
        $idColonia = $valores['idColonia'];
        $idTiposComida = $valores['idTiposComida'];
        $domicilio = $valores['domicilio'];
        $recoger = $valores['recoger'];
    }
    $metodoEntrega = getIdMetodoEntrega($domicilio, $recoger);
    if ($banderaValores) {
        mostrarBusqueda($idColonia, $idTiposComida, $metodoEntrega);
    } else {
        goToIndex();
    }
}

function buscarRestaurante() {
    require_once('funcionesPHP/funcionesGenerales.php');
    require_once 'modulos/restaurantes/modelos/RestauranteModelo.php';
    require_once 'modulos/restaurantes/clases/Restaurante.php';

    //valores necesarios
    $idColonia = -1;
    $idTiposComida = array();
    $domicilio = false;
    $recoger = false;
    //Se va a guardar la busqueda en la sesión para poder regresar sin tener que mandar los datos por post
    //si hay post, sacamos los datos de ahí, si no, de la session
    $banderaValores = false;

    if (isset($_POST['idColonia'])) {
        //hay post, obtenemos los datos de aquí y lo guardamos en la sesión
        $banderaValores = true;
        $idColonia = $_POST['idColonia'];
        $idTiposComida = null;
        if (isset($_POST['idTipoComida']) && is_numeric($_POST['idTipoComida'])) {
            //echo 'id ' . $_POST['idTipoComida'] . " ||";
            $idTiposComida = array();
            array_push($idTiposComida, $_POST['idTipoComida']);
        }
        if (isset($_POST['idMetodoEntrega']) && is_numeric($_POST['idMetodoEntrega'])) {
            $metodoEntrega = $_POST['idMetodoEntrega'];
        } else {
            $metodoEntrega = 2;
        }
    } else if (isset($_SESSION['busquedaRestauranteHome'])) {
        //no hay post, obtenemos los datos de la sessión
        $banderaValores = true;
        $valores = $_SESSION['busquedaRestauranteHome'];
        $idColonia = $valores['idColonia'];
        $idTiposComida = $valores['idTiposComida'];
        $domicilio = $valores['domicilio'];
        $recoger = $valores['recoger'];
        $metodoEntrega = getIdMetodoEntrega($domicilio, $recoger);
    }
    
    if ($banderaValores) {
        mostrarBusqueda($idColonia, $idTiposComida, $metodoEntrega);
    } else {
        goToIndex();
    }
}

function mostrarBusqueda($idColonia, $idTiposComida, $metodoEntrega) {
    $restaurantes = getRestaurantesColoniaTipoComidaMetodoEntrega($idColonia, $idTiposComida, $metodoEntrega);
    require_once 'modulos/tipoComida/modelos/tipoComidaModelo.php';
    $tiposDeComida = getTiposComida();
    require_once 'modulos/colonias/modelos/ColoniaModelo.php';
    $colonias = getColonias();
    $colonia = getColonia($idColonia);

    require_once 'modulos/pedidos/vistas/resultadosBusqueda.php';
}

//function buscarRestaurante() {
//    require_once('funcionesPHP/funcionesGenerales.php');
//    require_once 'modulos/restaurantes/modelos/RestauranteModelo.php';
//    require_once 'modulos/restaurantes/clases/Restaurante.php';
//
//    $idRestaurante = $_POST['idRestaurante'];
//    $restaurante = getRestauranteHabilitado($idRestaurante);
//    echo "<table border=1>";
//    $restaurante->printRestaurantePedido();
//    echo "</table>";
//}

function menu() {
    require_once('funcionesPHP/funcionesGenerales.php');
    require_once('modulos/platillos/modelos/platilloModelo.php');
    require_once('modulos/restaurantes/modelos/RestauranteModelo.php');

    $idRestaurante = $_GET['i']; //obtenemos el id del restaurante por get
    $habilitado = false;         //bandera que nos permite hacer las validaciones

    $restaurante = getRestaurante($idRestaurante);          //obtenemos la información del restaurante por su id
    $platillos = getPlatillosDeRestaurante($idRestaurante); //obtenemos todos los platillos de ese restaurante
    //*********************VALIDACIÓN DEL HORARIO DEL RESTAURANTE********************
    $hora = getHorario($idRestaurante);
    $diaIni = getDay() . 'Ini';
    $diaFin = getDay() . 'Fin';
    if (getTime24() > $hora->$diaIni && getTime24() < $hora->$diaFin)
        $habilitado = true;
    if ($hora->$diaIni == '00:00:00' && $hora->$diaFin == '00:00:00')
        $habilitado = true;
    //*******************************************************************************
    //Hace arreglo esa parte de la sesión para poder asignar platillos a diferentes restaurantes
    if (empty($_SESSION["'rest" . $restaurante->idRestaurante . "'"])) {
        $_SESSION["'rest" . $restaurante->idRestaurante . "'"] = array();
    }
    //***************************************************************************

    require_once('modulos/platillos/vistas/mostrarPlatillosPedido.php');
}

function obtenIngredientes() {
    require_once('modulos/pedidos/modelos/pedidoModelo.php');
    require_once 'modulos/pedidos/clases/PlatilloElementos.php';
    $idPlatillo = $_POST['platillo'];
    $json = getIngredientesPlatillo($idPlatillo);
    echo json_encode($json);
}

function obtenPedidos() {
    require_once('modulos/pedidos/modelos/pedidoModelo.php');
    require_once 'modulos/pedidos/clases/PlatilloElementos.php';
    $pedidos = getPedidos($_GET['i']);
    return $pedidos;
}

function agregaAlPedido() {
    require_once('modulos/pedidos/modelos/pedidoModelo.php');
    require_once 'modulos/pedidos/clases/PlatilloElementos.php';
    $json = guardaPedido();
    echo json_encode($json);
}

function eliminarDelPedido() {
    require_once('modulos/pedidos/modelos/pedidoModelo.php');
    require_once 'modulos/pedidos/clases/PlatilloElementos.php';
    $ir = $_GET['ir'];
    eliminarPlatilloPedido();
    header('Location: pedidos.php?a=menu&i=' . $ir);
    //require_once('modulos/platillos/vistas/mostrarPlatillosPedido.php');
}

function pedir() {
    require_once('modulos/pedidos/modelos/pedidoModelo.php');
    require_once 'modulos/pedidos/clases/PlatilloElementos.php';
    $idRestaurante = $_GET['i'];
    $pedidos = getPedidos($idRestaurante);
    $pedidoGenerado = mostrarPedidoGenerado($pedidos);
    $errores = generarPedido($pedidos);
    require_once('modulos/pedidos/vistas/pedir.php');
}

?>
