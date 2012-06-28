<?php

function alta() {
    require_once 'modulos/usuarios/vistas/registro.html';
}

function altaSubmit() {
    require_once 'modulos/usuarios/clases/Usuario.php';

    $user = new Usuario();
    $codigo = rand(0000000000, 9999999999);
    $user->email = $_POST['email'];
    $user->password = md5($_POST['password']);
    $user->tipo = '1';
    $user->habilitado = md5($_POST['email']) . $codigo;
    $passwordConfirmation = md5($_POST['passwordr']);
    //$user->tipo = $_POST['tipo']; ??????????el tipo como se va a manejar, por admin?

    if ($user->password == $passwordConfirmation) {
        require_once 'modulos/usuarios/modelos/usuarioModelo.php';
        $user->idUsuario = crearUsuario($user);
        require_once 'modulos/mail/modelos/mailModelo.php';
        $res = enviarEmailDeConfirmacion($user->email, $user->habilitado);
        if ($user->idUsuario >= 0 && $res) {
            $mensaje = 'Usuario Registrado';
        } else {
            $mensaje = 'Hubo un error durante el registro';
            if ($user->idUsuario >= 0) {
                eliminarUsuario($user->idUsuario);
            }
        }
    } else {
        $mensaje = 'Los passwords no coinciden';
    }
    echo $mensaje;
    echo '<br><a href="usuarios.php">Regresar</a>';
}

function baja() {
    require_once 'modulos/usuarios/modelos/usuarioModelo.php';
    confirmBoxBaja();
    $usuarios = getUsuarios();
    $idUsuario = $_GET['i'];

    $id = eliminarUsuario($idUsuario);
    if ($id >= 1) {
        $mensaje = 'Usuario Eliminado';
    } else {
        $mensaje = 'Hubo un error al eliminar el usuario';
    }
    require_once('funcionesPHP/funcionesGenerales.php');
    goToIndex();
}

function modificacion() {
    require_once 'modulos/colonias/modelos/ColoniaModelo.php';
    $colonias = getColonias();
    require_once 'modulos/colonias/clases/Colonia.php';
    $colonia = new Colonia();

    confirmBoxBaja();
    require_once 'modulos/usuarios/modelos/usuarioModelo.php';
    require_once 'modulos/usuarios/clases/Usuario.php';
    if (isset($_SESSION['idUsuario'])) {
        $user = getUsuario($_SESSION['idUsuario']);
        $direcciones = getDirecciones($_SESSION['idUsuario']);
    } else {
        $mensaje = 'No has iniciado sesión<br><a href="usuarios.php">Regresar</a>';
    }
    require_once 'modulos/usuarios/vistas/edicion.html';
}

function modificacionSubmit() {
    require_once 'modulos/usuarios/modelos/usuarioModelo.php';
    require_once 'modulos/usuarios/clases/Usuario.php';

    $user = new Usuario();
    $user->idUsuario = $_SESSION['idUsuario'];
    $user->telefono = $_POST['tel'];
    //$user->tipo = $_POST['tipo'];

    $id = modificarUsuario($user);
    if ($id >= 0) {
        $mensaje = 'Se modificó correctamente.';
    } else {
        $mensaje = 'Hubo un error durante la modificación.';
    }
    echo $mensaje;
    echo '<br><a href="usuarios.php">Regresar</a>';
}

function agregarDireccionSubmit() {
    require_once 'modulos/usuarios/modelos/usuarioModelo.php';
    require_once 'modulos/usuarios/clases/Direccion.php';

    $direccion = new Direccion();
    $direccion->idUsuario = $_SESSION['idUsuario'];
    $direccion->idColonia = $_POST['idColonia'];
    $direccion->calle = $_POST['calle'];
    $direccion->numero = $_POST['numero'];
    $direccion->numeroInt = $_POST['numeroInt'];
    $direccion->referencia = $_POST['referencia'];

    $id = crearDireccion($direccion);
    if ($id >= 0) {
        $mensaje = 'Se insertó la dirección.';
    } else {
        $mensaje = 'Hubo un error durante la inserción de la dirección.';
    }
    echo $mensaje;
    echo '<br><a href="usuarios.php?a=modificacion">Regresar</a>';
}

function modificacionDireccion() {
    require_once 'modulos/colonias/modelos/ColoniaModelo.php';
    $colonias = getColonias();
    require_once 'modulos/colonias/clases/Colonia.php';

    require_once 'modulos/usuarios/modelos/usuarioModelo.php';
    require_once 'modulos/usuarios/clases/Direccion.php';
    if (isset($_GET['i'])) {
        $direccion = getDireccion($_GET['i']);
        $colonia = getColonia($direccion->idColonia);
    } else {
        $mensaje = 'Error en los datos<br><a href="usuarios.php">Regresar</a>';
    }
    require_once 'modulos/usuarios/vistas/ediciondir.html';
}

function modificacionDireccionSubmit() {
    require_once 'modulos/usuarios/modelos/usuarioModelo.php';
    require_once 'modulos/usuarios/clases/Direccion.php';

    $direccion = new Direccion();
    $direccion->idDireccion = $_POST['idDireccion'];
    $direccion->idColonia = $_POST['idColonia'];
    $direccion->calle = $_POST['calle'];
    $direccion->numero = $_POST['numero'];
    $direccion->numeroInt = $_POST['numeroInt'];
    $direccion->referencia = $_POST['referencia'];

    $id = modificarDireccion($direccion);
    if ($id >= 0) {
        $mensaje = 'Se modificó correctamente.';
    } else {
        $mensaje = 'Hubo un error durante la modificación.';
    }
    echo $mensaje;
    echo '<br><a href="usuarios.php">Regresar</a>';
}

function mostrar() {
    require_once('funcionesPHP/funcionesGenerales.php');
    require_once 'modulos/usuarios/modelos/usuarioModelo.php';
    require_once 'modulos/principal/modelos/login.php';
    confirmBoxBaja();
    $usuarios = getUsuarios();
    require_once 'modulos/usuarios/vistas/mostrarUsuarios.html';
    require_once 'modulos/principal/vistas/login.html';
}

function bajaDireccion() {
    require_once 'modulos/usuarios/modelos/usuarioModelo.php';
    $idDireccion = $_GET['i'];

    $id = eliminarDireccion($idDireccion);
    if ($id >= 1) {
        $mensaje = 'Direccion Eliminada';
    } else {
        $mensaje = 'Hubo un error al eliminar la direccion';
    }
    require_once('funcionesPHP/funcionesGenerales.php');
    goToIndex();
}

?>