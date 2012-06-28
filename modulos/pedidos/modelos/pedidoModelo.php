<?php

require_once 'bd/conx.php';

function getIngredientesPlatillo($idPlatillo) {
    global $conex;
    $query = "SELECT p.idPlatillo,p.idRestaurante,p.idCategoria,p.nombre as nombrePlatillo, p.descripcion, p.precioBase,p.hint,gi.idGrupoIngredientes, gi.nombre as nombreGrupo, gi.excluyente, gi.requerido, gi.idGrupoDepende, gi.idIngredienteDepende, i.idIngrediente, i.idGrupoIngredientes as idGrupoIngredientesI, i.nombre as nombreIngrediente, i.precio 
FROM platillo p, grupoingredientes gi, ingrediente i 
WHERE p.idPlatillo = :id AND p.idPlatillo = gi.idPlatillo AND i.idGrupoIngredientes = gi.idGrupoIngredientes";
    $stmt = $conex->prepare($query);
    $stmt->bindParam(':id', $idPlatillo);
    if ($stmt->execute()) {
        $caracteristicas = array();
        $rows = $stmt->fetchAll();
        require_once 'modulos/pedidos/clases/PlatilloElementos.php';
        $i = 0;
        foreach ($rows as $row) {
            $pedido = new PlatilloElementos();
            $pedido->idPlatillo = $row['idPlatillo'];
            $pedido->idRestaurante = $row['idRestaurante'];
            $pedido->idCategoria = $row['idCategoria'];
            $pedido->nombrePlatillo = $row['nombrePlatillo'];
            $pedido->descripcion = $row['descripcion'];
            $pedido->precioBase = $row['precioBase'];
            $pedido->hint = $row['hint'];
            $pedido->idGrupoIngredientes = $row['idGrupoIngredientes'];
            $pedido->nombreGrupo = $row['nombreGrupo'];
            $pedido->excluyente = $row['excluyente'];
            $pedido->requerido = $row['requerido'];
            $pedido->idGrupoDepende = $row['idGrupoDepende'];
            $pedido->idIngredienteDepende = $row['idIngredienteDepende'];
            $pedido->idIngrediente = $row['idIngrediente'];
            $pedido->idGrupoIngredientesI = $row['idGrupoIngredientesI'];
            $pedido->nombreIngrediente = $row['nombreIngrediente'];
            $pedido->precio = $row['precio'];
            $caracteristicas[$i] = $pedido;
            $i++;
        }
        return $caracteristicas;
    } else {
        return NULL;
    }
}

function guardaPedido(){
    $cantidad = $_POST['cantidad'];
    return $cantidad;
}

?>