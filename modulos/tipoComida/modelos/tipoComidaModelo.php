<?php

/**
 * Description of tipoComidaModelo
 *
 * @author neto
 */
require_once 'bd/conx.php';
require_once 'modulos/tipoComida/clases/tipoComida.php';

function altaTipoComida($tipoComida){
    global $conex;
    $stmt = $conex->prepare("INSERT INTO tipocomida
                            (nombre,imagen)
                            VALUES(:nombre, :imagen)");

    $stmt->bindParam(":nombre", $tipoComida->nombre);
    $stmt->bindParam(":imagen", $tipoComida->imagen);   

    $id = -1;
    if ($stmt->execute()) {
        $id = $conex->lastInsertId();
    } else {
        print_r($stmt->errorInfo());
    }
    return $id;
}

function bajaTipoComida($idTipoComida){
     global $conex;
    $stmt = $conex->prepare("DELETE FROM tipocomida
                            WHERE idTipoComida = :idTipoComida");
    $stmt->bindParam(":idTipoComida", $idTipoComida);
    if ($stmt->execute())
        return true;
    else {
        print_r($stmt->errorInfo());
        return false;
    }
}

function modificaTipoComida($tipoComida){
    global $conex;
    $stmt = $conex->prepare("UPDATE tipocomida
                            SET nombre = :nombre,
                                imagen = :imagen
                                WHERE idTipoComida = :idTipoComida
                                ");
    $stmt->bindParam(":nombre", $tipoComida->nombre);
    $stmt->bindParam(":imagen", $tipoComida->imagen);
    $stmt->bindParam(":idTipoComida", $tipoComida->idTipoComida);

    if ($stmt->execute()) {
        return true;
    } else {
        print_r($stmt->errorInfo());
        return false;
    }
}

function getTipoComida($idTipoComida) {
    global $conex;
    $stmt = $conex->prepare("SELECT * FROM tipocomida
                            WHERE idTipoComida = :idTipoComida");
    $stmt->bindParam(":idTipoComida", $idTipoComida);
    if ($stmt->execute()) {
        $row = $stmt->fetch();
        require_once 'modulos/tipoComida/clases/tipoComida.php';
        $tipoComida = new TipoComida();
        $tipoComida->idTipoComida = $row['idTipoComida'];
        $tipoComida->nombre = $row['nombre'];
        $tipoComida->imagen = $row['imagen'];
        return $tipoComida;
    } else {
        print_r($stmt->errorInfo());
        return NULL;
    }
}

function getTiposComida() {
    global $conex;
    $stmt = $conex->prepare("SELECT * FROM tipocomida");
    if ($stmt->execute()) {
        $rows = $stmt->fetchAll();
        $tiposComida = array();
        require_once 'modulos/tipoComida/clases/tipoComida.php';
        $i = 0;
        foreach ($rows as $row) {
            $tipoComida = new TipoComida();
            $tipoComida->idTipoComida = $row['idTipoComida'];
            $tipoComida->nombre = $row['nombre'];
            $tipoComida->imagen = $row['imagen'];
            $tiposComida[$i] = $tipoComida;
            $i++;
        }
        
        return $tiposComida;
    } else {
        print_r($stmt->errorInfo());
        return NULL;
    }
}



function busquedaTiposComidaUTF8($term) {
    global $conex;
    $stmt = $conex->prepare("SELECT * FROM tipocomida
                            WHERE nombre LIKE :term");
    $term = "%" . $term . "%";
    $stmt->bindParam(":term", $term);
    if ($stmt->execute()) {
        $array = array();
        $rows = $stmt->fetchAll();
        $i = 0;
        foreach ($rows as $row) {
            $aux = array();
            $aux['id'] = utf8_encode($row['idTipoComida']);
            $aux['label'] = utf8_encode($row['nombre']);
            $aux['value'] = utf8_encode($row['nombre']);
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