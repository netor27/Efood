<?php
require_once 'bd/conx.php';

function getCategoria($idCategoria){
    global $conex;
    $stmt = $conex->prepare("SELECT * FROM categoria
                            WHERE idCategoria = :idCategoria");
    $stmt->bindParam(":idCategoria", $idCategoria);
    require_once 'modulos/platillos/clases/Categoria.php';
    $categoria = new Categoria();
    if ($stmt->execute()) {
        $row = $stmt->fetch();
        $categoria->idCategoria = $row['idCategoria'];
        $categoria->nombre = $row['nombre'];
    }
    return $categoria;
}

function busquedaCategoriasUTF8($term) {
    global $conex;
    $stmt = $conex->prepare("SELECT * FROM categoria
                            WHERE nombre LIKE :term");
    $term = "%" . $term . "%";
    $stmt->bindParam(":term", $term);
    if ($stmt->execute()) {
        $array = array();
        $rows = $stmt->fetchAll();
        $i = 0;
        foreach ($rows as $row) {
            $aux = array();
            $aux['id'] = utf8_encode($row['idCategoria']);
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