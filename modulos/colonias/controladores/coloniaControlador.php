<?php

/**
 * Description of coloniaControlador
 *
 * @author neto
 */

function principal(){
    $idColonia = $_GET['i'];
    require_once 'modulos/colonias/modelos/ColoniaModelo.php';
    $colonia = getColonia($idColonia);
    require_once 'modulos/colonias/vistas/mostrarColonia.php';
}

function coloniasJSON(){
    //utf8_encode($data);
    $term = $_GET['term'];    
    require_once 'modulos/colonias/modelos/ColoniaModelo.php';
    $colonias = busquedaColoniasUTF8($term);  
    
    echo json_encode($colonias);
    
}
?>
