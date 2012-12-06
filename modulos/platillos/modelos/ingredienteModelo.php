<?php

/**
 * Description of ingredienteModelo
 *
 * @author neto
 */
require_once 'bd/conx.php';

function altaIngrediente($ingrediente) {
    global $conex;
    $stmt = $conex->prepare("INSERT into ingrediente (idGrupoIngredientes, nombre, precio) 
                            values (:idGrupoIngredientes,:nombre,:precio)");
    $stmt->bindParam(':idGrupoIngredientes', $ingrediente->idGrupoIngredientes);
    $stmt->bindParam(':nombre', $ingrediente->nombre);
    $stmt->bindParam(':precio', $ingrediente->precio);
    $id = -1;
    if ($stmt->execute()) {
        $id = $conex->lastInsertId();
    }
    else
        print_r($stmt->errorInfo());
    return $id;
}

function bajaIngrediente($idIngrediente) {
    global $conex;
    $stmt = $conex->prepare("DELETE FROM ingrediente WHERE idIngrediente = :id");
    $stmt->bindParam(':id', $idIngrediente);
    $stmt->execute();
    return $stmt->rowCount();
}

function modificaIngrediente($ingrediente) {
    global $conex;
    $stmt = $conex->prepare("UPDATE ingrediente 
                            SET nombre=:nombre, precio=:precio
                            WHERE idIngrediente=:idIngrediente");
    $stmt->bindParam(':nombre', $ingrediente->nombre);
    $stmt->bindParam(':precio', $ingrediente->precio);
    $stmt->bindParam(':idIngrediente', $ingrediente->idIngrediente);

    if ($stmt->execute()) {
        return true;
    } else {
        print_r($stmt->errorInfo());
        return false;
    }
}

function getIngrediente($idIngrediente) {
    global $conex;
    $stmt = $conex->prepare("SELECT *
                            FROM ingrediente
                            WHERE idIngrediente = :id");
    $stmt->bindParam(':id', $idIngrediente);
    if ($stmt->execute()) {
        $row = $stmt->fetch();
        require_once 'modulos/platillos/clases/Ingrediente.php';
        $ingrediente = new Ingrediente();
        $ingrediente->idIngrediente = $row['idIngrediente'];
        $ingrediente->idGrupoIngredientes = $row['idGrupoIngredientes'];
        $ingrediente->nombre = $row['nombre'];
        $ingrediente->precio = $row['precio'];        
        return $ingrediente;
    } else {
        print_r($stmt->errorInfo());
        return NULL;
    }
}

function getIngredientesDeGrupo($idGrupoIngredientes) {
    global $conex;
    $stmt = $conex->prepare("SELECT i.idIngrediente, i.idGrupoIngredientes, i.nombre, i.precio
                            FROM grupoingredientes gi, ingrediente i
                            WHERE gi.idGrupoIngredientes = i.idGrupoIngredientes AND gi.idGrupoIngredientes = :id 
                            ORDER BY i.idIngrediente ASC");
    $stmt->bindParam(':id', $idGrupoIngredientes);
    if ($stmt->execute()) {
        $ingredientes = array();
        $rows = $stmt->fetchAll();
        require_once 'modulos/platillos/clases/Ingrediente.php';
        $i = 0;
        foreach ($rows as $row) {
            $ingrediente = new Ingrediente();
            $ingrediente->idIngrediente = $row['idIngrediente'];
            $ingrediente->idGrupoIngredientes = $row['idGrupoIngredientes'];
            $ingrediente->nombre = $row['nombre'];
            $ingrediente->precio = $row['precio'];
            $ingredientes[$i] = $ingrediente;
            $i++;
        }
        return $ingredientes;
    } else {
        print_r($stmt->errorInfo());
        return NULL;
    }
}

function getIdGrupoIngredientesDeIngrediente($idIngrediente){
    global $conex;
    $stmt = $conex->prepare("SELECT idGrupoIngredientes 
                            FROM ingrediente 
                            WHERE idIngrediente = :id");
    $stmt->bindParam(':id', $idIngrediente);
    if ($stmt->execute()) {
        $row = $stmt->fetch();
        $id = $row['idGrupoIngredientes'];
        return $id;
    }else{
        print_r($stmt->errorInfo());
        return NULL;
    }
}

?>