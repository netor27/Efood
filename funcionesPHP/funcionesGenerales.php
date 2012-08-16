<?php

function goToIndex() {
    require_once('modulos/principal/vistas/principal.php');
}

function getUrl() {
    $s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
    $protocol = strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/") . $s;
    $port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":" . $_SERVER["SERVER_PORT"]);
    return $protocol . "://" . $_SERVER['SERVER_NAME'] . $port . $_SERVER['REQUEST_URI'];
}

function redirect($url, $permanent = false) {
    if ($permanent) {
        header('HTTP/1.1 301 Moved Permanently');
    }
    header('Location: ' . $url);
    exit();
}

function strleft($s1, $s2) {
    return substr($s1, 0, strpos($s1, $s2));
}

function tipoUsuario() {
    require_once '/modulos/usuarios/clases/Usuario.php';

    if (isset($_SESSION['usuario'])) {
        $usuario = $_SESSION['usuario'];
        if ($usuario->tipoUsuario == 1) {
            return 'administrador';
        } else if ($usuario->tipoUsuario == 0) {
            return 'usuario';
        }
    } else {
        return 'visitante';
    }
}

function getUsuarioActual() {
    if (isset($_SESSION['usuario'])) {
        return $_SESSION['usuario'];
    } else {
        return NULL;
    }
}

function validarUsuarioLoggeado() {
    if (!isset($_SESSION['usuario'])) {
        $pagina = getUrl();
        $msgLogin = "Debes iniciar sesión para ver este contenido.";
        require_once 'modulos/principal/vistas/login.php';
        return false;
    } else {
        return true;
    }
}

function validarUsuarioLoggeadoParaAjax() {
    return isset($_SESSION['usuario']);
}

function validarUsuarioLoggeadoParaSubmits() {
    return isset($_SESSION['usuario']);
}

function validarUsuarioLoggeadoMandarIndex() {
    if (!isset($_SESSION['usuario'])) {
        goToIndex();
    }
}

function comprobar_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function transformaDateDDMMAAAA($date) {
    list($fecha, $hora) = explode(" ", $date);
    list($anio, $mes, $dia) = explode("-", $fecha);
    return $dia . "-" . $mes . "-" . $anio;
}

function getUniqueCode($length) {
    $code = md5(uniqid(rand(), true));
    if ($length != "")
        return substr($code, 0, $length);
    else
        return $code;
}

function getTextoFormaDePago($formaDePago) {
    switch ($formaDePago) {
        case 0:
            return "Sólo efectivo";
            break;
        case 1:
            return "Tarjeta de crédito";
            break;
        case 2:
            return "Ambos";
            break;
        default:
            return "Forma de pago no válida";
            break;
    }
}

function getTextoMetodoEntrega($metodoEntrega) {
    switch ($metodoEntrega) {
        case 0:
            return "Recoger en restaurante";
            break;
        case 1:
            return "Envío a domicilio";
            break;
        case 2:
            return "Ambos";
            break;
        default:
            return "Método de entrega no válido";
            break;
    }
}

function getTextoTipoGastoEnvio($tipoGasto) {
    switch ($tipoGasto) {
        case 0:
            return "Monto fijo";
            break;
        case 1:
            return "Porcentaje";
            break;
        case 2:
            return "Compuesto";
            break;
        default:
            return "Tipo de gasto no válido";
            break;
    }
}

function getTextoTipoComision($tipoComision) {
    switch ($tipoComision) {
        case 0:
            return "Monto fijo";
            break;
        case 1:
            return "Porcentaje";
            break;
        case 2:
            return "Compuesto";
            break;
        default:
            return "Tipo de gasto no válido";
            break;
    }
}

function getTextoHabilitado($habilitado) {
    switch ($habilitado) {
        case 0:
            return "Deshabilitado";
            break;
        case 1:
            return "Habilitado";
            break;
        default:
            return "Tipo de habilitado no válido";
            break;
    }
}

function getHoras($strTime) {
    $aux = explode(":", $strTime);
    return intval($aux[0]);
}

function getMinutos($strTime) {
    $aux = explode(":", $strTime);
    return intval($aux[1]);
}

function getTimeHHMM($strTime) {
    $aux = explode(":", $strTime);
    return getNumber2Digits(intval($aux[0])) . ":" . getNumber2Digits(intval($aux[1]));
}

function getNumber2Digits($number) {
    if ($number < 10)
        return "0" . $number;
    else
        return "" . $number;
}

function confirmBoxBaja() {
    $box = '<script type="text/javascript">
            function confirmation(ID,Name,texto,locacion) {
                var answer = confirm("Eliminar: "+Name+" ?")
                if (answer){
                    alert(""+texto+" "+Name);
                    window.location = locacion+ID;
                }
                else{
                    
                }
            }
        </script>';
    echo $box;
}

function evaluarComision($funcion, $total) {
    $funcion = str_replace("total", $total, $val);
    $res = 0;
    eval("\$res = $funcion;");
    echo $res;
}

function setSessionMessage($message) {
    $_SESSION['sessionMessage'] = $message;
}

function getSessionMessage() {
    if (isset($_SESSION['sessionMessage'])) {
        $sessionMessage = $_SESSION['sessionMessage'];
        $_SESSION['sessionMessage'] = NULL;
        unset($_SESSION['sessionMessage']);
        return $sessionMessage;
    }
    else
        return NULL;
}

function validarRestauranteLoggeado() {
    if (!isset($_SESSION['restauranteUsuario'])) {
        $pagina = getUrl();
        require_once 'modulos/administracionRestaurantes/vistas/login.php';
        return false;
    } else {
        return true;
    }
}

function getRestauranteLoggeado() {
    if (isset($_SESSION['restauranteUsuario'])) {
        return $_SESSION['restauranteUsuario'];
    }
    return null;
}

function validarAdministrador() {
    if (isset($_SESSION['tipo']) && $_SESSION['tipo'] == 1)
        return true;
    else
        return false;
}

function validarRestauranteLoggeadoId($idRestaurante) {
    if(!isset($_SESSION['restauranteUsuario'])) {
        return false;
    }else{
        $res = $_SESSION['restauranteUsuario'];
        return $res->idRestaurante == $idRestaurante;
    }
}

?>