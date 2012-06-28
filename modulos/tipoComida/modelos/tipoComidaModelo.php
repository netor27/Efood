<?php

/**
 * Description of tipoComidaModelo
 *
 * @author neto
 */
require_once 'bd/conx.php';

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
            $tipoComida->nombre = utf8_encode($row['nombre']);            
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