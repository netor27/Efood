<?php

function principal() {
    require_once 'modulos/colonias/modelos/ColoniaModelo.php';
    $colonias = getColonias();
    require_once 'modulos/colonias/clases/Colonia.php';
    $colonia = new Colonia();
    require_once('modulos/principal/vistas/principal.php');
}

?>