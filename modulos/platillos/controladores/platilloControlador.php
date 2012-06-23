<?php

function alta() {
    $idRestaurante = $_GET['r'];
    $tipo = "alta";
    require_once 'modulos/platillos/clases/Platillo.php';
    $platillo = new Platillo();
    require_once 'modulos/platillos/vistas/formaPlatillo.php';
}

function formaPlatilloSubmit() {
    $tipo = $_GET['t'];
    require_once 'modulos/platillos/clases/Platillo.php';
    $platillo = new Platillo();
    $idRestaurante = $_POST['idRestaurante'];
    $platillo->idRestaurante = $idRestaurante;
    $platillo->nombre = $_POST['nombre'];
    $platillo->descripcion = $_POST['descripcion'];
    $platillo->idCategoria = $_POST['idCategoria'];
    $platillo->precioBase = $_POST['precioBase'];
    $platillo->hint = $_POST['hint'];

    require_once 'modulos/platillos/modelos/platilloModelo.php';
    if ($tipo == "alta") {
        $platillo->idPlatillo = altaPlatillo($platillo);
        if ($platillo->idPlatillo >= 0) {
            require_once 'modulos/restaurantes/modelos/RestauranteModelo.php';
            $horario = getHorario($idRestaurante);
            actualizaHorarioPlatillo($platillo->idPlatillo, $horario);
            setSessionMessage('Se dió de alta el platillo ' . $platillo->nombre);
        } else {
            $tipo = "alta";
            $error = "Ocurrió un error al dar de alta el platillo";
            require_once 'modulos/platillos/vistas/formaPlatillo.php';
        }
    } else if ($tipo == "editar") {
        $platillo->idPlatillo = $_POST['idPlatillo'];
        if (modificaPlatillo($platillo)) {
            setSessionMessage('Se modificó el platillo.' . $platillo->nombre);
        } else {
            $tipo = "editar";
            $error = "Ocurrió un error al modificar el platillo";
            require_once 'modulos/platillos/vistas/formaPlatillo.php';
        }
    }
    redirect("restaurantes.php?a=menu&i=".$idRestaurante);
}

function borrar() {
    $idPlatillo = $_GET['i'];
    require_once 'modulos/platillos/modelos/platilloModelo.php';
    $idRestaurante = getIdRestauranteDePlatillo($idPlatillo);
    if (bajaPlatillo($idPlatillo)) {
        setSessionMessage("Se borró correctamente");
    } else {
        setSessionMessage("Ocurrió un error al borrar");
    }
    redirect("restaurantes.php?a=menu&i=".$idRestaurante);
}

function modificar() {
    $tipo = "editar";
    $idPlatillo = $_GET['i'];
    require_once 'modulos/platillos/modelos/platilloModelo.php';
    $idRestaurante = getIdRestauranteDePlatillo($idPlatillo);
    require_once 'modulos/platillos/clases/Platillo.php';
    $platillo = getPlatillo($idPlatillo);
    require_once 'modulos/platillos/vistas/formaPlatillo.php';
}

function horario() {
    $idPlatillo = $_GET['i'];
    require_once 'modulos/platillos/modelos/platilloModelo.php';
    $platillo = getPlatillo($idPlatillo);
    $horario = getHorarioPlatillo($idPlatillo);
    $platillos = getPlatillosDeRestaurante($platillo->idRestaurante);
    require_once 'modulos/platillos/vistas/horario.php';
}

function actualizarHorario() {
    require_once 'modulos/platillos/modelos/platilloModelo.php';
    $idPlatillo = $_POST['idPlatillo'];
    $platillo = getPlatillo($idPlatillo);
    $platillos = getPlatillosDeRestaurante($platillo->idRestaurante);
    require_once 'modulos/restaurantes/clases/Horario.php';
    $horario = getHorarioPlatillo($idPlatillo);

    if (isset($_POST['LU'])) {
        switch ($_POST['horario']) {
            case 0:
                $horario->luIni = $_POST['iniH'] . ':' . $_POST['iniM'] . ':00';
                $horario->luFin = $_POST['finH'] . ':' . $_POST['finM'] . ':00';
                break;
            case 1:
                $horario->luIni = '00:00:00';
                $horario->luFin = '23:59:00';
                break;
            case 2:
                $horario->luIni = '00:00:00';
                $horario->luFin = '00:00:00';
                break;
        }
    }
    if (isset($_POST['MA'])) {
        switch ($_POST['horario']) {
            case 0:
                $horario->maIni = $_POST['iniH'] . ':' . $_POST['iniM'] . ':00';
                $horario->maFin = $_POST['finH'] . ':' . $_POST['finM'] . ':00';
                break;
            case 1:
                $horario->maIni = '00:00:00';
                $horario->maFin = '23:59:00';
                break;
            case 2:
                $horario->maIni = '00:00:00';
                $horario->maFin = '00:00:00';
                break;
        }
    }
    if (isset($_POST['MI'])) {
        switch ($_POST['horario']) {
            case 0:
                $horario->miIni = $_POST['iniH'] . ':' . $_POST['iniM'] . ':00';
                $horario->miFin = $_POST['finH'] . ':' . $_POST['finM'] . ':00';
                break;
            case 1:
                $horario->miIni = '00:00:00';
                $horario->miFin = '23:59:00';
                break;
            case 2:
                $horario->miIni = '00:00:00';
                $horario->miFin = '00:00:00';
                break;
        }
    }
    if (isset($_POST['JU'])) {
        switch ($_POST['horario']) {
            case 0:
                $horario->juIni = $_POST['iniH'] . ':' . $_POST['iniM'] . ':00';
                $horario->juFin = $_POST['finH'] . ':' . $_POST['finM'] . ':00';
                break;
            case 1:
                $horario->juIni = '00:00:00';
                $horario->juFin = '23:59:00';
                break;
            case 2:
                $horario->juIni = '00:00:00';
                $horario->juFin = '00:00:00';
                break;
        }
    }
    if (isset($_POST['VI'])) {
        switch ($_POST['horario']) {
            case 0:
                $horario->viIni = $_POST['iniH'] . ':' . $_POST['iniM'] . ':00';
                $horario->viFin = $_POST['finH'] . ':' . $_POST['finM'] . ':00';
                break;
            case 1:
                $horario->viIni = '00:00:00';
                $horario->viFin = '23:59:00';
                break;
            case 2:
                $horario->viIni = '00:00:00';
                $horario->viFin = '00:00:00';
                break;
        }
    }
    if (isset($_POST['SA'])) {
        switch ($_POST['horario']) {
            case 0:
                $horario->saIni = $_POST['iniH'] . ':' . $_POST['iniM'] . ':00';
                $horario->saFin = $_POST['finH'] . ':' . $_POST['finM'] . ':00';
                break;
            case 1:
                $horario->saIni = '00:00:00';
                $horario->saFin = '23:59:00';
                break;
            case 2:
                $horario->saIni = '00:00:00';
                $horario->saFin = '00:00:00';
                break;
        }
    }
    if (isset($_POST['DO'])) {
        switch ($_POST['horario']) {
            case 0:
                $horario->doIni = $_POST['iniH'] . ':' . $_POST['iniM'] . ':00';
                $horario->doFin = $_POST['finH'] . ':' . $_POST['finM'] . ':00';
                break;
            case 1:
                $horario->doIni = '00:00:00';
                $horario->doFin = '23:59:00';
                break;
            case 2:
                $horario->doIni = '00:00:00';
                $horario->doFin = '00:00:00';
                break;
        }
    }


    if (actualizaHorarioPlatillo($idPlatillo, $horario)) {
        $error = "Se actualizó correctamente el horario";
    } else {
        $horario = getHorario($idPlatillo);
        $error = "Ocurrió un error al actualizar el horario";
    }

    require_once 'modulos/platillos/vistas/horario.php';
}

function copiarHorario() {
    require_once 'modulos/platillos/modelos/platilloModelo.php';
    $idPlatillo = $_POST['idPlatillo'];
    $platillo = getPlatillo($idPlatillo);
    $platillos = getPlatillosDeRestaurante($platillo->idRestaurante);
    $idPlatilloACopiar = $_POST['platilloPorCopiar'];
    $horario = getHorarioPlatillo($idPlatilloACopiar);
    if (actualizaHorarioPlatillo($idPlatillo, $horario)) {
        $error = "Se actualizó correctamente el horario";
    } else {
        $horario = getHorario($idPlatillo);
        $error = "Ocurrió un error al actualizar el horario";
    }
    require_once 'modulos/platillos/vistas/horario.php';
}

function mostrar() {
    require_once 'modulos/platillos/modelos/platilloModelo.php';
    $idPlatillo = $_GET['i'];
    $platillo = getPlatillo($idPlatillo);
    echo '<table border=1>';
    Platillo::printHeader();
    $platillo->printPlatillo();
    echo '</table';
}

?>
