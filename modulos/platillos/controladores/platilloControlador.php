<?php

function alta() {
    $idRestaurante = $_GET['r'];
    if (validarAdministrador() || validarRestauranteLoggeadoId($idRestaurante)) {
        $tipo = "alta";
        require_once 'modulos/platillos/clases/Platillo.php';        
        $platillo = new Platillo();
        require_once 'modulos/platillos/modelos/CategoriaPlatilloModelo.php';
        $categorias = getCategoriasDeRestaurante($idRestaurante);
        require_once 'modulos/platillos/vistas/formaPlatillo.php';
    } else {
        goToIndex();
    }
}

function formaPlatilloSubmit() {
    $idRestaurante = $_POST['idRestaurante'];
    if (validarAdministrador() || validarRestauranteLoggeadoId($idRestaurante)) {

        $tipo = $_GET['t'];
        require_once 'modulos/platillos/clases/Platillo.php';
        $platillo = new Platillo();
        $platillo->idRestaurante = $idRestaurante;
        $platillo->nombre = $_POST['nombre'];
        $platillo->descripcion = $_POST['descripcion'];
        $platillo->idCategoriaPlatillo = $_POST['idCategoriaPlatillo'];
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
                setSessionMessage('Se modificó el platillo ' . $platillo->nombre);
            } else {
                $tipo = "editar";
                $error = "Ocurrió un error al modificar el platillo";
                require_once 'modulos/platillos/vistas/formaPlatillo.php';
            }
        }
        redirect("restaurantes.php?a=menu&i=" . $idRestaurante);
    } else {
        goToIndex();
    }
}

function borrar() {
    $idPlatillo = $_GET['i'];
    require_once 'modulos/platillos/modelos/platilloModelo.php';
    $idRestaurante = getIdRestauranteDePlatillo($idPlatillo);
    if (validarAdministrador() || validarRestauranteLoggeadoId($idRestaurante)) {
        if (bajaPlatillo($idPlatillo)) {
            setSessionMessage("Se borró correctamente");
        } else {
            setSessionMessage("Ocurrió un error al borrar");
        }
        redirect("restaurantes.php?a=menu&i=" . $idRestaurante);
    } else {
        goToIndex();
    }
}

function modificar() {
    $tipo = "editar";
    $idPlatillo = $_GET['i'];
    require_once 'modulos/platillos/modelos/platilloModelo.php';
    $idRestaurante = getIdRestauranteDePlatillo($idPlatillo);
    if (validarAdministrador() || validarRestauranteLoggeadoId($idRestaurante)) {
        require_once 'modulos/platillos/modelos/CategoriaPlatilloModelo.php';
        $categorias = getCategoriasDeRestaurante($idRestaurante);
        require_once 'modulos/platillos/clases/Platillo.php';
        $platillo = getPlatillo($idPlatillo);
        require_once 'modulos/platillos/vistas/formaPlatillo.php';
    } else {
        goToIndex();
    }
}

function horario() {
    $idPlatillo = $_GET['i'];
    require_once 'modulos/platillos/modelos/platilloModelo.php';
    $platillo = getPlatillo($idPlatillo);
    $horario = getHorarioPlatillo($idPlatillo);
    $platillos = getPlatillosDeRestaurante($platillo->idRestaurante);
    if (validarAdministrador() || validarRestauranteLoggeadoId($platillo->idRestaurante)) {
        require_once 'modulos/platillos/vistas/horario.php';
    } else {
        goToIndex();
    }
}

function actualizarHorario() {
    require_once 'modulos/platillos/modelos/platilloModelo.php';
    $idPlatillo = $_POST['idPlatillo'];
    $platillo = getPlatillo($idPlatillo);
    $platillos = getPlatillosDeRestaurante($platillo->idRestaurante);

    require_once 'modulos/restaurantes/clases/Horario.php';
    $horario = getHorarioPlatillo($idPlatillo);
    if (validarAdministrador() || validarRestauranteLoggeadoId($platillo->idRestaurante)) {
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
    } else {
        goToIndex();
    }
}

function copiarHorario() {
    require_once 'modulos/platillos/modelos/platilloModelo.php';
    $idPlatillo = $_POST['idPlatillo'];
    $platillo = getPlatillo($idPlatillo);
    $platillos = getPlatillosDeRestaurante($platillo->idRestaurante);
    if (validarAdministrador() || validarRestauranteLoggeadoId($platillo->idRestaurante)) {
        $idPlatilloACopiar = $_POST['platilloPorCopiar'];
        $horario = getHorarioPlatillo($idPlatilloACopiar);
        if (actualizaHorarioPlatillo($idPlatillo, $horario)) {
            $error = "Se actualizó correctamente el horario";
        } else {
            $horario = getHorario($idPlatillo);
            $error = "Ocurrió un error al actualizar el horario";
        }
        require_once 'modulos/platillos/vistas/horario.php';
    } else {
        goToIndex();
    }
}

function mostrar() {
    require_once 'modulos/platillos/modelos/platilloModelo.php';
    $idPlatillo = $_GET['i'];
    $platillo = getPlatillo($idPlatillo);
    if (validarAdministrador() || validarRestauranteLoggeadoId($platillo->idRestaurante)) {
        echo '<table border=1>';
        Platillo::printHeader();
        $platillo->printPlatillo();
        echo '</table';
    } else {
        goToIndex();
    }
}

function duplicar() {
    $idRestaurante = $_GET['r'];
    if (validarAdministrador() || validarRestauranteLoggeadoId($idRestaurante)) {
        require_once 'modulos/platillos/modelos/platilloModelo.php';
        $platillos = getPlatillosDeRestaurante($idRestaurante);
        require_once 'modulos/platillos/vistas/duplicarPlatillo.php';
    } else {
        goToIndex();
    }
}

function duplicarSubmit() {
    $idRestaurante = $_POST['idRestaurante'];
    if (validarAdministrador() || validarRestauranteLoggeadoId($idRestaurante)) {
        $idPlatillo = $_POST['idPlatillo'];
        require_once 'modulos/platillos/modelos/platilloModelo.php';
        require_once 'modulos/platillos/modelos/grupoIngredientesModelo.php';
        require_once 'modulos/platillos/modelos/ingredienteModelo.php';
        
        //En estos arreglos se va a guardar los nuevos id para actualizar las dependencias
        //Se guardaran como $array[$idViejo] = $idNuevo;
        $arrayIdGrupos = array();
        $arrayIdGrupos[-1] = -1;
        $arrayIdIngredientes = array();
        $arrayIdIngredientes[-1] = -1;

        //obtenemos el platillo que vamos a duplicar
        $platillo = getPlatillo($idPlatillo);
        //obtenemos su horario
        $horario = getHorarioPlatillo($idPlatillo);
        
        //generamos un platillo nuevo, con la misma información, pero con un idNuevo
        $idPlatilloNuevo = altaPlatillo($platillo);
        //actualizamos la hora de este platillo
        actualizaHorarioPlatillo($idPlatilloNuevo, $horario);

        //obtenemos los grupos de ingredientes que pertenecen a este platillo
        $gruposIngredientes = getGruposIngredientesDePlatillo($idPlatillo);
        
        //usamos un arreglo para guardar las dependencias y después actualizar
        $arrayDependencias = array();
        
        foreach ($gruposIngredientes as $grupo) {
            //actualizamos el idPlatillo al platillo nuevo
            $grupo->idPlatillo = $idPlatilloNuevo;            
            //duplicamos este grupo de ingredientes
            $idGrupoNuevo = altaGrupoIngredientes($grupo);
            //Guardamos el nuevo id en el arreglo
            $arrayIdGrupos[$grupo->idGrupoIngredientes] = $idGrupoNuevo;
            //obtenemos los ingredientes
            $ingredientes = getIngredientesDeGrupo($grupo->idGrupoIngredientes);
            foreach ($ingredientes as $ingrediente) {
                //Establecemos que pertenece al nuevo grupo
                $ingrediente->idGrupoIngredientes = $idGrupoNuevo;
                //Creamos el nuevo ingrediente
                $idIngrediente = altaIngrediente($ingrediente);
                //Guardamos en el arreglo el nuevo id
                $arrayIdIngredientes[$ingrediente->idIngrediente] = $idIngrediente;
            }
        }        
        //Ya se duplicaron, ahora hay que establecer las dependencias
        //Obtenemos todos los nuevos grupos de ingredientes
        $gruposIngredientes = getGruposIngredientesDePlatillo($idPlatilloNuevo);
        foreach ($gruposIngredientes as $grupo) {
            //Obtenemos el nuevo grupo de ingrediente depende
            $grupo->idGrupoDepende = $arrayIdGrupos[$grupo->idGrupoDepende];
            //obtenemos el nuevo ingrediente depende
            $grupo->idIngredienteDepende = $arrayIdIngredientes[$grupo->idIngredienteDepende];
            //actualizamos
            modificaGrupoIngredientes($grupo);
        }
        
        setSessionMessage("Se duplicó correctamente el platillo");
        redirect("platillos.php?a=modificar&i=" . $idPlatilloNuevo);
    } else {
        goToIndex();
    }
}

?>