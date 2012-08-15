<?php

require_once 'bd/conx.php';

function getIngredientesPlatillo($idPlatillo) {
    global $conex;
    /*$query = "SELECT p.idPlatillo,p.idRestaurante,p.idCategoria,p.nombre as nombrePlatillo, p.descripcion, p.precioBase,p.hint,gi.idGrupoIngredientes, gi.nombre as nombreGrupo, gi.excluyente, gi.requerido, gi.idGrupoDepende, gi.idIngredienteDepende, i.idIngrediente, i.idGrupoIngredientes as idGrupoIngredientesI, i.nombre as nombreIngrediente, i.precio 
FROM platillo p, grupoingredientes gi, ingrediente i 
WHERE p.idPlatillo = :id AND p.idPlatillo = gi.idPlatillo AND i.idGrupoIngredientes = gi.idGrupoIngredientes";*/
    $query = "SELECT DISTINCT p.idPlatillo,p.idRestaurante,p.idCategoria,p.nombre as nombrePlatillo, p.descripcion, p.precioBase,p.hint,gi.idGrupoIngredientes, gi.nombre as nombreGrupo, gi.excluyente, gi.requerido, gi.idGrupoDepende, gi.idIngredienteDepende, i.idIngrediente, i.idGrupoIngredientes as idGrupoIngredientesI, i.nombre as nombreIngrediente, i.precio 
        FROM platillo p
        LEFT OUTER JOIN grupoingredientes gi ON p.idPlatillo = gi.idPlatillo
        LEFT OUTER JOIN ingrediente i ON gi.idGrupoIngredientes = i.idGrupoIngredientes
        WHERE p.idPlatillo = :id";
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
            $_SESSION['idPlatillo'] = $pedido->idPlatillo;
            if($pedido->idIngrediente!=NULL){
                $_SESSION['ingrediente'][$pedido->idPlatillo]["'".$pedido->idIngrediente."'"] = serialize($pedido);
            }
            else{
                $_SESSION['ingrediente'][$pedido->idPlatillo]['sin'] = serialize($pedido);
            }
            //$_SESSION['platillo'][$pedido->idPlatillo] = serialize($pedido);
            //$_SESSION['idPlatilloActual'] = $pedido->idPlatillo;
            $i++;
        }
        return $caracteristicas;
    } else {
        return NULL;
    }
}

function guardaPedido() {
    $cantidad = $_POST['cantidad'];
    $especificaciones = $_POST['especificaciones'];
    $valores = $_POST['valores'];

    $cadena = str_replace("+", "", $valores);
    $pares = explode("&", $cadena); //datos de la forma tamano=idtamano, salsa=idsalsa
    foreach ($pares as $key => $value)
        $datos[$key] = explode("=", $value); //datos de la forma [0] tamano, [1] idtamano, [2] salsa, [3] idsalsa

        
    //logica para que los valores se conviertan en los ids de la sesion $_SESSION['ingrediente'][id] para sacar los precios y demÃ¡s
    //luego seteamos las sesiones a null o le aplicamos el destroy con unset (no en este momento o pierdo todos los datos
    //para mostrarlos en posteriores consultas)
    $total = 0;
    $pedido = new PlatilloElementos();
    foreach ($datos as $valor) {
        if(isset($valor[0]) && $valor[0]!=NULL && $valor[0]!=""){
            $pedido = unserialize($_SESSION['ingrediente'][$_SESSION['idPlatillo']]["'".$valor[1]."'"]); //el valor en la posicion 1 sirve para discriminar porque es el tamaño del platillo
        }else{
            $pedido = unserialize($_SESSION['ingrediente'][$_SESSION['idPlatillo']]['sin']);
        }
        //$pedido = unserialize($_SESSION['idPlatilloActual']);
        //$pedido = unserialize($_SESSION['ingrediente'][$_SESSION['idP']]);
        $total += $pedido->precio; //acumulamos los precios de cada grupo de ingredientes y lo vamos sumando
    }
    $total += $pedido->precioBase; //le sumamos el precio Base del platillo
    $total *= $cantidad; //multiplicamos el total por la cantidad
    
    $datosFinales[0] = $pedido->nombrePlatillo;
    $datosFinales[1] = $cantidad;
    $datosFinales[2] = $especificaciones;
    $datosFinales[3] = $total;

    unset($_SESSION['ingrediente']);
    if(isset($pedido->idIngrediente))
        $_SESSION['pedido'][$pedido->idPlatillo][$pedido->idIngrediente] = $datosFinales;
    else
        $_SESSION['pedido'][$pedido->idPlatillo]['sin'] = $datosFinales;
    $_SESSION["'rest".$pedido->idRestaurante."'"] = $_SESSION['pedido'];
    
    return $datosFinales;
}

function getPedidos($idRestaurante) {
    $pedidos = array();
    if (isset($_SESSION["'rest".$idRestaurante."'"])) {
        foreach ($_SESSION["'rest".$idRestaurante."'"] as $value) {        
            foreach ($value as $valor) {
                array_push($pedidos, $valor);
            }
        }
    }
    
    //$pedidos[0] nombre del platillo
    //$pedidos[1] cantidad del mismo tipo de platillo
    //$pedidos[2] especificaciones
    //$pedidos[3] total
    
    return $pedidos;
}

function generarPedido($pedido){
    foreach($_SESSION["'rest".$pedido->idRestaurante."'"] as $key=>$value){
        echo $value;
    }
}

 function utf8replace($cadena){
     str_replace('&#193;','A', $cadena);
     str_replace('&#201;','E', $cadena);
     str_replace('&#205;','I', $cadena);
     str_replace('&#211;','O', $cadena);
     str_replace('&#218;','U', $cadena);
     str_replace('&#209;','N', $cadena);
     str_replace('Ä','A', $cadena);
     str_replace('Ë','E', $cadena);
     str_replace('Ï','I', $cadena);
     str_replace('Ö','O', $cadena);
     str_replace('Ü','U', $cadena);
     str_replace('&#225;','a', $cadena);
     str_replace('&#233;','e', $cadena);
     str_replace('&#237;','i', $cadena);
     str_replace('&#243;','o', $cadena);
     str_replace('&#250;','u', $cadena);
     str_replace('&#241;','n', $cadena);
     str_replace('ä','a', $cadena);
     str_replace('ë','e', $cadena);
     str_replace('ï','i', $cadena);
     str_replace('ö','o', $cadena);
     str_replace('ü','u', $cadena);
     str_replace('%3A', '',$cadena);     
     return $cadena;
}
?>
