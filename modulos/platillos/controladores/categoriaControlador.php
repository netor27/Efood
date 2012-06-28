<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function principal(){
    
    $idCategoria = $_GET['i'];
    require_once 'modulos/platillos/modelos/CategoriaModelo.php';
    $categoria = getCategoria($idCategoria);
    echo 'Categor&iacute;a:<br>';
    print_r($categoria);
    echo '<br><a href="restaurantes.php">Regresar</a>';
}

function categoriasJSON(){
    //utf8_encode($data);
    $term = $_GET['term'];    
    require_once 'modulos/platillos/modelos/CategoriaModelo.php';
    $categorias = busquedaCategoriasUTF8($term);  
    
    echo json_encode($categorias);
    
}
?>