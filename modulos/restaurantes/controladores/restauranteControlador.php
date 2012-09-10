<?php

/**
 * Description of restauranteControlador
 *
 * @author neto
 */
function alta() {
    if (validarAdministrador()) {
        $tipo = "alta";
        require_once 'modulos/colonias/modelos/ColoniaModelo.php';
        $colonias = getColonias();
        require_once 'modulos/restaurantes/clases/Restaurante.php';
        require_once 'modulos/colonias/clases/Colonia.php';
        $restaurante = new Restaurante();
        $colonia = new Colonia();
        require_once 'modulos/restaurantes/vistas/formaRestaurante.php';
    } else {
        goToIndex();
    }
}

function formaRestauranteSubmit() {
    $tipo = $_GET['t'];

    require_once 'modulos/restaurantes/clases/Restaurante.php';
    require_once 'modulos/restaurantes/modelos/RestauranteModelo.php';
    if (isset($_POST['idRestaurante'])) {
        $restaurante = getRestaurante($_POST['idRestaurante']);
    } else {
        $restaurante = new Restaurante();
    }
    $restaurante->calle = $_POST['calle'];
    $restaurante->descripcion = $_POST['descripcion'];
    $restaurante->email = $_POST['email'];
    $restaurante->formaPago = $_POST['formaPago'];
    $restaurante->gastoEnvio = $_POST['gastoEnvio'];
    $restaurante->idColonia = $_POST['idColonia'];

    $restaurante->metodoEntrega = $_POST['metodoEntrega'];
    $restaurante->nombre = $_POST['nombre'];
    $restaurante->numero = $_POST['numero'];
    $restaurante->numeroInt = $_POST['numeroInt'];
    $restaurante->paginaWeb = $_POST['paginaWeb'];

    $restaurante->pedidoMinimo = $_POST['pedidoMinimo'];
    $restaurante->razonSocial = $_POST['razonSocial'];
    $restaurante->referencia = $_POST['referencia'];
    $restaurante->rfc = $_POST['rfc'];
    $restaurante->telefono = $_POST['telefono'];
    $restaurante->usuario = $_POST['usuario'];

    $restaurante->nombreContacto = $_POST['nombreContacto'];
    $restaurante->telefonoContacto = $_POST['telefonoContacto'];
    $restaurante->tipoComision = $_POST['tipoComision'];
    $restaurante->tipoGastoEnvio = $_POST['tipoGasto'];
    $restaurante->comision = $_POST['comision'];
    $restaurante->tipoGasto = $_POST['tipoGasto'];
    $restaurante->habilitado = $_POST['habilitado'];

    require_once 'modulos/restaurantes/modelos/RestauranteModelo.php';
    if ($tipo == "alta") {
        if (validarAdministrador()) {
            $restaurante->password = md5($_POST['password']);
            $restaurante->idRestaurante = altaRestaurante($restaurante);
            if ($restaurante->idRestaurante >= 0) {
                setSessionMessage("Se dió de alta el restaurante " . $restaurante->nombre);
                redirect("restaurantes.php");
            } else {
                $tipo = "alta";
                $msg = "Ocurrió un error al dar de alta el restaurante";
                require_once 'modulos/colonias/modelos/ColoniaModelo.php';
                $colonias = getColonias();
                require_once 'modulos/restaurantes/vistas/formaRestaurante.php';
            }
        } else {
            goToIndex();
        }
    } else if ($tipo == "editar") {
        $restaurante->idRestaurante = $_POST['idRestaurante'];
        if (validarAdministrador() || validarRestauranteLoggeadoId($restaurante->idRestaurante)) {
            if (modificaRestaurante($restaurante)) {
                setSessionMessage("Se modificó el restaurante " . $restaurante->nombre);
                redirect("restaurantes.php?a=editar&i=" . $restaurante->idRestaurante);
            } else {
                $tipo = "editar";
                $msg = "Ocurrió un error al modificar el restaurante";
                require_once 'modulos/colonias/modelos/ColoniaModelo.php';
                $colonias = getColonias();
                require_once 'modulos/restaurantes/vistas/formaRestaurante.php';
            }
        } else {
            goToIndex();
        }
    }
}

function borrar() {
    $idRestaurante = $_GET['i'];
    if (validarAdministrador()) {
        require_once 'modulos/restaurantes/modelos/RestauranteModelo.php';
        if (bajaRestaurante($idRestaurante)) {
            setSessionMessage("Se borró correctamente");
        } else {
            setSessionMessage("Ocurrió un error al borrar");
        }
        redirect("restaurantes.php");
    } else {
        goToIndex();
    }
}

function editar() {
    $tipo = "editar";
    $idRestaurante = $_GET['i'];
    if (validarAdministrador() || validarRestauranteLoggeadoId($idRestaurante)) {
        require_once 'modulos/restaurantes/modelos/RestauranteModelo.php';
        $restaurante = getRestaurante($idRestaurante);
        require_once 'modulos/colonias/modelos/ColoniaModelo.php';
        $colonia = getColonia($restaurante->idColonia);
        require_once 'modulos/colonias/modelos/ColoniaModelo.php';
        $colonias = getColonias();
        require_once 'modulos/restaurantes/vistas/formaRestaurante.php';
    } else {
        goToIndex();
    }
}

function mostrar() {
    if (validarAdministrador()) {
        confirmBoxBaja();
        require_once 'modulos/restaurantes/modelos/RestauranteModelo.php';
        $restaurantes = getRestaurantes();
        require_once 'modulos/restaurantes/vistas/mostrarRestaurantes.php';
    } else {
        goToIndex();
    }
}

function coloniasEntregaRestaurante() {
    $idRestaurante = $_GET['i'];
    if (validarAdministrador() || validarRestauranteLoggeadoId($idRestaurante)) {
        require_once 'modulos/restaurantes/modelos/RestauranteModelo.php';
        $restaurante = getRestaurante($idRestaurante);
        $colonias = getColoniasEntrega($idRestaurante);
        require_once 'modulos/restaurantes/vistas/coloniasEntregaRestaurante.php';
    } else {
        goToIndex();
    }
}

function agregarColoniaEntrega() {
    $idRestaurante = $_GET['res'];
    $idColonia = $_GET['col'];
    if (validarAdministrador() || validarRestauranteLoggeadoId($idRestaurante)) {
        require_once 'modulos/restaurantes/modelos/RestauranteModelo.php';
        if (agregarRelacionColoniaEntrega($idRestaurante, $idColonia)) {
            echo 'ok';
        }
    } else {
        echo 'no tienes los permisos para hacer eso';
    }
}

function eliminarColoniaEntrega() {
    $idRestaurante = $_GET['res'];
    $idColonia = $_GET['col'];
    if (validarAdministrador() || validarRestauranteLoggeadoId($idRestaurante)) {
        require_once 'modulos/restaurantes/modelos/RestauranteModelo.php';
        if (eliminarRelacionColoniaEntrega($idRestaurante, $idColonia)) {
            echo 'ok';
        }
    } else {
        echo 'no tienes los permisos para hacer eso';
    }
}

function horario() {
    require_once 'modulos/restaurantes/modelos/RestauranteModelo.php';
    $idRestaurante = $_GET['i'];
    if (validarAdministrador() || validarRestauranteLoggeadoId($idRestaurante)) {
        $restaurante = getRestaurante($idRestaurante);
        $horario = getHorario($idRestaurante);
        require_once 'modulos/restaurantes/vistas/horario.php';
    } else {
        goToIndex();
    }
}

function actualizarHorario() {
    require_once 'modulos/restaurantes/modelos/RestauranteModelo.php';
    $idRestaurante = $_POST['idRestaurante'];
    if (validarAdministrador() || validarRestauranteLoggeadoId($idRestaurante)) {
        $restaurante = getRestaurante($idRestaurante);
        require_once 'modulos/restaurantes/clases/Horario.php';
        $horario = getHorario($idRestaurante);

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
        if (actualizaHorario($idRestaurante, $horario)) {
            $error = "Se actualizó correctamente el horario";
        } else {
            $horario = getHorario($idRestaurante);
            $error = "Ocurrió un error al actualizar el horario";
        }
        require_once 'modulos/restaurantes/vistas/horario.php';
    } else {
        goToIndex();
    }
}

function menu() {
    require_once('modulos/platillos/modelos/platilloModelo.php');
    $idRestaurante = $_GET['i'];
    if (validarAdministrador() || validarRestauranteLoggeadoId($idRestaurante)) {
        confirmBoxBaja();
        require_once('modulos/restaurantes/modelos/RestauranteModelo.php');
        $restaurante = getRestaurante($idRestaurante);
        $platillos = getPlatillosDeRestaurante($idRestaurante);
        require_once('modulos/platillos/vistas/mostrarPlatillos.php');
    } else {
        goToIndex();
    }
}

function tipoComida() {
    $idRestaurante = $_GET['i'];
    if (validarAdministrador() || validarRestauranteLoggeadoId($idRestaurante)) {
        require_once 'modulos/restaurantes/modelos/RestauranteModelo.php';
        require_once 'modulos/restaurantes/modelos/RestauranteModelo.php';
        $restaurante = getRestaurante($idRestaurante);
        $tiposComida = getTipoComidaRestaurante($idRestaurante);
        require_once 'modulos/restaurantes/vistas/tiposComidaRestaurante.php';
    } else {
        goToIndex();
    }
}

function agregarTipoComida() {
    $idRestaurante = $_GET['res'];
    $idTipoComida = $_GET['tipo'];
    if (validarAdministrador() || validarRestauranteLoggeadoId($idRestaurante)) {
        require_once 'modulos/restaurantes/modelos/RestauranteModelo.php';
        if (agregarRelacionTipoComida($idRestaurante, $idTipoComida)) {
            echo 'ok';
        }
    } else {
        echo 'no tienes los permisos para hacer eso';
    }
}

function eliminarTipoComida() {
    $idRestaurante = $_GET['res'];
    $idTipoComida = $_GET['tipo'];
    if (validarAdministrador() || validarRestauranteLoggeadoId($idRestaurante)) {
        require_once 'modulos/restaurantes/modelos/RestauranteModelo.php';
        if (eliminarRelacionTipoComida($idRestaurante, $idTipoComida)) {
            echo 'ok';
        }
    } else {
        echo 'no tienes los permisos para hacer eso';
    }
}

function actualizarLogo() {
    $idRestaurante = $_GET['i'];
    if (validarAdministrador() || validarRestauranteLoggeadoId($idRestaurante)) {
        require_once 'modulos/restaurantes/modelos/RestauranteModelo.php';
        $restaurante = getRestaurante($idRestaurante);
        require_once 'modulos/restaurantes/vistas/logo.php';
    } else {
        goToIndex();
    }
}

function actualizarLogoSubmit() {
    $idRestaurante = $_POST['idRestaurante'];
    if (validarAdministrador() || validarRestauranteLoggeadoId($idRestaurante)) {
        require_once 'modulos/restaurantes/modelos/RestauranteModelo.php';
        $restaurante = getRestaurante($idRestaurante);
        $sufix = getUniqueCode(5);

        if ((($_FILES["logo"]["type"] == "image/gif")
                || ($_FILES["logo"]["type"] == "image/jpeg")
                || ($_FILES["logo"]["type"] == "image/pjpeg")
                || ($_FILES["logo"]["type"] == "image/png"))
                && ($_FILES["logo"]["size"] < 5000000)) {
            if ($_FILES["logo"]["error"] > 0) {
                echo "Error al subir el archivo: " . $_FILES["logo"]["error"] . "<br />";
            } else {
                $fileName = "archivos/" . $sufix . "_" . $_FILES["logo"]["name"];
                if (file_exists($fileName)) {
                    unlink($fileName);
                }
                move_uploaded_file($_FILES["logo"]["tmp_name"], $fileName);

                $logoAnterior = $restaurante->logo;
                echo $idRestaurante;
                if (actualizaLogoRestaurante($idRestaurante, $fileName)) {
                    $error = 'Se actualizó el logo del archivo';
                    if (file_exists($logoAnterior)) {
                        unlink($logoAnterior);
                    }
                    $restaurante->logo = $fileName;
                } else {
                    $error = 'Ocurrió un error al actualizar el logo';
                }
                require_once 'modulos/restaurantes/vistas/logo.php';
            }
        } else {
            echo "No se permite ese tipo de archivo";
        }
    } else {
        echo "No tienes los permisos para hacer eso";
    }
}

function RestaurantesJSON() {
    $term = $_GET['term'];
    require_once 'modulos/restaurantes/modelos/RestauranteModelo.php';
    $restaurantes = busquedaRestaurantesUTF8($term);

    echo json_encode($restaurantes);
}

function establecerPassword() {
    $idRestaurante = $_GET['i'];
    if (validarAdministrador() || validarRestauranteLoggeadoId($idRestaurante)) {
        require_once 'modulos/restaurantes/vistas/formaPassword.php';
    } else {
        goToIndex();
    }
}

function establecerPasswordSubmit() {
    $idRestaurante = $_POST['i'];
    if (validarAdministrador() || validarRestauranteLoggeadoId($idRestaurante)) {
        $pass = $_POST['pass'];
        $pass2 = $_POST['pass2'];
        if ($pass == $pass2) {
            $pass = md5($pass);
            require_once 'modulos/restaurantes/modelos/RestauranteModelo.php';
            if (actualizarPassword($idRestaurante, $pass)) {
                setSessionMessage("<h2 style='color:red'>Se actualizó correctamente el password</h2>");
                redirect("restaurantes.php?a=editar&i=" . $idRestaurante);
            } else {
                setSessionMessage("<h2 style='color:red'>Ocurrió un error al acutalizar los datos</h2>");
                redirect("restaurantes.php?a=establecerPassword&i=" . $idRestaurante);
            }
        } else {
            setSessionMessage("<h2 style='color:red'>Las contraseñas no coinciden</h2>");
            redirect("restaurantes.php?a=establecerPassword&i=" . $idRestaurante);
        }
    } else {
        goToIndex();
    }
}

?>