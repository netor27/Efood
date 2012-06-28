<?php

/**
 * Description of DelegacionModelo
 *
 * @author neto
 */
require_once 'bd/conx.php';

function altaDelegacion($delegacion) {
    global $conex;
    $stmt = $conex->prepare("INSERT INTO delegacion(nombre, entidad)
                            VALUES (:nombre, :entidad)");
    $stmt->bindParam(":nombre", $delegacion->nombre);
    $stmt->bindParam(":entidad", $delegacion->entidad);
    $id = -1;
    if ($stmt->execute()) {
        $id = $conex->lastInsertId();
    } else {
        print_r($stmt->errorInfo());
    }
    return $id;
}

function bajaDelegacion($idDelegacion) {
    global $conex;
    $stmt = $conex->prepare("DELETE FROM delegacion
                            WHERE idDelegacion = :idDelegacion");
    $stmt->bindParam(":idDelegacion", $idDelegacion);
    if ($stmt->execute())
        return true;
    else {
        print_r($stmt->errorInfo());
        return false;
    }
}

function getDelegacion($idDelegacion) {
    global $conex;
    $stmt = $conex->prepare("SELECT * FROM delegacion
                            WHERE idDelegacion = :idDelegacion");
    $stmt->bindParam(":idDelegacion", $idDelegacion);
    if ($stmt->execute()) {
        $row = $stmt->fetch();
        require_once 'modulos/colonias/clases/Delegacion.php';
        $delegacion = new Delegacion();
        $delegacion->idDelegacion = $row['idDelegacion'];
        $delegacion->nombre = $row['nombre'];
        $delegacion->entidad = $row['entidad'];
        return $delegacion;
    } else {
        print_r($stmt->errorInfo());
        return NULL;
    }
}

function getDelegaciones() {
    global $conex;
    $stmt = $conex->prepare("SELECT * FROM delegacion");    
    if ($stmt->execute()) {
        $rows = $stmt->fetchAll();
        $delegaciones = array();
        require_once 'modulos/colonias/clases/Delegacion.php';
        $i = 0;
        foreach ($rows as $row) {
            $delegacion = new Delegacion();
            $delegacion->idDelegacion = $row['idDelegacion'];
            $delegacion->nombre = $row['nombre'];
            $delegacion->entidad = $row['entidad'];
            $delegaciones[$i] = $delegacion;
            $i++;
        }
        return $delegaciones;
    } else {
        print_r($stmt->errorInfo());
        return NULL;
    }
}

?>