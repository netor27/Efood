<?php

/**
 * Description of tipoComidaControlador
 *
 * @author neto
 * 
 */
function principal() {
    if (validarAdministrador()) {
        require_once 'modulos/tipoComida/modelos/tipoComidaModelo.php';
        $tiposComida = getTiposComida();
        require_once 'modulos/tipoComida/vistas/mostrarTiposComida.php';
    } else {
        goToIndex();
    }
}

function alta() {
    if (validarAdministrador()) {
        $tipo = "alta";
        require_once 'modulos/tipoComida/clases/tipoComida.php';
        $tipoComida = new TipoComida();
        require_once 'modulos/tipoComida/vistas/formaTipoComida.php';
    } else {
        goToIndex();
    }
}

function modificar() {
    if (validarAdministrador()) {
        $tipo = "editar";
        $idTipoComida = $_GET['i'];
        require_once 'modulos/tipoComida/modelos/tipoComidaModelo.php';
        $tipoComida = getTipoComida($idTipoComida);
        require_once 'modulos/tipoComida/vistas/formaTipoComida.php';
    } else {
        goToIndex();
    }
}

function formaTipoComidaSubmit() {
    if (validarAdministrador()) {
        $tipo = $_GET['t'];
        require_once 'modulos/tipoComida/modelos/tipoComidaModelo.php';
        $tipoComida = new TipoComida();
        if ($tipo == "alta") {
            $res = subirImagenTipoComida("nohayimagenanterior");
            if ($res['tipo'] == "ok") {
                $tipoComida->nombre = $_POST['nombre'];
                $tipoComida->imagen = $res['desc'];
                if (altaTipoComida($tipoComida)) {
                    setSessionMessage("Se agregó correctamente");
                } else {
                    setSessionMessage("Ocurrió un error al agregar");
                }
            } else {
                setSessionMessage($res['desc']);
            }
        } else if ($tipo == "editar") {
            $tipoComida->idTipoComida = $_POST['idTipoComida'];
            $tipoComida = getTipoComida($tipoComida->idTipoComida);

            $tipoComida->nombre = $_POST['nombre'];
            $res = subirImagenTipoComida($tipoComida->imagen);
            if ($res['tipo'] == "ok") {
                $tipoComida->imagen = $res['desc'];
            }
            if (modificaTipoComida($tipoComida)) {
                setSessionMessage("Se modificó correctamente");
            } else {
                setSessionMessage("Ocurrió un error al modificar");
            }
        } else {
            setSessionMessage("Tipo invalido");
        }
        redirect("tiposComida.php");
    } else {
        goToIndex();
    }
}

function subirImagenTipoComida($imagenAnterior) {
    $result = array();
    if ((($_FILES["logo"]["type"] == "image/gif")
            || ($_FILES["logo"]["type"] == "image/jpeg")
            || ($_FILES["logo"]["type"] == "image/pjpeg")
            || ($_FILES["logo"]["type"] == "image/png"))
            && ($_FILES["logo"]["size"] < 5000000)) {
        if ($_FILES["logo"]["error"] > 0) {
            $result['tipo'] = 'error';
            $result['desc'] = "Error al subir el archivo: " . $_FILES["logo"]["error"];
        } else {
            $sufix = getUniqueCode(5);
            $fileName = "archivos/" . $sufix . "_" . $_FILES["logo"]["name"];
            if (file_exists($fileName)) {
                unlink($fileName);
            }
            if (move_uploaded_file($_FILES["logo"]["tmp_name"], $fileName)) {
                if (file_exists($imagenAnterior)) {
                    unlink($imagenAnterior);
                }
                $result['tipo'] = 'ok';
                $result['desc'] = $fileName;
            } else {
                $result['tipo'] = 'error';
                $result['desc'] = "Error al subir el archivo: ";
            }
        }
    } else {
        $result['tipo'] = 'error';
        $result['desc'] = "No se permite ese tipo de archivo";
    }
    return $result;
}

function borrar() {
    if (validarAdministrador()) {
        $idTipoComida = $_GET['i'];
        require_once 'modulos/tipoComida/modelos/tipoComidaModelo.php';
        if (bajaTipoComida($idTipoComida)) {
            setSessionMessage("Se borró el tipo de comida");
        } else {
            setSessionMessage("Ocurrió un error al borrar el tipo de comida");
        }
        redirect("tiposComida.php");
    } else {
        goToIndex();
    }
}

function tiposComidaJSON() {
    //utf8_encode($data);
    $term = $_GET['term'];
    require_once 'modulos/tipoComida/modelos/tipoComidaModelo.php';
    $tiposComida = busquedaTiposComidaUTF8($term);

    echo json_encode($tiposComida);
}

?>
