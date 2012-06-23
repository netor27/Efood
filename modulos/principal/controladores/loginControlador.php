<?php

function principal() {
    $msgLogin = "";
    $pagina = "index.php";
    require_once 'modulos/principal/vistas/login.php';
}

function login() {
    require_once 'modulos/principal/modelos/login.php';

    //$pagina = $_POST['pagina'];
    if (isset($_POST['usuario']) && isset($_POST['password'])) {
        $usuario = $_POST['usuario'];
        $password = md5($_POST['password']);
        $num = getLogin($usuario, $password);
        if ($num == 0) { //no hay usuario correcto
            $msgLogin = "Nombre de usuario y/o contraseña incorrectos.<br>";
            require_once 'modulos/usuarios/modelos/usuarioModelo.php';
            $usuarios = getUsuarios();
            require_once 'modulos/usuarios/vistas/mostrarUsuarios.html';
            require_once 'modulos/principal/vistas/login.html';
        } else {
            require_once 'modulos/usuarios/modelos/usuarioModelo.php';
            $usuarios = getUsuarios();
            if (isset($_POST['recuerdame']) && $_POST['recuerdame']==1) { //Guardamos la cookie para recordar
                $tiempo = 3600; //tiempo que va a durar la cookie
                $clv = $password;
                setcookie("email", $usuario, time() + $tiempo);
                setcookie("clv", $clv, time() + $tiempo);
            }
            require_once 'modulos/usuarios/vistas/mostrarUsuarios.html';
            require_once 'modulos/principal/vistas/login.html';
        }
    }
}

function logout() {
    require_once 'modulos/principal/modelos/login.php';
    salir();
    require_once('funcionesPHP/funcionesGenerales.php');
    goToIndex();
}

?>
