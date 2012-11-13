<?php

function principal() {
    if(validarAdministrador()){
        require_once 'modulos/principal/vistas/administracion.php';
    }else{
        goToIndex();
    }
}

?>
