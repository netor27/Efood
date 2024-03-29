<?php

/**
 * Description of RestauranteModelo
 *
 * @author neto
 */
require_once 'bd/conx.php';

function altaRestaurante($restaurante) {
    global $conex;
    $stmt = $conex->prepare("INSERT INTO restaurante
                            (usuario,password,nombre,idColonia,descripcion,pedidoMinimo,gastoEnvio,formaPago,rfc,razonSocial,paginaWeb,telefono,email,metodoEntrega,calle,numero,numeroInt,referencia,nombreContacto,telefonoContacto,comision,tipoGastoEnvio,tipoComision,informacion)
                            VALUES(:usuario,:password,:nombre,:idColonia,:descripcion,:pedidoMinimo,:gastoEnvio,:formaPago,:rfc,:razonSocial,:paginaWeb,:telefono,:email,:metodoEntrega,:calle,:numero,:numeroInt,:referencia,:nombreContacto,:telefonoContacto,:comision,:tipoGastoEnvio,:tipoComision,:informacion)");
    $id = -1;
    try {
        $conex->beginTransaction();
        $stmt->bindParam(":usuario", $restaurante->usuario);
        $stmt->bindParam(":password", $restaurante->password);
        $stmt->bindParam(":nombre", $restaurante->nombre);
        $stmt->bindParam(":idColonia", $restaurante->idColonia);
        $stmt->bindParam(":descripcion", $restaurante->descripcion);
        $stmt->bindParam(":pedidoMinimo", $restaurante->pedidoMinimo);
        $stmt->bindParam(":gastoEnvio", $restaurante->gastoEnvio);
        $stmt->bindParam(":formaPago", $restaurante->formaPago);
        $stmt->bindParam(":rfc", $restaurante->rfc);
        $stmt->bindParam(":razonSocial", $restaurante->razonSocial);
        $stmt->bindParam(":paginaWeb", $restaurante->paginaWeb);
        $stmt->bindParam(":telefono", $restaurante->telefono);
        $stmt->bindParam(":email", $restaurante->email);
        $stmt->bindParam(":metodoEntrega", $restaurante->metodoEntrega);
        $stmt->bindParam(":calle", $restaurante->calle);
        $stmt->bindParam(":numero", $restaurante->numero);
        $stmt->bindParam(":numeroInt", $restaurante->numeroInt);
        $stmt->bindParam(":referencia", $restaurante->referencia);
        $stmt->bindParam(":nombreContacto", $restaurante->nombreContacto);
        $stmt->bindParam(":telefonoContacto", $restaurante->telefonoContacto);
        $stmt->bindParam(":comision", $restaurante->comision);
        $stmt->bindParam(":tipoGastoEnvio", $restaurante->tipoGastoEnvio);
        $stmt->bindParam(":tipoComision", $restaurante->tipoComision);
        $stmt->bindParam(":informacion", $restaurante->informacion);

        if ($stmt->execute()) {
            $id = $conex->lastInsertId();
            $stmt = $conex->prepare("INSERT into horariorestaurante (idRestaurante) values(:id)");
            $stmt->bindParam(":id", $id);
            if ($stmt->execute()) {
                $conex->commit();
            } else {
                $id = -1;
                $conex->rollBack();
            }
        } else {
            $id = -1;
            $conex->rollBack();
            print_r($stmt->errorInfo());
        }
    } catch (Exception $e) {
        $id = -1;
        $conex->rollBack();
    }
    return $id;
}

function bajaRestaurante($idRestaurante) {
    global $conex;
    $stmt = $conex->prepare("DELETE FROM restaurante
                            WHERE idRestaurante = :idRestaurante");
    $res = false;
    try {
        $stmt->bindParam(":idRestaurante", $idRestaurante);
        $conex->beginTransaction();
        if ($stmt->execute()) {
            $stmt = $conex->prepare("DELETE FROM horariorestaurante
                                     WHERE idRestaurante = :idRestaurante");
            $stmt->bindParam(":idRestaurante", $idRestaurante);
            if ($stmt->execute()) {
                $conex->commit();
                $res = true;
            } else {
                $res = false;
                $conex->rollBack();
            }
        } else {
            print_r($stmt->errorInfo());
            $conex->rollBack();
            $res = false;
        }
    } catch (Exception $e) {
        $res = false;
        $conex->rollBack();
    }
    return $res;
}

function modificaRestaurante($restaurante) {
    global $conex;
    $stmt = $conex->prepare("UPDATE restaurante
                            SET usuario =:usuario,
                                nombre =:nombre,
                                idColonia =:idColonia,
                                descripcion =:descripcion,                                
                                pedidoMinimo =:pedidoMinimo,
                                gastoEnvio =:gastoEnvio,
                                formaPago =:formaPago,
                                rfc =:rfc,
                                razonSocial =:razonSocial,
                                paginaWeb =:paginaWeb,
                                telefono =:telefono,
                                email =:email,
                                metodoEntrega =:metodoEntrega,
                                calle =:calle,
                                numero =:numero,
                                numeroInt =:numeroInt,
                                referencia = :referencia,
                                nombreContacto = :nombreContacto,
                                telefonoContacto = :telefonoContacto,
                                comision = :comision,
                                tipoComision = :tipoComision,
                                tipoGastoEnvio = :tipoGasto,
                                habilitado = :habilitado,
                                informacion = :informacion                                
                                WHERE idRestaurante = :idRestaurante
                                ");
    $stmt->bindParam(":usuario", $restaurante->usuario);
    $stmt->bindParam(":nombre", $restaurante->nombre);
    $stmt->bindParam(":idColonia", $restaurante->idColonia);
    $stmt->bindParam(":descripcion", $restaurante->descripcion);
    $stmt->bindParam(":pedidoMinimo", $restaurante->pedidoMinimo);
    $stmt->bindParam(":gastoEnvio", $restaurante->gastoEnvio);
    $stmt->bindParam(":formaPago", $restaurante->formaPago);
    $stmt->bindParam(":rfc", $restaurante->rfc);
    $stmt->bindParam(":razonSocial", $restaurante->razonSocial);
    $stmt->bindParam(":paginaWeb", $restaurante->paginaWeb);
    $stmt->bindParam(":telefono", $restaurante->telefono);
    $stmt->bindParam(":email", $restaurante->email);
    $stmt->bindParam(":metodoEntrega", $restaurante->metodoEntrega);
    $stmt->bindParam(":calle", $restaurante->calle);
    $stmt->bindParam(":numero", $restaurante->numero);
    $stmt->bindParam(":numeroInt", $restaurante->numeroInt);
    $stmt->bindParam(":referencia", $restaurante->referencia);
    $stmt->bindParam(":nombreContacto", $restaurante->nombreContacto);
    $stmt->bindParam(":telefonoContacto", $restaurante->telefonoContacto);
    $stmt->bindParam(":comision", $restaurante->comision);
    $stmt->bindParam(":tipoComision", $restaurante->tipoComision);
    $stmt->bindParam(":tipoGasto", $restaurante->tipoGastoEnvio);
    $stmt->bindParam(":habilitado", $restaurante->habilitado);
    $stmt->bindParam(":informacion", $restaurante->informacion);
    $stmt->bindParam(":idRestaurante", $restaurante->idRestaurante);

    if ($stmt->execute()) {
        return true;
    } else {
        print_r($stmt->errorInfo());
        return false;
    }
}

function actualizarPassword($idRestaurante, $pass) {
    global $conex;
    $stmt = $conex->prepare("UPDATE restaurante
                            SET password = :pass
                                WHERE idRestaurante = :idRestaurante
                                ");
    $stmt->bindParam(":pass", $pass);
    $stmt->bindParam(":idRestaurante", $idRestaurante);
    if ($stmt->execute()) {
        return true;
    } else {
        print_r($stmt->errorInfo());
        return false;
    }
}

function actualizaLogoRestaurante($idRestaurante, $logo) {
    global $conex;
    $stmt = $conex->prepare("UPDATE restaurante
                            SET logo =:logo
                                WHERE idRestaurante = :idRestaurante
                                ");
    $stmt->bindParam(":logo", $logo);
    $stmt->bindParam(":idRestaurante", $idRestaurante);

    if ($stmt->execute()) {
        return true;
    } else {
        print_r($stmt->errorInfo());
        return false;
    }
}

function getRestaurante($idRestaurante) {
    global $conex;
    $stmt = $conex->prepare("SELECT * FROM restaurante
                            WHERE idRestaurante = :idRestaurante");
    $stmt->bindParam(":idRestaurante", $idRestaurante);
    if ($stmt->execute()) {
        $row = $stmt->fetch();
        require_once 'modulos/restaurantes/clases/Restaurante.php';
        $restaurante = new Restaurante();
        $restaurante->calle = $row['calle'];
        $restaurante->descripcion = $row['descripcion'];
        $restaurante->email = $row['email'];
        $restaurante->formaPago = $row['formaPago'];
        $restaurante->gastoEnvio = $row['gastoEnvio'];
        $restaurante->idColonia = $row['idColonia'];
        $restaurante->idRestaurante = $row['idRestaurante'];
        $restaurante->logo = $row['logo'];
        $restaurante->metodoEntrega = $row['metodoEntrega'];
        $restaurante->nombre = $row['nombre'];
        $restaurante->numero = $row['numero'];
        $restaurante->numeroInt = $row['numeroInt'];
        $restaurante->paginaWeb = $row['paginaWeb'];
        $restaurante->password = $row['password'];
        $restaurante->pedidoMinimo = $row['pedidoMinimo'];
        $restaurante->razonSocial = $row['razonSocial'];
        $restaurante->referencia = $row['referencia'];
        $restaurante->rfc = $row['rfc'];
        $restaurante->telefono = $row['telefono'];
        $restaurante->usuario = $row['usuario'];
        $restaurante->nombreContacto = $row['nombreContacto'];
        $restaurante->telefonoContacto = $row['telefonoContacto'];
        $restaurante->comision = $row['comision'];
        $restaurante->tipoGastoEnvio = $row['tipoGastoEnvio'];
        $restaurante->habilitado = $row['habilitado'];
        $restaurante->tipoComision = $row['tipoComision'];
        $restaurante->informacion = $row['informacion'];
        $restaurante->horario = getHorario($idRestaurante);
        $restaurante->tiposComida = getTipoComidaRestaurante($idRestaurante);
        return $restaurante;
    } else {
        return NULL;
    }
}

function getRestaurantePorLogin($usuario, $pass) {
    global $conex;
    $stmt = $conex->prepare("SELECT * FROM restaurante
                            WHERE usuario = :usuario AND password = :pass");
    $stmt->bindParam(":usuario", $usuario);
    $stmt->bindParam(":pass", $pass);

    $stmt->execute();
    //echo $stmt->rowCount();
    if ($stmt->rowCount() == 1) {
        $row = $stmt->fetch();
        require_once 'modulos/restaurantes/clases/Restaurante.php';
        $restaurante = new Restaurante();
        $restaurante->idRestaurante = $row['idRestaurante'];
        $restaurante->calle = $row['calle'];
        $restaurante->descripcion = $row['descripcion'];
        $restaurante->email = $row['email'];
        $restaurante->formaPago = $row['formaPago'];
        $restaurante->gastoEnvio = $row['gastoEnvio'];
        $restaurante->idColonia = $row['idColonia'];
        $restaurante->idRestaurante = $row['idRestaurante'];
        $restaurante->logo = $row['logo'];
        $restaurante->metodoEntrega = $row['metodoEntrega'];
        $restaurante->nombre = $row['nombre'];
        $restaurante->numero = $row['numero'];
        $restaurante->numeroInt = $row['numeroInt'];
        $restaurante->paginaWeb = $row['paginaWeb'];
        $restaurante->password = $row['password'];
        $restaurante->pedidoMinimo = $row['pedidoMinimo'];
        $restaurante->razonSocial = $row['razonSocial'];
        $restaurante->referencia = $row['referencia'];
        $restaurante->rfc = $row['rfc'];
        $restaurante->telefono = $row['telefono'];
        $restaurante->usuario = $row['usuario'];
        $restaurante->nombreContacto = $row['nombreContacto'];
        $restaurante->telefonoContacto = $row['telefonoContacto'];
        $restaurante->comision = $row['comision'];
        $restaurante->tipoGastoEnvio = $row['tipoGastoEnvio'];
        $restaurante->habilitado = $row['habilitado'];
        $restaurante->tipoComision = $row['tipoComision'];
        $restaurante->informacion = $row['informacion'];
        return $restaurante;
    } else {
        return NULL;
    }
}

function getRestaurantes() {
    global $conex;
    $stmt = $conex->prepare("SELECT * FROM restaurante order by idRestaurante desc ");
    if ($stmt->execute()) {
        $restaurantes = array();
        $rows = $stmt->fetchAll();
        require_once 'modulos/restaurantes/clases/Restaurante.php';
        $i = 0;
        foreach ($rows as $row) {
            $restaurante = new Restaurante();
            $restaurante->calle = $row['calle'];
            $restaurante->descripcion = $row['descripcion'];
            $restaurante->email = $row['email'];
            $restaurante->formaPago = $row['formaPago'];
            $restaurante->gastoEnvio = $row['gastoEnvio'];
            $restaurante->idColonia = $row['idColonia'];
            $restaurante->idRestaurante = $row['idRestaurante'];
            $restaurante->logo = $row['logo'];
            $restaurante->metodoEntrega = $row['metodoEntrega'];
            $restaurante->nombre = $row['nombre'];
            $restaurante->numero = $row['numero'];
            $restaurante->numeroInt = $row['numeroInt'];
            $restaurante->paginaWeb = $row['paginaWeb'];
            $restaurante->password = $row['password'];
            $restaurante->pedidoMinimo = $row['pedidoMinimo'];
            $restaurante->razonSocial = $row['razonSocial'];
            $restaurante->referencia = $row['referencia'];
            $restaurante->rfc = $row['rfc'];
            $restaurante->telefono = $row['telefono'];
            $restaurante->usuario = $row['usuario'];
            $restaurante->nombreContacto = $row['nombreContacto'];
            $restaurante->telefonoContacto = $row['telefonoContacto'];
            $restaurante->comision = $row['comision'];
            $restaurante->tipoGastoEnvio = $row['tipoGastoEnvio'];
            $restaurante->habilitado = $row['habilitado'];
            $restaurante->tipoComision = $row['tipoComision'];
            $restaurante->informacion = $row['informacion'];
            $restaurantes[$i] = $restaurante;
            $i++;
        }
        return $restaurantes;
    } else {
        print_r($stmt->errorInfo());
        return NULL;
    }
}

function getColoniasEntrega($idRestaurante) {
    global $conex;
    $stmt = $conex->prepare("SELECT c.idColonia, c.idDelegacion, c.nombre, c.cp
                            FROM  colonia c, restaurantecolonia rc
                            WHERE c.idColonia = rc.idColonia AND rc.idRestaurante = :idRestaurante");
    $stmt->bindParam(":idRestaurante", $idRestaurante);
    $colonias = array();
    if ($stmt->execute()) {
        require_once 'modulos/colonias/clases/Colonia.php';
        $rows = $stmt->fetchAll();
        $i = 0;
        foreach ($rows as $row) {
            $colonia = new Colonia();
            $colonia->idColonia = $row['idColonia'];
            $colonia->idDelegacion = $row['idDelegacion'];
            $colonia->nombre = utf8_encode($row['nombre']);
            $colonia->cp = utf8_encode($row['cp']);
            $colonias[$i] = $colonia;
            $i++;
        }
    }
    return $colonias;
}

function getTipoComidaRestaurante($idRestaurante) {
    global $conex;
    $stmt = $conex->prepare("SELECT t.idTipoComida, t.nombre
                            FROM  tipocomida t, restaurantetipocomida rt
                            WHERE t.idTipoComida = rt.idTipoComida AND rt.idRestaurante = :idRestaurante");
    $stmt->bindParam(":idRestaurante", $idRestaurante);
    $tiposComida = array();
    if ($stmt->execute()) {
        require_once 'modulos/tipoComida/clases/tipoComida.php';
        $rows = $stmt->fetchAll();
        $i = 0;
        foreach ($rows as $row) {
            $tipoComida = new TipoComida();
            $tipoComida->idTipoComida = $row['idTipoComida'];
            $tipoComida->nombre = $row['nombre'];
            $tiposComida[$i] = $tipoComida;
            $i++;
        }
    }
    return $tiposComida;
}

function agregarRelacionColoniaEntrega($idRestaurante, $idColonia) {
    global $conex;
    $stmt = $conex->prepare("INSERT INTO restaurantecolonia
                            (idRestaurante, idColonia)
                            VALUES(:idRestaurante, :idColonia)");

    $stmt->bindParam(":idRestaurante", $idRestaurante);
    $stmt->bindParam(":idColonia", $idColonia);

    if ($stmt->execute())
        return TRUE;
    else {
        print_r($stmt->errorInfo());
        return FALSE;
    }
}

function eliminarRelacionColoniaEntrega($idRestaurante, $idColonia) {
    global $conex;
    $stmt = $conex->prepare("DELETE FROM restaurantecolonia
                             WHERE idRestaurante = :idRestaurante AND idColonia = :idColonia");

    $stmt->bindParam(":idRestaurante", $idRestaurante);
    $stmt->bindParam(":idColonia", $idColonia);

    if ($stmt->execute())
        return TRUE;
    else {
        print_r($stmt->errorInfo());
        return FALSE;
    }
}

function agregarRelacionTipoComida($idRestaurante, $idTipoComida) {
    global $conex;
    $stmt = $conex->prepare("INSERT INTO restaurantetipocomida
                            (idRestaurante, idTipoComida)
                            VALUES(:idRestaurante, :idTipoComida)");

    $stmt->bindParam(":idRestaurante", $idRestaurante);
    $stmt->bindParam(":idTipoComida", $idTipoComida);

    if ($stmt->execute())
        return TRUE;
    else {
        print_r($stmt->errorInfo());
        return FALSE;
    }
}

function eliminarRelacionTipoComida($idRestaurante, $idTipoComida) {
    global $conex;
    $stmt = $conex->prepare("DELETE FROM restaurantetipocomida
                             WHERE idRestaurante = :idRestaurante AND idTipoComida = :idTipoComida");

    $stmt->bindParam(":idRestaurante", $idRestaurante);
    $stmt->bindParam(":idTipoComida", $idTipoComida);

    if ($stmt->execute())
        return TRUE;
    else {
        print_r($stmt->errorInfo());
        return FALSE;
    }
}

function getHorario($idRestaurante) {
    global $conex;
    $stmt = $conex->prepare("SELECT * FROM  horariorestaurante
                            WHERE idRestaurante = :idRestaurante");
    $stmt->bindParam(":idRestaurante", $idRestaurante);

    if ($stmt->execute()) {
        require_once 'modulos/restaurantes/clases/Horario.php';
        $horario = new Horario();
        $row = $stmt->fetch();
        $horario->luIni = $row['luIni'];
        $horario->luFin = $row['luFin'];
        $horario->maIni = $row['maIni'];
        $horario->maFin = $row['maFin'];
        $horario->miIni = $row['miIni'];
        $horario->miFin = $row['miFin'];
        $horario->juIni = $row['juIni'];
        $horario->juFin = $row['juFin'];
        $horario->viIni = $row['viIni'];
        $horario->viFin = $row['viFin'];
        $horario->saIni = $row['saIni'];
        $horario->saFin = $row['saFin'];
        $horario->doIni = $row['doIni'];
        $horario->doFin = $row['doFin'];
        return $horario;
    } else {
        print_r($stmt->errorInfo());
        return NULL;
    }
}

function actualizaHorario($idRestaurante, $horario) {
    global $conex;
    $stmt = $conex->prepare("UPDATE horariorestaurante
                            SET 
                                luIni = :luIni,
                                luFin = :luFin,
                                maIni = :maIni,
                                maFin = :maFin,
                                miIni = :miIni,
                                miFin = :miFin,
                                juIni = :juIni,
                                juFin = :juFin,
                                viIni = :viIni,
                                viFin = :viFin,
                                saIni = :saIni,
                                saFin = :saFin,
                                doIni = :doIni,
                                doFin = :doFin  
                            WHERE idRestaurante = :idRestaurante");
    $stmt->bindParam(':luIni', $horario->luIni);
    $stmt->bindParam(':luFin', $horario->luFin);
    $stmt->bindParam(':maIni', $horario->maIni);
    $stmt->bindParam(':maFin', $horario->maFin);
    $stmt->bindParam(':miIni', $horario->miIni);
    $stmt->bindParam(':miFin', $horario->miFin);
    $stmt->bindParam(':juIni', $horario->juIni);
    $stmt->bindParam(':juFin', $horario->juFin);
    $stmt->bindParam(':viIni', $horario->viIni);
    $stmt->bindParam(':viFin', $horario->viFin);
    $stmt->bindParam(':saIni', $horario->saIni);
    $stmt->bindParam(':saFin', $horario->saFin);
    $stmt->bindParam(':doIni', $horario->doIni);
    $stmt->bindParam(':doFin', $horario->doFin);
    $stmt->bindParam(':idRestaurante', $idRestaurante);

    if ($stmt->execute()) {
        return true;
    } else {
        print_r($stmt->errorInfo());
        return false;
    }
}

function getRestaurantesColonia($idColonia) {
    global $conex;
    $stmt = $conex->prepare("SELECT r.*
                            FROM  restaurante r,restaurantecolonia rc
                            WHERE rc.idColonia = :idColonia AND r.idRestaurante = rc.idRestaurante AND r.habilitado=1");
    $stmt->bindParam(":idColonia", $idColonia);
    $restaurantes = array();
    if ($stmt->execute()) {
        require_once 'modulos/restaurantes/clases/Restaurante.php';
        $rows = $stmt->fetchAll();
        $i = 0;
        foreach ($rows as $row) {
            $restaurante = new Restaurante();
            $restaurante->calle = $row['calle'];
            $restaurante->descripcion = $row['descripcion'];
            $restaurante->email = $row['email'];
            $restaurante->formaPago = $row['formaPago'];
            $restaurante->gastoEnvio = $row['gastoEnvio'];
            $restaurante->idColonia = $row['idColonia'];
            $restaurante->idRestaurante = $row['idRestaurante'];
            $restaurante->logo = $row['logo'];
            $restaurante->metodoEntrega = $row['metodoEntrega'];
            $restaurante->nombre = $row['nombre'];
            $restaurante->numero = $row['numero'];
            $restaurante->numeroInt = $row['numeroInt'];
            $restaurante->paginaWeb = $row['paginaWeb'];
            $restaurante->password = $row['password'];
            $restaurante->pedidoMinimo = $row['pedidoMinimo'];
            $restaurante->razonSocial = $row['razonSocial'];
            $restaurante->referencia = $row['referencia'];
            $restaurante->rfc = $row['rfc'];
            $restaurante->telefono = $row['telefono'];
            $restaurante->usuario = $row['usuario'];
            $restaurante->informacion = $row['informacion'];
            $restaurantes[$i] = $restaurante;
            $i++;
        }
        return $restaurantes;
    } else {
        print_r($stmt->errorInfo());
        return NULL;
    }
}

//
//SELECT idRestaurante
//FROM  `restaurantetipocomida` 
//WHERE (
//idTipoComida =11
//OR idTipoComida =21
//OR idTipoComida =1
//OR idTipoComida =211
//

function getRestaurantesColoniaTipoComidaMetodoEntrega($idColonia, $tipoComida, $metodoEntrega) {
    global $conex;
    $query = "SELECT r.* , h.*
        FROM  restaurante r,restaurantecolonia rc, horariorestaurante h
        WHERE rc.idColonia = :idColonia 
        AND r.idRestaurante = rc.idRestaurante 
        AND r.idRestaurante = h.idRestaurante
        AND r.habilitado = 1 ";
    if (isset($metodoEntrega) && $metodoEntrega < 2) {
        $query = $query . "AND (r.metodoEntrega = " . $metodoEntrega . " OR r.metodoEntrega = 2 )";
    }
    if (isset($tipoComida) && sizeof($tipoComida) > 0) {
        $query = $query . " AND r.idRestaurante IN 
                            (SELECT idRestaurante 
                             FROM restaurantetipocomida
                             WHERE ";
        $bandera = false;
        foreach ($tipoComida as $tipo) {
            if ($bandera)
                $query = $query . " OR idTipoComida = " . $tipo;
            else {
                $query = $query . " idTipoComida = " . $tipo;
                $bandera = true;
            }
        }
        $query = $query . " )";
    }

    $stmt = $conex->prepare($query);
    $stmt->bindParam(":idColonia", $idColonia);

    $restaurantes = array();
    if ($stmt->execute()) {
        require_once 'modulos/restaurantes/clases/Restaurante.php';
        require_once 'modulos/restaurantes/clases/Horario.php';
        $rows = $stmt->fetchAll();
        $i = 0;
        $horario = null;
        foreach ($rows as $row) {
            $restaurante = new Restaurante();
            $restaurante->idRestaurante = $row['idRestaurante'];
            $restaurante->calle = $row['calle'];
            $restaurante->descripcion = $row['descripcion'];
            $restaurante->email = $row['email'];
            $restaurante->formaPago = $row['formaPago'];
            $restaurante->gastoEnvio = $row['gastoEnvio'];
            $restaurante->idColonia = $row['idColonia'];
            $restaurante->idRestaurante = $row['idRestaurante'];
            $restaurante->logo = $row['logo'];
            $restaurante->metodoEntrega = $row['metodoEntrega'];
            $restaurante->nombre = $row['nombre'];
            $restaurante->numero = $row['numero'];
            $restaurante->numeroInt = $row['numeroInt'];
            $restaurante->paginaWeb = $row['paginaWeb'];
            $restaurante->password = $row['password'];
            $restaurante->pedidoMinimo = $row['pedidoMinimo'];
            $restaurante->razonSocial = $row['razonSocial'];
            $restaurante->referencia = $row['referencia'];
            $restaurante->rfc = $row['rfc'];
            $restaurante->telefono = $row['telefono'];
            $restaurante->usuario = $row['usuario'];
            $restaurante->tipoGastoEnvio = $row['tipoGastoEnvio'];
            $restaurante->informacion = $row['informacion'];
            $horario = new Horario();
            $horario->doFin = $row['doFin'];
            $horario->doIni = $row['doIni'];
            $horario->luFin = $row['luFin'];
            $horario->luIni = $row['luIni'];
            $horario->maFin = $row['maFin'];
            $horario->maIni = $row['maIni'];
            $horario->miFin = $row['miFin'];
            $horario->miIni = $row['miIni'];
            $horario->juFin = $row['juFin'];
            $horario->juIni = $row['juIni'];
            $horario->viFin = $row['viFin'];
            $horario->viIni = $row['viIni'];
            $horario->saFin = $row['saFin'];
            $horario->saIni = $row['saIni'];
            $restaurante->horario = $horario;

            $restaurante->tiposComida = getTipoComidaRestaurante($restaurante->idRestaurante);
            $restaurantes[$i] = $restaurante;
            $i++;
        }
        return $restaurantes;
    } else {
        print_r($stmt->errorInfo());
        return NULL;
    }
}

function busquedaRestaurantesUTF8($term) {
    global $conex;
    $stmt = $conex->prepare("SELECT r.*,c.cp,c.nombre as nombre_colonia FROM restaurante r, colonia c
                            WHERE r.nombre LIKE :term AND c.idColonia = r.idColonia AND r.habilitado=1");
    $term = "%" . $term . "%";
    $stmt->bindParam(":term", $term);
    if ($stmt->execute()) {
        $array = array();
        $rows = $stmt->fetchAll();
        $i = 0;
        foreach ($rows as $row) {
            $aux = array();
            $aux['id'] = utf8_encode($row['idRestaurante']);
            $aux['label'] = utf8_encode($row['nombre'] . "," . $row['nombre_colonia'] . ",CP. " . $row['cp']);
            $aux['value'] = utf8_encode($row['nombre'] . "," . $row['nombre_colonia'] . ",CP. " . $row['cp']);
            $array[$i] = $aux;
            $i++;
        }
        return $array;
    } else {
        print_r($stmt->errorInfo());
        return NULL;
    }
}

function getRestauranteHabilitado($idRestaurante) {
    global $conex;
    $stmt = $conex->prepare("SELECT * FROM restaurante
                            WHERE idRestaurante = :idRestaurante AND habilitado=1");
    $stmt->bindParam(":idRestaurante", $idRestaurante);
    if ($stmt->execute()) {
        $row = $stmt->fetch();
        require_once 'modulos/restaurantes/clases/Restaurante.php';
        $restaurante = new Restaurante();
        $restaurante->calle = $row['calle'];
        $restaurante->descripcion = $row['descripcion'];
        $restaurante->email = $row['email'];
        $restaurante->formaPago = $row['formaPago'];
        $restaurante->gastoEnvio = $row['gastoEnvio'];
        $restaurante->idColonia = $row['idColonia'];
        $restaurante->idRestaurante = $row['idRestaurante'];
        $restaurante->logo = $row['logo'];
        $restaurante->metodoEntrega = $row['metodoEntrega'];
        $restaurante->nombre = $row['nombre'];
        $restaurante->numero = $row['numero'];
        $restaurante->numeroInt = $row['numeroInt'];
        $restaurante->paginaWeb = $row['paginaWeb'];
        $restaurante->password = $row['password'];
        $restaurante->pedidoMinimo = $row['pedidoMinimo'];
        $restaurante->razonSocial = $row['razonSocial'];
        $restaurante->referencia = $row['referencia'];
        $restaurante->rfc = $row['rfc'];
        $restaurante->telefono = $row['telefono'];
        $restaurante->usuario = $row['usuario'];
        $restaurante->nombreContacto = $row['nombreContacto'];
        $restaurante->telefonoContacto = $row['telefonoContacto'];
        $restaurante->comision = $row['comision'];
        $restaurante->tipoGastoEnvio = $row['tipoGastoEnvio'];
        $restaurante->habilitado = $row['habilitado'];
        $restaurante->tipoComision = $row['tipoComision'];
        $restaurante->informacion = $row['informacion'];

        return $restaurante;
    } else {
        return NULL;
    }
}

?>