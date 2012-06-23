<?php

/**
 * Description of grupoIngredientesModelo
 *
 * @author neto
 */
require_once 'bd/conx.php';

function altaGrupoIngredientes($grupoIngredientes) {
    global $conex;
    $stmt = $conex->prepare("INSERT into grupoingredientes (idPlatillo, nombre, excluyente, requerido, idGrupoDepende, idIngredienteDepende) 
                            values (:idPlatillo,:nombre,:excluyente,:requerido,:idGrupoDepende,:idIngredienteDepende)");
    $stmt->bindParam(':idPlatillo', $grupoIngredientes->idPlatillo);
    $stmt->bindParam(':nombre', $grupoIngredientes->nombre);
    $stmt->bindParam(':excluyente', $grupoIngredientes->excluyente);
    $stmt->bindParam(':requerido', $grupoIngredientes->requerido);
    $stmt->bindParam(':idGrupoDepende', $grupoIngredientes->idGrupoDepende);
    $stmt->bindParam(':idIngredienteDepende', $grupoIngredientes->idIngredienteDepende);
    $id = -1;
    if ($stmt->execute()) {
        $id = $conex->lastInsertId();
    }
    else
        print_r($stmt->errorInfo());
    return $id;
}

function bajaGrupoIngredientes($idGrupoIngredientes) {
    global $conex;
    $stmt = $conex->prepare("DELETE FROM grupoingredientes WHERE idGrupoIngredientes = :id");
    $stmt->bindParam(':id', $idGrupoIngredientes);
    $stmt->execute();
    return $stmt->rowCount();
}

function modificaGrupoIngredientes($grupoIngredientes) {
    global $conex;
    $stmt = $conex->prepare("UPDATE grupoingredientes 
                            SET nombre=:nombre, excluyente=:excluyente, requerido=:requerido, 
                            idGrupoDepende=:idGrupoDepende, idIngredienteDepende=:idIngredienteDepende
                            WHERE idGrupoIngredientes=:idGrupoIngredientes");
    $stmt->bindParam(':nombre', $grupoIngredientes->nombre);
    $stmt->bindParam(':excluyente', $grupoIngredientes->excluyente);
    $stmt->bindParam(':requerido', $grupoIngredientes->requerido);
    $stmt->bindParam(':idGrupoDepende', $grupoIngredientes->idGrupoDepende);
    $stmt->bindParam(':idGrupoIngredientes', $grupoIngredientes->idGrupoIngredientes);
    $stmt->bindParam(':idIngredienteDepende', $grupoIngredientes->idIngredienteDepende);

    if ($stmt->execute()) {
        return true;
    } else {
        print_r($stmt->errorInfo());
        return false;
    }
}

function getGruposIngredientesDePlatillo($idPlatillo) {
    global $conex;
    $stmt = $conex->prepare("SELECT gi.idGrupoIngredientes, gi.idPlatillo, gi.nombre, gi.excluyente, gi.requerido, gi.idGrupoDepende, gi.idIngredienteDepende
                            FROM grupoingredientes gi, platillo p
                            WHERE gi.idPlatillo = p.idPlatillo AND p.idPlatillo = :id order by gi.idGrupoIngredientes desc");
    $stmt->bindParam(':id', $idPlatillo);
    if ($stmt->execute()) {
        $gruposIngredientes = array();
        $rows = $stmt->fetchAll();
        require_once 'modulos/platillos/clases/GrupoIngredientes.php';
        $i = 0;
        foreach ($rows as $row) {
            $grupoIngredientes = new GrupoIngredientes();
            $grupoIngredientes->idGrupoIngredientes = $row['idGrupoIngredientes'];
            $grupoIngredientes->idPlatillo = $row['idPlatillo'];
            $grupoIngredientes->nombre = $row['nombre'];
            $grupoIngredientes->excluyente = $row['excluyente'];
            $grupoIngredientes->requerido = $row['requerido'];
            $grupoIngredientes->idGrupoDepende = $row['idGrupoDepende'];
            $grupoIngredientes->idIngredienteDepende = $row['idIngredienteDepende'];
            $gruposIngredientes[$i] = $grupoIngredientes;
            $i++;
        }
        return $gruposIngredientes;
    } else {
        print_r($stmt->errorInfo());
        return NULL;
    }
}

function getGrupoIngredientes($idGrupoIngredientes){
    global $conex;
    $stmt = $conex->prepare("SELECT * 
                            FROM grupoingredientes 
                            WHERE idGrupoIngredientes = :id order by idGrupoIngredientes desc");
    $stmt->bindParam(':id', $idGrupoIngredientes);
    if ($stmt->execute()) {
        require_once 'modulos/platillos/clases/GrupoIngredientes.php';
        $row = $stmt->fetch();
        $grupoIngredientes = new GrupoIngredientes();
        $grupoIngredientes->excluyente = $row['excluyente'];
        $grupoIngredientes->idGrupoDepende = $row['idGrupoDepende'];
        $grupoIngredientes->idGrupoIngredientes = $row['idGrupoIngredientes'];
        $grupoIngredientes->idPlatillo = $row['idPlatillo'];
        $grupoIngredientes->requerido = $row['requerido'];
        $grupoIngredientes->nombre = $row['nombre'];
        $grupoIngredientes->idIngredienteDepende = $row['idIngredienteDepende'];
        return $grupoIngredientes;
    }else{
        print_r($stmt->errorInfo());
        return NULL;
    }
}

function getIdPlatilloDeGrupoIngredientes($idGrupoIngredientes){
    global $conex;
    $stmt = $conex->prepare("SELECT idPlatillo 
                            FROM grupoingredientes 
                            WHERE idGrupoIngredientes = :id");
    $stmt->bindParam(':id', $idGrupoIngredientes);
    if ($stmt->execute()) {
        $row = $stmt->fetch();
        $id = $row['idPlatillo'];
        return $id;
    }else{
        print_r($stmt->errorInfo());
        return NULL;
    }
}

?>
