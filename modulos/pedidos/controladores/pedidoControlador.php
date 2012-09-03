<?php

function buscarColonia() {
    require_once('funcionesPHP/funcionesGenerales.php');
    require_once 'modulos/restaurantes/modelos/RestauranteModelo.php';
    require_once 'modulos/restaurantes/clases/Restaurante.php';
    
    $idColonia = $_POST['idColonia'];
    $restaurantes = getRestaurantesColonia($idColonia);
    echo "<table border=1>";
    foreach($restaurantes as $restaurante)    
        $restaurante->printRestaurantePedido();
    echo "</table>";
}

function buscarRestaurante() {
    require_once('funcionesPHP/funcionesGenerales.php');
    require_once 'modulos/restaurantes/modelos/RestauranteModelo.php';
    require_once 'modulos/restaurantes/clases/Restaurante.php';
    
    $idRestaurante = $_POST['idRestaurante'];
    $restaurante = getRestauranteHabilitado($idRestaurante);
    echo "<table border=1>";
    $restaurante->printRestaurantePedido();
    echo "</table>";
}

function menu() {
    require_once('funcionesPHP/funcionesGenerales.php');
    require_once('modulos/platillos/modelos/platilloModelo.php');
    require_once('modulos/restaurantes/modelos/RestauranteModelo.php');
    
    $idRestaurante = $_GET['i'];//obtenemos el id del restaurante por get
    $habilitado = false;         //bandera que nos permite hacer las validaciones
    
    $restaurante = getRestaurante($idRestaurante);          //obtenemos la información del restaurante por su id
    $platillos = getPlatillosDeRestaurante($idRestaurante); //obtenemos todos los platillos de ese restaurante
    
    //*********************VALIDACIÓN DEL HORARIO DEL RESTAURANTE********************
    $hora = getHorario($idRestaurante);
    $diaIni = getDay().'Ini';
    $diaFin = getDay().'Fin';
    if(getTime24()>$hora->$diaIni && getTime24()<$hora->$diaFin)
        $habilitado = true;
    //*******************************************************************************
    
    //Hace arreglo esa parte de la sesión para poder asignar platillos a diferentes restaurantes
    if(empty($_SESSION["'rest".$restaurante->idRestaurante."'"])){
        $_SESSION["'rest".$restaurante->idRestaurante."'"] = array();
    }
    //***************************************************************************
    
    require_once('modulos/platillos/vistas/mostrarPlatillosPedido.php');
}

function obtenIngredientes(){
    require_once('modulos/pedidos/modelos/pedidoModelo.php');
    require_once 'modulos/pedidos/clases/PlatilloElementos.php';
    $idPlatillo = $_POST['platillo'];
    $json = getIngredientesPlatillo($idPlatillo);
    echo json_encode($json);
}

function obtenPedidos(){
    require_once('modulos/pedidos/modelos/pedidoModelo.php');
    require_once 'modulos/pedidos/clases/PlatilloElementos.php';
    $pedidos = getPedidos($_GET['i']);
    return $pedidos;
}

function agregaAlPedido(){
    require_once('modulos/pedidos/modelos/pedidoModelo.php');
    require_once 'modulos/pedidos/clases/PlatilloElementos.php';
    $json = guardaPedido();
    echo json_encode($json);
}

function pedir(){
    require_once('modulos/pedidos/modelos/pedidoModelo.php');
    require_once 'modulos/pedidos/clases/PlatilloElementos.php';
    $idRestaurante = $_GET['i'];
    $pedidos = getPedidos($idRestaurante);
    $errores = generarPedido($pedidos);
    require_once('modulos/pedidos/vistas/pedir.php');
}
?>
