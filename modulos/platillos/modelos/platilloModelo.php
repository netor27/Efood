<?php

require_once 'bd/conx.php';

function altaPlatillo($platillo) {
    global $conex;
    $id = -1;
    try {
        $conex->beginTransaction();
        $stmt = $conex->prepare("INSERT into platillo (idRestaurante, nombre, categoria, descripcion, precioBase,hint) 
                            values (:idRestaurante,:nombre,:categoria,:descripcion,:precioBase,:hint)");
        $stmt->bindParam(':idRestaurante', $platillo->idRestaurante);
        $stmt->bindParam(':nombre', $platillo->nombre);
        $stmt->bindParam(':categoria', $platillo->categoria);
        $stmt->bindParam(':descripcion', $platillo->descripcion);
        $stmt->bindParam(':precioBase', $platillo->precioBase);
        $stmt->bindParam(':hint', $platillo->hint);
        $val = $stmt->execute();
        if ($val) {
            $id = $conex->lastInsertId();
            $stmt = $conex->prepare("INSERT into horarioplatillo (idPlatillo) values(:id)");
            $stmt->bindParam(':id', $id);
            if ($stmt->execute()) {
                $conex->commit();
            } else {
                $conex->rollBack();
            }
        } else {
            //print_r($stmt->errorInfo());
            $conex->rollBack();
        }
    } catch (Exception $e) {
        $conex->rollBack();
    }
    return $id;
}

function bajaPlatillo($idPlatillo) {
    global $conex;
    try {
        $conex->beginTransaction();
        $stmt = $conex->prepare("DELETE FROM platillo WHERE idPlatillo = :id");
        $stmt->bindParam(':id', $idPlatillo);
        if ($stmt->execute()) {
            $stmt = $conex->prepare("DELETE FROM horarioplatillo WHERE idPlatillo = :id");
            $stmt->bindParam(':id', $idPlatillo);
            if ($stmt->execute()) {
                $conex->commit();
            } else {
                $conex->rollBack();
            }
        } else {
            $conex->rollBack();
        }
    } catch (Exception $E) {
        $conex->rollBack();
    }
    return $stmt->rowCount();
}

function modificaPlatillo($platillo) {
    global $conex;
    $stmt = $conex->prepare("UPDATE platillo 
                            SET nombre=:nombre, categoria=:categoria, descripcion=:descripcion, 
                            precioBase=:precioBase, hint=:hint
                            WHERE idPlatillo=:idPlatillo");
    $stmt->bindParam(':idPlatillo', $platillo->idPlatillo);
    $stmt->bindParam(':nombre', $platillo->nombre);
    $stmt->bindParam(':categoria', $platillo->categoria);
    $stmt->bindParam(':descripcion', $platillo->descripcion);
    $stmt->bindParam(':precioBase', $platillo->precioBase);
    $stmt->bindParam(':hint', $platillo->hint);
    if ($stmt->execute()) {
        return true;
    } else {
        print_r($stmt->errorInfo());
        return false;
    }
}

function getPlatillos() {
    global $conex;
    $stmt = $conex->query("SELECT * FROM platillo");
    if ($stmt->execute()) {
        $platillos = array();
        $rows = $stmt->fetchAll();
        require_once 'modulos/platillos/clases/Platillo.php';
        $i = 0;
        foreach ($rows as $row) {
            $platillo = new Platillo();
            $platillo->idPlatillo = $row['idPlatillo'];
            $platillo->idRestaurante = $row['idRestaurante'];
            $platillo->nombre = $row['nombre'];
            $platillo->categoria = $row['categoria'];
            $platillo->descripcion = $row['descripcion'];
            $platillo->horario = $row['horario'];
            $platillo->precioBase = $row['precioBase'];
            $platillo->hint = $row['hint'];
            $platillos[$i] = $platillo;
            $i++;
        }
        return $platillos;
    } else {
        print_r($stmt->errorInfo());
        return NULL;
    }
}

function getPlatillo($idPlatillo) {
    global $conex;
    $stmt = $conex->prepare("SELECT * FROM platillo WHERE idPlatillo = :id");
    $stmt->bindParam(':id', $idPlatillo);
    if ($stmt->execute()) {
        $row = $stmt->fetch();
        require_once 'modulos/platillos/clases/Platillo.php';
        $platillo = new Platillo();
        $platillo->idPlatillo = $row['idPlatillo'];
        $platillo->idRestaurante = $row['idRestaurante'];
        $platillo->nombre = $row['nombre'];
        $platillo->categoria = $row['categoria'];
        $platillo->descripcion = $row['descripcion'];
        $platillo->precioBase = $row['precioBase'];
        $platillo->hint = $row['hint'];
        return $platillo;
    } else {
        return NULL;
    }
}

function getPlatillosDeRestaurante($idRestaurante) {
    global $conex;
    $stmt = $conex->prepare("SELECT * FROM platillo 
                            WHERE idRestaurante = :id 
                            ORDER BY idPlatillo ASC");
    $stmt->bindParam(':id', $idRestaurante);
    if ($stmt->execute()) {
        $platillos = array();
        $rows = $stmt->fetchAll();
        require_once 'modulos/platillos/clases/Platillo.php';
        $i = 0;
        foreach ($rows as $row) {
            $platillo = new Platillo();
            $platillo->idPlatillo = $row['idPlatillo'];
            $platillo->idRestaurante = $row['idRestaurante'];
            $platillo->nombre = $row['nombre'];
            $platillo->categoria = $row['categoria'];
            $platillo->descripcion = $row['descripcion'];
            $platillo->precioBase = $row['precioBase'];
            $platillo->hint = $row['hint'];
            $platillos[$i] = $platillo;
            $i++;
        }
        return $platillos;
    } else {
        print_r($stmt->errorInfo());
        return NULL;
    }
}

function getIdRestauranteDePlatillo($idPlatillo) {
    global $conex;
    $stmt = $conex->prepare("SELECT idRestaurante FROM platillo WHERE idPlatillo = :id");
    $stmt->bindParam(':id', $idPlatillo);
    $idRestaurante = -1;
    if ($stmt->execute()) {
        $row = $stmt->fetch();
        $idRestaurante = $row['idRestaurante'];
    } else {
        print_r($stmt->errorInfo());
    }
    return $idRestaurante;
}

function getHorarioPlatillo($idPlatillo) {
    global $conex;
    $stmt = $conex->prepare("SELECT * FROM  horarioplatillo
                            WHERE idPlatillo = :idPlatillo");
    $stmt->bindParam(":idPlatillo", $idPlatillo);

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

function actualizaHorarioPlatillo($idPlatillo, $horario) {
    global $conex;
    $stmt = $conex->prepare("UPDATE horarioplatillo
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
                            WHERE idPlatillo = :idPlatillo");
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
    $stmt->bindParam(':idPlatillo', $idPlatillo);

    if ($stmt->execute()) {
        return true;
    } else {
        print_r($stmt->errorInfo());
        return false;
    }
}

?>