<?php

require_once 'bd/conx.php';

function getPedidos() {
    global $conex;
    $query = "SELECT * FROM pedido";
    $stmt = $conex->prepare($query);
    if ($stmt->execute()) {
        $pedidos = array();
        $rows = $stmt->fetchAll();
        require_once 'modulos/administracionPedidos/clases/PedidoAdmin.php';
        $i = 0;
        foreach ($rows as $row) {
            $pedido = new PedidoAdmin();
            $pedido->idPedido = $row['idPedido'];
            $pedido->idRestaurante = $row['idRestaurante'];
            $pedido->idUsuario = $row['idUsuario'];
            $pedido->idEstadoPedido = $row['idEstadoPedido'];
            $pedido->comentario = $row['comentario'];
            $pedido->idMetodoEntrega = $row['idMetodoEntrega'];
            $pedido->idTipoPago = $row['idTipoPago'];
            $pedido->numReferencia = $row['numReferencia'];
            $pedidos[$i] = $pedido;
            $i++;
        }
        return $pedidos;
    } else {
        return NULL;
    }
}

function getPedidosUsuario($idUsuario) {
    global $conex;
    $query = "SELECT * FROM pedido WHERE idUsuario = :idUsuario";
    $stmt = $conex->prepare($query);
    $stmt->bindParam(':idUsuario', $idUsuario);
    if ($stmt->execute()) {
        $pedidos = array();
        $rows = $stmt->fetchAll();
        require_once 'modulos/administracionPedidos/clases/PedidoAdmin.php';
        $i = 0;
        foreach ($rows as $row) {
            $pedido = new Pedido();
            $pedido->idPedido = $row['idPedido'];
            $pedido->idRestaurante = $row['idRestaurante'];
            $pedido->idUsuario = $row['idUsuario'];
            $pedido->idEstadoPedido = $row['idEstadoPedido'];
            $pedido->comentario = $row['comentario'];
            $pedido->idMetodoEntrega = $row['idMetodoEntrega'];
            $pedido->idTipoPago = $row['idTipoPago'];
            $pedido->numReferencia = $row['numReferencia'];
            $pedidos[$i] = $pedido;
            $i++;
        }
        return $pedidos;
    } else {
        return NULL;
    }
}

function updateEstadoPedido($idPedido) {
    global $conex;
    $query = "UPDATE pedido SET idEstadoPedido = :idPedido WHERE ";
    $stmt = $conex->prepare($query);
    $stmt->bindParam(':idPedido', $idPedido);
    if ($stmt->execute()) {
        
    } else {
        return NULL;
    }
}

?>
