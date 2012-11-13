<?php

function goToIndex() {
    redirect("/");
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

function getIdMetodoEntrega($domicilio, $recoger) {
    if ($domicilio && $recoger) {
        return 2;
    } else if ($domicilio) {
        return 1;
    } else if ($recoger) {
        return 0;
    } else {
        return 2;
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
    if (!isset($_SESSION['restauranteUsuario'])) {
        return false;
    } else {
        $res = $_SESSION['restauranteUsuario'];
        return $res->idRestaurante == $idRestaurante;
    }
}

function getTime24() {
    $hora = date('H:i:s');
    return $hora;
}

function getDay() {
    date_default_timezone_set("Mexico/General"); //conviene ponerlo desde principal.php

    $fecha = date("d-m-Y");
    $fechats = strtotime($fecha); //a timestamp 

    $dia = "do";
    //el parametro w en la funcion date indica que queremos el dia de la semana 
    //lo devuelve en numero 0 domingo, 1 lunes,.... 
    switch (date('w', $fechats)) {
        case 0: $dia = "do";
            break;
        case 1: $dia = "lu";
            break;
        case 2: $dia = "ma";
            break;
        case 3: $dia = "mi";
            break;
        case 4: $dia = "ju";
            break;
        case 5: $dia = "vi";
            break;
        case 6: $dia = "sa";
            break;
    }
    return $dia;
}

function quitarSegundosHora($hora){
    $exploded = explode(":", $hora);
    $hora = $exploded[0].":".$exploded[1];
    return $hora;
}

function restauranteAbiertoAhorita($idRestaurante){
    $habilitado = false;
    require_once 'modulos/restaurantes/modelos/RestauranteModelo.php';
    $hora = getHorario($idRestaurante);
    $diaIni = getDay() . 'Ini';
    $diaFin = getDay() . 'Fin';
    
    //Si estamos dentro del rango, es válido
    if (getTime24() > $hora->$diaIni && getTime24() < $hora->$diaFin)
        $habilitado = true;
    
    //Si el inicio es 00:00:00 y el fin es 23:59:00, esta abierto todo el día
    if ($hora->$diaIni == '00:00:00' && $hora->$diaFin == '23:59:00')
        $habilitado = true;
    
    //cualquier otro caso, esta cerrado
    return $habilitado;
}

function isLogued(){
    return (isset($_SESSION["idUsuario"]) && $_SESSION["idUsuario"]!=null);
}

function platilloDisponibleAhorita($idPlatillo){
    $habilitado = false;
    require_once 'modulos/platillos/modelos/platilloModelo.php';    
    $hora = getHorarioPlatillo($idPlatillo);
    $diaIni = getDay() . 'Ini';
    $diaFin = getDay() . 'Fin';
    
    //Si estamos dentro del rango, es válido
    if (getTime24() > $hora->$diaIni && getTime24() < $hora->$diaFin)
        $habilitado = true;
    
    //Si el inicio es 00:00:00 y el fin es 23:59:00, esta abierto todo el día
    if ($hora->$diaIni == '00:00:00' && $hora->$diaFin == '23:59:00')
        $habilitado = true;
    
    //cualquier otro caso, esta cerrado
    return $habilitado;
}
?>