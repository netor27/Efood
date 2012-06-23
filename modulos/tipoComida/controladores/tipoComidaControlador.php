<?php

/**
 * Description of tipoComidaControlador
 *
 * @author neto
 * 
 */

function tiposComidaJSON(){
    //utf8_encode($data);
    $term = $_GET['term'];    
    require_once 'modulos/tipoComida/modelos/tipoComidaModelo.php';
    $tiposComida = busquedaTiposComidaUTF8($term);  
    
    echo json_encode($tiposComida);
    
}
?>
