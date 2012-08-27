<?php

function mostrarPedidos() {
    require_once 'modulos/administracionPedidos/modelos/pedidoAdminModelo.php';
    require_once 'modulos/administracionPedidos/clases/PedidoAdmin.php';
    
    $pedidos = getPedidos();
    require_once('modulos/administracionPedidos/vistas/mostrarPedidos.php');
}

?>
