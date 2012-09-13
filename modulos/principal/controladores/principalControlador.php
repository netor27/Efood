<?php

function principal() {
    require_once 'modulos/colonias/modelos/ColoniaModelo.php';
    $colonias = getColonias();    
    require_once 'modulos/tipoComida/modelos/tipoComidaModelo.php';
    $tiposComida = getTiposComida();
    require_once('modulos/principal/vistas/principal.php');
}

?>