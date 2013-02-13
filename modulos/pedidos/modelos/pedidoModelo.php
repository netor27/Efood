<?php

require_once 'bd/conx.php';

function getIngredientesPlatillo($idPlatillo) {
    global $conex;
    /* $query = "SELECT p.idPlatillo,p.idRestaurante,p.idCategoria,p.nombre as nombrePlatillo, p.descripcion, p.precioBase,p.hint,gi.idGrupoIngredientes, gi.nombre as nombreGrupo, gi.excluyente, gi.requerido, gi.idGrupoDepende, gi.idIngredienteDepende, i.idIngrediente, i.idGrupoIngredientes as idGrupoIngredientesI, i.nombre as nombreIngrediente, i.precio 
      FROM platillo p, grupoingredientes gi, ingrediente i
      WHERE p.idPlatillo = :id AND p.idPlatillo = gi.idPlatillo AND i.idGrupoIngredientes = gi.idGrupoIngredientes"; */
    $query = "SELECT DISTINCT p.idPlatillo,p.idRestaurante,p.idCategoriaPlatillo,p.nombre as nombrePlatillo, 
        p.descripcion, p.precioBase,p.hint,gi.idGrupoIngredientes, gi.nombre as nombreGrupo, gi.excluyente, 
        gi.requerido, gi.idGrupoDepende, gi.idIngredienteDepende, i.idIngrediente, 
        i.idGrupoIngredientes as idGrupoIngredientesI, i.nombre as nombreIngrediente, i.precio,
        cp.nombre as nombrecat, cp.descripcion as descripcioncat, cp.orden as ordencat
        FROM platillo p
        LEFT OUTER JOIN grupoingredientes gi ON p.idPlatillo = gi.idPlatillo
        LEFT OUTER JOIN ingrediente i ON gi.idGrupoIngredientes = i.idGrupoIngredientes
        LEFT OUTER JOIN categoriaplatillo cp ON p.idCategoriaPlatillo = cp.idCategoriaPlatillo
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
            $pedido->idCategoriaPlatillo = $row['idCategoriaPlatillo'];
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
            $pedido->nombrecat = $row['nombrecat'];
            $pedido->descripcioncat = $row['descripcioncat'];
            $pedido->ordencat = $row['ordencat'];
            $caracteristicas[$i] = $pedido;
            $_SESSION['idPlatillo'] = $pedido->idPlatillo;
            if ($pedido->idIngrediente != NULL && $pedido->idIngrediente != "") {
                $_SESSION['ingrediente'][$pedido->idPlatillo]["'" . $pedido->idIngrediente . "'"] = serialize($pedido);
            } else {
                $_SESSION['idgi'] = $pedido->idGrupoIngredientes;
                $_SESSION['ingrediente'][$pedido->idPlatillo]["'gi" . $pedido->idGrupoIngredientes . "'"] = serialize($pedido);
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
        if (isset($valor[0]) && $valor[0] != NULL && $valor[0] != "") {
            $pedido = unserialize($_SESSION['ingrediente'][$_SESSION['idPlatillo']]["'" . $valor[1] . "'"]); //el valor en la posicion 1 sirve para discriminar porque es el tamaño del platillo
        } else {
            $pedido = unserialize($_SESSION['ingrediente'][$_SESSION['idPlatillo']]["'gi" . $_SESSION['idgi'] . "'"]);
        }
        //print_r($pedido);
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
    $datosFinales[4] = $pedido->idRestaurante;
    $datosFinales[5] = $pedido->nombreGrupo;
    $datosFinales[6] = $pedido->nombreIngrediente;
    $datosFinales[7] = utf8_encode($valores);
    $datosFinales[8] = $pedido->idIngrediente;

    unset($_SESSION['ingrediente']);
    if (isset($pedido->idIngrediente))
        $_SESSION['pedido'][$pedido->idPlatillo][$pedido->idIngrediente] = $datosFinales;
    else
        $_SESSION['pedido'][$pedido->idPlatillo]["'gi" . $pedido->idGrupoIngredientes . "'"] = $datosFinales;

    array_push($_SESSION["'rest" . $pedido->idRestaurante . "'"], $_SESSION['pedido']);
    $_SESSION['pedido'] = null;

    return $datosFinales;
}

function getPedidos($idRestaurante) {
    $pedidos = array();
    if (isset($_SESSION["'rest" . $idRestaurante . "'"])) {
        foreach ($_SESSION["'rest" . $idRestaurante . "'"] as $value) {
            foreach ($value as $key => $valor) {
                $nuevo = array($key => $valor);
                array_push($pedidos, $nuevo);
            }
        }
    }
    //$pedidos[0] nombre del platillo
    //$pedidos[1] cantidad del mismo tipo de platillo
    //$pedidos[2] especificaciones
    //$pedidos[3] total

    return $pedidos;
}

function getDireccionesRestauranteUsuario($idUsuario, $idRestaurante) {
    global $conex;
    $stmt = $conex->prepare("SELECT idDireccion,idColonia,calle,numero,numeroInt,referencia FROM direccion WHERE idUsuario=:idUsuario AND idColonia in(SELECT idColonia FROM restaurantecolonia WHERE idRestaurante = :idRestaurante)");
    $stmt->bindParam(':idUsuario', $idUsuario);
    $stmt->bindParam(':idRestaurante', $idRestaurante);
    if ($stmt->execute()) {
        $direcciones = array();
        $rows = $stmt->fetchAll();
        require_once 'modulos/usuarios/clases/Direccion.php';
        $i = 0;
        foreach ($rows as $row) {
            $direccion = new Direccion();
            $direccion->idDireccion = $row['idDireccion'];
            $direccion->idColonia = $row['idColonia'];
            $direccion->calle = $row['calle'];
            $direccion->numero = $row['numero'];
            $direccion->numeroInt = $row['numeroInt'];
            $direccion->referencia = $row['referencia'];
            $direcciones[$i] = $direccion;
            $i++;
        }
        return $direcciones;
    } else {
        print_r($stmt->errorInfo());
        return NULL;
    }
}

function mostrarPedidoGenerado($pedido) {
    $pedidoResumen = "";
    $total = 0;
    $cargoExtra = 0;
    if (isset($_SESSION['email'])) {
        if (isset($pedido)) {
            $pedidoResumen .= "Detalles del pedido: <br><br>"; //nombre
            foreach ($pedido as $value) {
                foreach ($value as $valor) {
                    foreach ($valor as $val) {
                        $caracteristicas = preg_split('#=.&#', $val[7], -1);
                        $pedidoResumen .= "Nombre: " . $val[0] . "<br>"; //nombre
                        $pedidoResumen .= "Especificaciones: " . $val[2] . "<br>"; //especificaciones
                        $pedidoResumen .= "Cantidad: " . $val[1] . "<br>"; //cantidad
                        $pedidoResumen .= "Precio: " . $val[3] . "<br><br>"; //total
                        $pedidoResumen .= "<span id=\"" . $val[8] . "\">";
                        //print_r($val[8]);
                        foreach ($caracteristicas as $value) {
                            $pedidoResumen .= $value;
                        }
                        $pedidoResumen .= "</span><br>";
                        $total += $val[3];
                    }
                }
            }
            $pedidoResumen .= "Subtotal: " . $total . "<br>";
            $gastoEnvio = $_SESSION['gastoEnvio'];
            if ($_GET['p'] == 0) {
                $pedidoResumen .= "<br>Env&iacute;o a domicilio<br>";
                if ($_SESSION['tipoGastoEnvio'] == 0)
                    $cargoExtra = $total + $gastoEnvio;
                else if ($_SESSION['tipoGastoEnvio'] == 1)
                    $cargoExtra = ($total * ($gastoEnvio / 100)) + $total;
                else if ($_SESSION['tipoGastoEnvio'] == 2) {
                    $cadena = "$gastoEnvio";
                    eval('$cargoExtra = ' . $cadena . ';');
                    $cargoExtra += $total;
                }
            } else if ($_GET['p'] == 1) {
                $pedidoResumen .= "<br>Recoger pedido<br>";
                $cargoExtra = $total;
            }
            $_SESSION['precioTotal'] = $cargoExtra;
            $pedidoResumen .= "Total: " . ($cargoExtra) . "<br><br>";
        }
    } else {
        $pedidoResumen = "<h2>Favor de hacer login</h2>";
    }

    $_SESSION['pedidoResumen'] = $pedidoResumen;

    return $pedidoResumen;
}

function generarPedido($pedido) {
    $errores = false;
    if (isset($_SESSION['email']) && isset($_GET['i'])) {

        //if (isset($_GET['e']) && isset($_GET['e'])) {
        global $conex;
        try {
            $conex->beginTransaction();
            //numReferencia se genera aleatoriamente tomando en cuenta el id del usuario (email) encriptado
            $numReferencia = md5($_SESSION['email']) . rand(000, 999) . chr(rand(ord("a"), ord("z")));

            $val = false;
            $valPP = false;
            $valPI = false;
            $idRestaurante = $_GET['i'];
            $insertPedido = "INSERT INTO pedido(idRestaurante,idUsuario,idEstadoPedido,comentario,idMetodoEntrega,idTipoPago,numReferencia) VALUES(:idRestaurante,:idUsuario,:idEstadoPedido,:comentario,:idMetodoEntrega,:idTipoPago,:numReferencia)";
            $stmtP = $conex->prepare($insertPedido);
            $stmtP->bindParam(':idRestaurante', $idRestaurante);
            $stmtP->bindParam(':idUsuario', $_SESSION['idUsuario']);
            $stmtP->bindValue(':idEstadoPedido', 1);
            $stmtP->bindValue(':comentario', "comentario");
            //$stmtP->bindValue(':idMetodoEntrega', $_GET['e']);
            $stmtP->bindValue(':idMetodoEntrega', 1);
            $stmtP->bindValue(':idTipoPago', $_GET['p']);
            $stmtP->bindParam(':numReferencia', $numReferencia);
            $val = $stmtP->execute();
            if ($val)
                $id = $conex->lastInsertId();
            else
                $errores = true;

            $insertPedidoPlatillo = "INSERT INTO pedidoplatillo(idPedido,idPlatillo,especificaciones,cantidad) VALUES(:idPedido,:idPlatillo,:especificaciones,:cantidad)";
            if (isset($pedido)) {
                foreach ($pedido as $key => $value) {
                    foreach ($value as $clave => $valor) {
                        foreach ($valor as $clv => $val) {
                            //print_r($valor[1]); //cantidad
                            //print_r($valor[0]); //nombre
                            //print_r($valor[2]); //especificaciones
                            //print_r($valor[3]); //total
                            $stmtPP = $conex->prepare($insertPedidoPlatillo);
                            $stmtPP->bindParam(':idPedido', $id);
                            $stmtPP->bindParam(':idPlatillo', $clave);
                            $stmtPP->bindParam(':especificaciones', $val[2]);
                            $stmtPP->bindParam(':cantidad', $val[1]);
                            $valPP = $stmtPP->execute();
                            if ($valPP)
                                $idPedidoPlatillo = $conex->lastInsertId();
                            else
                                $errores = true;
                        }
                    }
                }
            }

            $insertPedidoIngrediente = "INSERT INTO pedidoplatilloingrediente(idPedidoPlatillo,idIngrediente) VALUES(:idPedidoPlatillo,:idIngrediente)";
            if (isset($pedido)) {
                foreach ($pedido as $key => $value) {
                    foreach ($value as $clave => $valor) {
                        foreach ($valor as $clv => $val) {
                            $stmtPI = $conex->prepare($insertPedidoIngrediente);
                            $stmtPI->bindParam(':idPedidoPlatillo', $idPedidoPlatillo);
                            if (is_numeric($clv)) {
                                $stmtPI->bindParam(':idIngrediente', $clv);
                                $valPI = $stmtPI->execute();
                            }
                            else
                                $valPI = true;
                        }
                    }
                }
            }

            if ($valPI && $valPP && $val) {
                $conex->commit();
                //$_SESSION["'rest" . $idRestaurante . "'"] = null;
            } else {
                print_r('Ocurrió un error y no se pudo realizar el pedido');
                print_r($stmtPI->errorInfo());
                if (!$valPI)
                //print_r('Fallo el ultimo');
                    if (!$valPP)
                    //print_r('Fallo el penultimo');
                        $errores = true;
                $conex->rollBack();
            }
            //$_SESSION["'rest".$_GET['i']."'"] = null;
        } catch (Exception $e) {
            $errores = true;
            //print_r('Ocurrió un error y no se pudo realizar el pedido: ', $e->getMessage());
            $conex->rollBack();
        }
        /* } else {
          print_r('Favor de llenar correctamente los campos');
          } */
    } else {
        $errores = $id;
        //print_r('Favor de hacer login');
    }
    return $errores;
}

function utf8replace($cadena) {
    str_replace('&#193;', 'A', $cadena);
    str_replace('&#201;', 'E', $cadena);
    str_replace('&#205;', 'I', $cadena);
    str_replace('&#211;', 'O', $cadena);
    str_replace('&#218;', 'U', $cadena);
    str_replace('&#209;', 'N', $cadena);
    str_replace('Ä', 'A', $cadena);
    str_replace('Ë', 'E', $cadena);
    str_replace('Ï', 'I', $cadena);
    str_replace('Ö', 'O', $cadena);
    str_replace('Ü', 'U', $cadena);
    str_replace('&#225;', 'a', $cadena);
    str_replace('&#233;', 'e', $cadena);
    str_replace('&#237;', 'i', $cadena);
    str_replace('&#243;', 'o', $cadena);
    str_replace('&#250;', 'u', $cadena);
    str_replace('&#241;', 'n', $cadena);
    str_replace('ä', 'a', $cadena);
    str_replace('ë', 'e', $cadena);
    str_replace('ï', 'i', $cadena);
    str_replace('ö', 'o', $cadena);
    str_replace('ü', 'u', $cadena);
    str_replace('%3A', '', $cadena);
    return $cadena;
}

function eliminarPlatilloPedido() {
    unset($_SESSION["'rest" . $_GET['ir'] . "'"][$_GET['pc']]);
    $_SESSION["'rest" . $_GET['ir'] . "'"] = array_values($_SESSION["'rest" . $_GET['ir'] . "'"]);
}

function guardaDireccion() {
    $colonia = $_POST['colonia'];
    $calle = $_POST['calle'];
    $numero = $_POST['numero'];
    $numeroint = $_POST['numeroint'];
    $referencia = $_POST['referencia'];

    $val = false;

    if ((isset($colonia) && $colonia != "") && (isset($calle) && $calle != "") && (isset($numero) && $numero != "")) {
        global $conex;
        $insertDireccion = "INSERT INTO direccion(idUsuario,idColonia,calle,numero,numeroint,referencia) VALUES(:idUsuario,:idColonia,:calle,:numero,:numeroint,:referencia)";
        $stmtP = $conex->prepare($insertDireccion);
        $stmtP->bindParam(':idUsuario', $_SESSION['idUsuario']);
        $stmtP->bindValue(':idColonia', $colonia);
        $stmtP->bindValue(':calle', $calle);
        $stmtP->bindValue(':numero', $numero);
        $stmtP->bindValue(':numeroint', $numeroint);
        $stmtP->bindParam(':referencia', $referencia);
        $val = $stmtP->execute();
    }
    if ($val) {
        $respuesta['direccion'] = $conex->lastInsertId();
    } else {
        $respuesta = false;
    }
    return $respuesta;
}

function getPedidosDeRestaurante($idRestaurante, $estado) {
    global $conex;
    $stmt = $conex->prepare("SELECT p.*
                            FROM pedido p
                            WHERE idRestaurante=:idRestaurante AND idEstadoPedido = :estado");
    $stmt->bindParam(':idRestaurante', $idRestaurante);
    $stmt->bindParam(':estado', $estado);
    if ($stmt->execute()) {
        $rows = $stmt->fetchAll();
        return $rows;
    } else {
        return null;
    }
}

function getDetallesDePedido($idPedido) {
    global $conex;
    $stmt = $conex->prepare("SELECT p.idPedido, p.idMetodoEntrega, p.idTipoPago,
                            p.numReferencia, p.total, p.gastoDeEnvio, p.comision, 
                            p.idEstadoPedido, pl.nombre, pl.idPlatillo, 
                            pp.especificaciones, pp.cantidad, pp.precio, 
                            i.nombre as nombreIngrediente
                            FROM pedido p
                            LEFT OUTER JOIN pedidoplatillo pp ON p.idPedido = pp.idPedido
                            LEFT OUTER JOIN platillo pl ON pp.idPlatillo = pl.idPlatillo
                            LEFT OUTER JOIN pedidoplatilloingrediente ppi ON pp.idPedidoPlatillo = ppi.idPedidoPlatillo
                            LEFT OUTER JOIN ingrediente i ON ppi.idIngrediente = i.idIngrediente
                            WHERE p.idPedido=:idPedido");
    $stmt->bindParam(':idPedido', $idPedido);
    if ($stmt->execute()) {
        $rows = $stmt->fetchAll();
        return $rows;
    } else {
        return null;
    }
}

function cambiarEstadoDePedido($idPedido, $estado) {
    global $conex;
    $stmt = $conex->prepare("UPDATE pedido 
                            SET idEstadoPedido = :estado
                            WHERE idPedido = :idPedido");
    $stmt->bindParam(':estado', $estado);
    $stmt->bindParam(':idPedido', $idPedido);
    return $stmt->execute();
}

?>
