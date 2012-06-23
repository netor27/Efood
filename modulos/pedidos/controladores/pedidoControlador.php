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
    require_once('modulos/platillos/modelos/platilloModelo.php');
    $idRestaurante = $_GET['i'];
    require_once('modulos/restaurantes/modelos/RestauranteModelo.php');
    $restaurante = getRestaurante($idRestaurante);
    $platillos = getPlatillosDeRestaurante($idRestaurante);

    
    require_once('modulos/platillos/vistas/mostrarPlatillosPedido.php');
}

function obtenIngredientes(){
    require_once('modulos/pedidos/modelos/pedidoModelo.php');
    require_once 'modulos/pedidos/clases/PlatilloElementos.php';
    $idPlatillo = $_POST['platillo'];
    $json = getIngredientesPlatillo($idPlatillo);
    echo json_encode($json);
}

function agregaAlPedido(){
    require_once('modulos/pedidos/modelos/pedidoModelo.php');
    require_once 'modulos/pedidos/clases/PlatilloElementos.php';
    $json = guardaPedido();
    echo json_encode($json);
}
?>
