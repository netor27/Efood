<?php

require_once('bd/conx.php');

function getLogin($email, $password) {
    global $conex;
    $numeroTuplas = 0;
    $stmt = $conex->prepare("SELECT * FROM usuario WHERE email = :email and password = :pass");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':pass', $password);
    $stmt->execute();

    if ($stmt->rowCount() == 1) {
        $numeroTuplas = 1;
        $row = $stmt->fetch();
        $_SESSION['email'] = $row['email'];
        $_SESSION['idUsuario'] = $row['idUsuario'];
        $_SESSION['tipo'] = $row['tipo'];
        $_SESSION['telefono'] = $row['telefono'];
        $_SESSION['habilitado'] = $row['habilitado'];

        //Si es que hay usuarioRestaurante loggeado lo eliminamos
        $_SESSION['restauranteUsuario'] = null;
    }
    return $numeroTuplas;
}

function salir() {
    $log = false;
    if (isset($_SESSION['email'])) {
        $_SESSION['idUsuario'] = null;
        $_SESSION['tipo'] = null;
        $_SESSION['email'] = null;
        $_SESSION['telefono'] = null;
        $_SESSION['habilitado'] = null;
        session_destroy();
        setcookie("email", "", time() - 3600);
        setcookie("idUsuario", "", time() - 3600);
        setcookie("tipo", "", time() - 3600);
        setcookie("telefono", "", time() - 3600);
        setcookie("habilitado", "", time() - 3600);
        $log = true;
    }
    return $log;
}

?>