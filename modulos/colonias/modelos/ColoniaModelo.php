<?php

/**
 * Description of ColoniaModelo
 *
 * @author neto
 */
require_once 'bd/conx.php';

function altaColonia($colonia) {
    global $conex;
    $stmt = $conex->prepare("INSERT INTO colonia(idDelegacion, nombre, cp)
                            VALUES (:idDelegacion, :nombre, :cp)");
    $stmt->bindParam(":idDelegacion", $colonia->idDelegacion);
    $stmt->bindParam(":nombre", $colonia->nombre);
    $stmt->bindParam(":cp", $colonia->cp);
    $id = -1;
    if ($stmt->execute()) {
        $id = $conex->lastInsertId();
    } else {
        print_r($stmt->errorInfo());
    }
    return $id;
}

function bajaColonia($idColonia) {
    global $conex;
    $stmt = $conex->prepare("DELETE FROM colonia
                            WHERE idColonia = :idColonia");
    $stmt->bindParam(":idColonia", $idColonia);
    if ($stmt->execute())
        return true;
    else {
        print_r($stmt->errorInfo());
        return false;
    }
}

function getColonia($idColonia) {
    global $conex;
    $stmt = $conex->prepare("SELECT * FROM colonia
                            WHERE idColonia = :idColonia");
    $stmt->bindParam(":idColonia", $idColonia);
    if ($stmt->execute()) {
        $row = $stmt->fetch();
        require_once 'modulos/colonias/clases/Colonia.php';
        $colonia = new Colonia();
        $colonia->idColonia = $row['idColonia'];
        $colonia->idDelegacion = $row['idDelegacion'];
        $colonia->nombre = utf8_encode($row['nombre']);
        $colonia->cp = $row['cp'];
        return $colonia;
    } else {
        print_r($stmt->errorInfo());
        return NULL;
    }
}

function getColonias() {
    global $conex;
    $stmt = $conex->prepare("SELECT * FROM colonia");
    if ($stmt->execute()) {
        $rows = $stmt->fetchAll();
        $colonias = array();
        require_once 'modulos/colonias/clases/Colonia.php';
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
        return $colonias;
    } else {
        print_r($stmt->errorInfo());
        return NULL;
    }
}

function busquedaColonias($term) {
    global $conex;
    $stmt = $conex->prepare("SELECT * FROM colonia
                            WHERE nombre LIKE :term");
    $term = "%" . $term . "%";
    $stmt->bindParam(":term", $term);
    if ($stmt->execute()) {
        $array = array();
        $rows = $stmt->fetchAll();
        foreach ($rows as $row) {
            $array[$row['idColonia']] = $row['nombre'];
        }
        return $array;
    } else {
        print_r($stmt->errorInfo());
        return NULL;
    }
}

function busquedaColoniasUTF8($term) {
    global $conex;
    $stmt = $conex->prepare("SELECT * FROM colonia
                            WHERE nombre LIKE :term");
    $term = "%" . $term . "%";
    $stmt->bindParam(":term", $term);
    if ($stmt->execute()) {
        $array = array();
        $rows = $stmt->fetchAll();
        $i = 0;
        foreach ($rows as $row) {
            $aux = array();
            $aux['id'] = utf8_encode($row['idColonia']);
            $aux['label'] = utf8_encode($row['nombre'] ." CP. " . $row['cp']);
            $aux['value'] = utf8_encode($row['nombre'] . " CP. " . $row['cp']);
            $array[$i] = $aux;
            $i++;
        }
        return $array;
    } else {
        print_r($stmt->errorInfo());
        return NULL;
    }
}

?>
