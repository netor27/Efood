<?php

function principal() {
    goToIndex();
}

function login() {
    require_once 'modulos/principal/modelos/login.php';

    if(isset($_POST['pagina']))
        $pagina = $_POST['pagina'];
    else
        $pagina = "/";
    
    if (isset($_POST['usuario']) && isset($_POST['password'])) {
        $usuario = $_POST['usuario'];
        $password = md5($_POST['password']);
        $num = getLogin($usuario, $password);
        if ($num == 0) { //no hay usuario correcto
            setSessionMessage("<h4 class='error'>Nombre de usuario y/o contraseña incorrectos</h4>");
        } else {
            require_once 'modulos/usuarios/modelos/usuarioModelo.php';
            $usuarios = getUsuarios();
            if (isset($_POST['recuerdame']) && $_POST['recuerdame']==1) { //Guardamos la cookie para recordar
                $tiempo = 2592000; //tiempo que va a durar la cookie, 30 días
                $clv = $password;
                setcookie("email", $usuario, time() + $tiempo);
                setcookie("clv", $clv, time() + $tiempo);
            }
        }        
    }
    redirect($pagina);
}

function logout() {
    require_once 'modulos/principal/modelos/login.php';
    salir();
    require_once('funcionesPHP/funcionesGenerales.php');
    goToIndex();
}

?>