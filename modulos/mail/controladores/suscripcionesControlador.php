<?php

function confirmacion(){
    $clave="";
    if(isset($_GET['conf'])){
        $clave = $_GET['conf'];
    }
    require_once 'modulos/mail/modelos/mailModelo.php';
    $res = confirmarContacto($clave);
    if($res){
        $mensaje = '<p>Tu cuenta ha sido confirmada</p><br><p>¡Gracias!</p><br><a href="index.php">Click para regresar</a>';
    }else{
        $mensaje = '<p>Ocurrió un error al confirmar tu cuenta, inténtalo más tarde.</p><a href="index.php">Click para regresar</a>';
    }
    echo $mensaje;
}