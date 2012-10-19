<?php

require_once('bd/bd.php');
try {
    $host = 'localhost';
    $base = 'dbefood';
    $usuario = 'root';
    $pswd = '';

//    $host = 'localhost';
//    $base = 'efoodc5_dbefood';
//    $usuario = 'efoodc5_comida';
//    $pswd = 'Chef2012!';


    global $conex;
    $conex = new Configpdo('mysql', $host, $base, $usuario, $pswd);
} catch (PDOException $e) {
    echo "ocurrió un error con la base de datos";
}
?>
