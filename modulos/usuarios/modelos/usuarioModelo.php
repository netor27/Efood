<?php

require_once 'bd/conx.php';
require_once 'modulos/usuarios/clases/Usuario.php';

function crearUsuario($user) {
    global $conex;
    $stmt = $conex->prepare("INSERT into usuario (email,password,tipo,habilitado) values (:email,:password,:tipo,:habilitado)");
    $stmt->bindParam(':email', $user->email);
    $stmt->bindParam(':password', $user->password);
    $stmt->bindParam(':tipo', $user->tipo);
    $stmt->bindParam(':habilitado', $user->habilitado);
    $id = -1;
    $val = $stmt->execute();
    if ($val)
        $id = $conex->lastInsertId();
    return $id;
}

function eliminarUsuario($idUsuario) {
    global $conex;
    $stmt = $conex->prepare("DELETE FROM usuario WHERE idUsuario = :id");
    $stmt->bindParam(':id', $idUsuario);
    $stmt->execute();
    return $stmt->rowCount();
}

function modificarUsuario($user) {
    global $conex;
    $stmt = $conex->prepare("UPDATE usuario SET telefono=:telefono WHERE idUsuario=:idUsuario");
    $stmt->bindParam(':idUsuario', $user->idUsuario);
    //$stmt->bindParam(':password',$user->password);
    $stmt->bindParam(':telefono', $user->telefono);
    //$stmt->bindParam(':tipo',$user->tipo);
    $id = -1;
    $val = $stmt->execute();
    if ($val)
        $id = $user->idUsuario;
    return $id;
}

function getUsuarios() {
    global $conex;
    $stmt = $conex->query("SELECT idUsuario,email,telefono,tipo,habilitado FROM usuario");
    if ($stmt->execute()) {
        $usuarios = array();
        $rows = $stmt->fetchAll();
        require_once 'modulos/usuarios/clases/Usuario.php';
        $i = 0;
        foreach ($rows as $row) {
            $user = new Usuario();
            $user->idUsuario = $row['idUsuario'];
            $user->email = $row['email'];
            $user->telefono = $row['telefono'];
            $user->tipo = $row['tipo'];
            $user->habilitado = $row['habilitado'];
            $usuarios[$i] = $user;
            $i++;
        }
        return $usuarios;
    } else {
        print_r($stmt->errorInfo());
        return NULL;
    }
}

function getUsuario($idUsuario) {
    global $conex;
    $stmt = $conex->prepare("SELECT idUsuario,email,telefono,tipo,habilitado FROM usuario WHERE idUsuario = :id");
    $stmt->bindParam(':id', $idUsuario);
    if ($stmt->execute()) {
        $row = $stmt->fetch();
        $user = new Usuario();
        $user->idUsuario = $row['idUsuario'];
        $user->email = $row['email'];
        $user->telefono = $row['telefono'];
        $user->tipo = $row['tipo'];
        $user->habilitado = $row['habilitado'];
        return $user;
    } else {
        return NULL;
    }
}

function getDirecciones($idUsuario) {
    global $conex;
    $stmt = $conex->prepare("SELECT idDireccion,idColonia,calle,numero,numeroInt,referencia FROM direccion WHERE idUsuario=:idUsuario");
    $stmt->bindParam(':idUsuario', $idUsuario);
    if ($stmt->execute()) {
        $direcciones = array();
        $rows = $stmt->fetchAll();
        require_once 'modulos/usuarios/clases/Direccion.php';
        $i = 0;
        foreach ($rows as $row) {
            $direccion = new Direccion();
            $direccion->idDireccion = $row['idDireccion'];
            $direccion->idColonia = $row['idColonia'];
            $direccion->calle = $row['calle'];
            $direccion->numero = $row['numero'];
            $direccion->numeroInt = $row['numeroInt'];
            $direccion->referencia = $row['referencia'];
            $direcciones[$i] = $direccion;
            $i++;
        }
        return $direcciones;
    } else {
        print_r($stmt->errorInfo());
        return NULL;
    }
}

function getDireccion($idDireccion) {
    global $conex;
    $stmt = $conex->prepare("SELECT idDireccion,idColonia,calle,numero,numeroInt,referencia FROM direccion WHERE idDireccion=:idDireccion");
    $stmt->bindParam(':idDireccion', $idDireccion);
    if ($stmt->execute()) {
        $row = $stmt->fetch();
        $direccion = new Direccion();
        $direccion->idDireccion = $row['idDireccion'];
        $direccion->idColonia = $row['idColonia'];
        $direccion->calle = $row['calle'];
        $direccion->numero = $row['numero'];
        $direccion->numeroInt = $row['numeroInt'];
        $direccion->referencia = $row['referencia'];
        return $direccion;
    } else {
        print_r($stmt->errorInfo());
        return NULL;
    }
}

function crearDireccion($direccion) {
    global $conex;
    $stmt = $conex->prepare("INSERT into direccion (idUsuario,idColonia,calle,numero,numeroInt,referencia) values (:idUsuario,:idColonia,:calle,:numero,:numeroInt,:referencia)");
    $stmt->bindParam(':idUsuario', $direccion->idUsuario);
    $stmt->bindParam(':idColonia', $direccion->idColonia);
    $stmt->bindParam(':calle', $direccion->calle);
    $stmt->bindParam(':numero', $direccion->numero);
    $stmt->bindParam(':numeroInt', $direccion->numeroInt);
    $stmt->bindParam(':referencia', $direccion->referencia);
    $id = -1;
    $val = $stmt->execute();
    if ($val)
        $id = $conex->lastInsertId();
    return $id;
}

function modificarDireccion($direccion) {
    global $conex;
    $stmt = $conex->prepare("UPDATE direccion SET idColonia=:idColonia, calle=:calle, numero=:numero, numeroInt=:numeroInt, referencia=:referencia WHERE idDireccion=:idDireccion");
    $stmt->bindParam(':idDireccion', $direccion->idDireccion);
    $stmt->bindParam(':idColonia', $direccion->idColonia);
    $stmt->bindParam(':calle', $direccion->calle);
    $stmt->bindParam(':numero', $direccion->numero);
    $stmt->bindParam(':numeroInt', $direccion->numeroInt);
    $stmt->bindParam(':referencia', $direccion->referencia);
    $id = -1;
    $val = $stmt->execute();
    if ($val)
        $id = $direccion->idDireccion;
    return $id;
}

function eliminarDireccion($idDireccion) {
    global $conex;
    $stmt = $conex->prepare("DELETE FROM direccion WHERE idDireccion = :id");
    $stmt->bindParam(':id', $idDireccion);
    $stmt->execute();
    return $stmt->rowCount();
}

function getUsuarioFromEmail($email){
    global $conex;
    $stmt = $conex->prepare("SELECT idUsuario,email,password,telefono,tipo,habilitado FROM usuario WHERE email = :email");
    $stmt->bindParam(':email', $email);
    if ($stmt->execute()) {
        $row = $stmt->fetch();
        $user = new Usuario();
        $user->idUsuario = $row['idUsuario'];
        $user->email = $row['email'];
        $user->password = $row['password'];
        $user->telefono = $row['telefono'];
        $user->tipo = $row['tipo'];
        $user->habilitado = $row['habilitado'];
        return $user;
    } else {
        return NULL;
    }
}
?>