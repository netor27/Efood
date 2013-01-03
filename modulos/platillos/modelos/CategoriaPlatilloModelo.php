<?php

require_once 'bd/conx.php';

function altaCategoriaPlatillo($categoriaPlatillo) {
    global $conex;
    $id = -1;
    $stmt = $conex->prepare("INSERT into categoriaplatillo (nombre, descripcion, idRestaurante) 
                            values (:nombre,:descripcion,:idRestaurante)");
    $stmt->bindParam(':nombre', $categoriaPlatillo->nombre);
    $stmt->bindParam(':descripcion', $categoriaPlatillo->descripcion);
    $stmt->bindParam(':idRestaurante', $categoriaPlatillo->idRestaurante);
    if ($stmt->execute()) {
        $id = $conex->lastInsertId();
    } else {
        print_r($stmt->errorInfo());
    }
    return $id;
}

function bajaCategoriaPlatillo($idCategoriaPlatillo) {
    global $conex;
    $stmt = $conex->prepare("DELETE FROM categoriaplatillo WHERE idCategoriaPlatillo = :id");
    $stmt->bindParam(':id', $idCategoriaPlatillo);
    $stmt->execute();
    return $stmt->rowCount();
}

function modificaCategoriaPlatillo($categoriaPlatillo) {
    global $conex;
    $stmt = $conex->prepare("UPDATE categoriaplatillo 
                            SET nombre=:nombre, descripcion=:descripcion
                            WHERE idCategoriaPlatillo=:idCategoriaPlatillo");
    $stmt->bindParam(':nombre', $categoriaPlatillo->nombre);
    $stmt->bindParam(':descripcion', $categoriaPlatillo->descripcion);
    $stmt->bindParam(':idCategoriaPlatillo', $categoriaPlatillo->idCategoriaPlatillo);

    if ($stmt->execute()) {
        return true;
    } else {
        print_r($stmt->errorInfo());
        return false;
    }
}

function modificaOrdenCategoriaPlatillo($idCategoriaPlatillo, $orden){
    global $conex;
    $stmt = $conex->prepare("UPDATE categoriaplatillo 
                            SET orden=:orden
                            WHERE idCategoriaPlatillo=:idCategoriaPlatillo");
    $stmt->bindParam(':orden', $orden);
    $stmt->bindParam(':idCategoriaPlatillo', $idCategoriaPlatillo);
    if ($stmt->execute()) {
        return true;
    } else {
        print_r($stmt->errorInfo());
        return false;
    }
}

function getCategoriaPlatillo($idCategoriaPlatillo) {
    global $conex;
    $stmt = $conex->prepare("SELECT *
                            FROM categoriaplatillo
                            WHERE idCategoriaPlatillo = :id");
    $stmt->bindParam(':id', $idCategoriaPlatillo);
    if ($stmt->execute()) {
        $row = $stmt->fetch();
        require_once 'modulos/platillos/clases/CategoriaPlatillo.php';
        $categoriaPlatillo = new CategoriaPlatillo();
        $categoriaPlatillo->idCategoriaPlatillo = $row['idCategoriaPlatillo'];
        $categoriaPlatillo->nombre = $row['nombre'];
        $categoriaPlatillo->descripcion = $row['descripcion'];
        $categoriaPlatillo->idRestaurante = $row['idRestaurante'];
        $categoriaPlatillo->orden = $row['orden'];
        return $categoriaPlatillo;
    } else {
        print_r($stmt->errorInfo());
        return NULL;
    }
}

function getCategoriasDeRestaurante($idRestaurante) {
    global $conex;
    $stmt = $conex->prepare("SELECT *  
                             FROM categoriaplatillo
                             WHERE idRestaurante = :id
                             ORDER BY orden");
    $stmt->bindParam(":id", $idRestaurante);
    if($stmt->execute()){
        $categorias = array();
        $rows = $stmt->fetchAll();
        require_once 'modulos/platillos/clases/CategoriaPlatillo.php';
        $i = 0;
        foreach ($rows as $row) {
            $categoria = new CategoriaPlatillo();
            $categoria->idCategoriaPlatillo = $row['idCategoriaPlatillo'];
            $categoria->nombre = $row['nombre'];
            $categoria->descripcion = $row['descripcion'];
            $categoria->idRestaurante = $row['idRestaurante'];
            $categoria->orden = $row['orden'];
            $categorias[$i] = $categoria;
            $i++;
        }
        return $categorias;
    }
}

?>
