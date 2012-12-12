<?php

function buscarRestauranteHome() {
    require_once('funcionesPHP/funcionesGenerales.php');
    require_once 'modulos/restaurantes/modelos/RestauranteModelo.php';
    require_once 'modulos/restaurantes/clases/Restaurante.php';
    //valores necesarios
    $idColonia = -1;
    $idTiposComida = array();
    $domicilio = true;
    $recoger = true;
    if (isset($_GET['idColonia']) &&
            is_numeric($_GET['idColonia']) &&
            $_GET['idColonia'] > 0) {
        $idColonia = $_GET['idColonia'];

        if (!isset($_GET['preferenciaDomicilio']))
            $domicilio = false;
        if (!isset($_GET['preferenciaRecoger']))
            $recoger = false;

        if (isset($_GET['antojos'])) {
            $rawAntojos = $_GET['antojos'];
            foreach ($rawAntojos as $antojo) {
                if ($antojo != -1) {
                    if (!in_array($antojo, $idTiposComida)) {
                        array_push($idTiposComida, $antojo);
                    }
                }
            }
        }

        $valores = array();
        $valores['idColonia'] = $idColonia;
        $valores['idTiposComida'] = $idTiposComida;
        $valores['domicilio'] = $domicilio;
        $valores['recoger'] = $recoger;
        $metodoEntrega = getIdMetodoEntrega($domicilio, $recoger);
        mostrarBusqueda($idColonia, $idTiposComida, $metodoEntrega);
    } else {
        $coloniaNoReconocida = true;
        redirect("/?coloniaNoReconocida=true");
    }
}

function buscarRestaurante() {
    require_once('funcionesPHP/funcionesGenerales.php');
    require_once 'modulos/restaurantes/modelos/RestauranteModelo.php';
    require_once 'modulos/restaurantes/clases/Restaurante.php';

    //valores necesarios
    $idColonia = -1;
    $idTiposComida = array();
    //Se va a guardar la busqueda en la sesión para poder regresar sin tener que mandar los datos por post
    //si hay post, sacamos los datos de ahí, si no, de la session
    $banderaValores = false;

    if (isset($_GET['idColonia'])) {
        //hay post, obtenemos los datos de aquí y lo guardamos en la sesión
        $banderaValores = true;
        $idColonia = $_GET['idColonia'];
        $idTiposComida = null;
        if (isset($_GET['idTipoComida']) && is_numeric($_GET['idTipoComida'])) {
            //echo 'id ' . $_POST['idTipoComida'] . " ||";
            $idTiposComida = array();
            array_push($idTiposComida, $_GET['idTipoComida']);
        }
        if (isset($_GET['idMetodoEntrega']) && is_numeric($_GET['idMetodoEntrega'])) {
            $metodoEntrega = $_GET['idMetodoEntrega'];
        } else {
            $metodoEntrega = 2;
        }
        mostrarBusqueda($idColonia, $idTiposComida, $metodoEntrega);
    } else {
        goToIndex();
    }
}

function mostrarBusqueda($idColonia, $idTiposComida, $metodoEntrega) {
    $busquedaAvanzada = false; //es búsqueda avanzada cuando hay tipo de comida o método de entrega seleccionado
    $noHayResultadosEnBusquedaAvanzada = false;
    if($metodoEntrega != 2 || sizeof($idTiposComida) > 0){
        $busquedaAvanzada = true;
    }
    
    $restaurantes = getRestaurantesColoniaTipoComidaMetodoEntrega($idColonia, $idTiposComida, $metodoEntrega);
    if(sizeof($restaurantes) == 0){
        //si no hay resultados y estamos en una busqueda avanzada, hacemos una busqueda simple sobre esta colonia
        $noHayResultadosEnBusquedaAvanzada = true;
        $aux = array();
        $restaurantes = getRestaurantesColoniaTipoComidaMetodoEntrega($idColonia, $aux, 2);
        if(sizeof($restaurantes) == 0){
            //si sigue siendo 0, no hay restaurantes en esa colonia
            $noHayResultadosEnBusquedaAvanzada=false;
        }
    }
    require_once 'modulos/tipoComida/modelos/tipoComidaModelo.php';
    $tiposDeComida = getTiposComida();
    require_once 'modulos/colonias/modelos/ColoniaModelo.php';
    $colonias = getColonias();
    $colonia = getColonia($idColonia);
    $idTipoComida = -1;
    if (sizeof($idTiposComida) == 1)
        $idTipoComida = $idTiposComida[0];
    require_once 'modulos/pedidos/vistas/resultadosBusqueda.php';
}

function menu() {
    require_once('funcionesPHP/funcionesGenerales.php');
    require_once('modulos/platillos/modelos/platilloModelo.php');
    require_once('modulos/restaurantes/modelos/RestauranteModelo.php');

    $idRestaurante = $_GET['i']; //obtenemos el id del restaurante por get
    $idColonia = $_GET['ic']; //colonia desde la que se hizo la búsqueda
    $habilitado = false;         //bandera que nos permite hacer las validaciones

    $restaurante = getRestaurante($idRestaurante);          //obtenemos la información del restaurante por su id
    $platillos = getPlatillosDeRestaurante($idRestaurante); //obtenemos todos los platillos de ese restaurante
    //*********************VALIDACIÓN DEL HORARIO DEL RESTAURANTE********************
    //Esto se movió a una función en funcionesPHP/funcionesGenerales.php
    //
    $habilitado = restauranteAbiertoAhorita($idRestaurante);

    //*******************************************************************************
    //Hace arreglo esa parte de la sesión para poder asignar platillos a diferentes restaurantes
    if (empty($_SESSION["'rest" . $restaurante->idRestaurante . "'"])) {
        $_SESSION["'rest" . $restaurante->idRestaurante . "'"] = array();
    }
    //***************************************************************************
    require_once 'modulos/tipoComida/modelos/tipoComidaModelo.php';
    $tiposDeComida = getTiposComida();
    require_once 'modulos/colonias/modelos/ColoniaModelo.php';
    $colonias = getColonias();
    $colonia = getColonia($idColonia);
    $coloniaRestaurante = getColonia($restaurante->idColonia);
    $restaurante->nombreColonia = $coloniaRestaurante->nombre;
    require_once 'modulos/colonias/modelos/DelegacionModelo.php';
    $restaurante->delegacion = getDelegacion($coloniaRestaurante->idDelegacion);
    require_once('modulos/platillos/vistas/mostrarPlatillosPedido.php');
}

function obtenIngredientes() {
    require_once('modulos/pedidos/modelos/pedidoModelo.php');
    require_once 'modulos/pedidos/clases/PlatilloElementos.php';
    $idPlatillo = $_POST['platillo'];
    $json = getIngredientesPlatillo($idPlatillo);
    echo json_encode($json);
}

function obtenPedidos() {
    require_once('modulos/pedidos/modelos/pedidoModelo.php');
    require_once 'modulos/pedidos/clases/PlatilloElementos.php';
    $pedidos = getPedidos($_GET['i']);
    return $pedidos;
}

function confirmarPedido() {
    require_once('modulos/pedidos/modelos/pedidoModelo.php');
    require_once('modulos/usuarios/modelos/usuarioModelo.php');
    require_once 'modulos/pedidos/clases/PlatilloElementos.php';
    $json = getUsuarioFromEmail($_SESSION['email']);
    echo json_encode($json);
}

function agregaAlPedido() {
    require_once('modulos/pedidos/modelos/pedidoModelo.php');
    require_once 'modulos/pedidos/clases/PlatilloElementos.php';
    $json = guardaPedido();
    echo json_encode($json);
}

function agregaDireccion() {
    require_once('modulos/pedidos/modelos/pedidoModelo.php');
    require_once 'modulos/usuarios/clases/Direccion.php';
    $json = guardaDireccion();
    echo json_encode($json);
}

function eliminarDelPedido() {
    require_once('modulos/pedidos/modelos/pedidoModelo.php');
    require_once 'modulos/pedidos/clases/PlatilloElementos.php';
    $ir = $_GET['ir'];
    $idColonia = $_GET['ic'];
    eliminarPlatilloPedido();
    redirect('pedidos.php?a=menu&i=' . $ir . '&ic=' . $idColonia);
}

function pedir() {
    require_once('modulos/pedidos/modelos/pedidoModelo.php');
    require_once('modulos/usuarios/modelos/usuarioModelo.php');
    require_once 'modulos/pedidos/clases/PlatilloElementos.php';
    $idRestaurante = $_GET['i'];
    $pedidos = getPedidos($idRestaurante);
    $pedidoGenerado = mostrarPedidoGenerado($pedidos);
    //$errores = generarPedido($pedidos);
    if (isLogued())
        $direcciones = getDireccionesRestauranteUsuario($_SESSION["idUsuario"], $idRestaurante);
    require_once('modulos/pedidos/vistas/pedir.php');
}

function avanzarPedido() {
    require_once('modulos/pedidos/modelos/pedidoModelo.php');
    require_once('modulos/restaurantes/modelos/RestauranteModelo.php');
    require_once('modulos/usuarios/modelos/usuarioModelo.php');
    require_once('modulos/mail/modelos/mailModelo.php');
    require_once 'modulos/pedidos/clases/PlatilloElementos.php';
    $idRestaurante = $_GET['i'];
    $pedidos = getPedidos($idRestaurante);
    $errores = generarPedido($pedidos);
    $restaurante = getRestaurante($idRestaurante);
    require_once('modulos/pedidos/vistas/pedidoPago.php');
}

function terminarPedido() {
    require_once('modulos/pedidos/modelos/pedidoModelo.php');
    require_once('modulos/restaurantes/modelos/RestauranteModelo.php');
    require_once('modulos/usuarios/modelos/usuarioModelo.php');
    require_once('modulos/mail/modelos/mailModelo.php');
    require_once 'modulos/pedidos/clases/PlatilloElementos.php';
    $idRestaurante = $_GET['i'];
    $restaurante = getRestaurante($idRestaurante);
    $cliente = enviaMailSMTP("Pedido a " . $restaurante->nombre, "Se ha generado su pedido con un total de " . $_SESSION['precioTotal'] . " informacion: " . $_SESSION['pedidoResumen'], "no-reply@efood.com.mx", $_SESSION['email']);
    $emailRestaurante = enviaMailSMTP("Pedido de " . $_SESSION['email'], "Se ha generado un pedido con un total de " . $_SESSION['precioTotal'] . " por parte de " . $_SESSION['email'] . " informacion: " . $_SESSION['pedidoResumen'], "no-reply@efood.com.mx", $restaurante->email);
    require_once('modulos/pedidos/vistas/termina.php');
}

function usuarioSolicitudRestaurante() {
    if (isset($_POST['nombre']) && isset($_POST['idColonia'])) {
        $msg = "";

        require_once 'modulos/colonias/modelos/ColoniaModelo.php';
        if ($_POST['idColonia'] >= 0) {
            $colonia = getColonia($_POST['idColonia']);
        } else {
            $colonia = new Colonia();
            $colonia->idColonia = -1;
            $colonia->nombre = "No hay colonia de búsqueda, fue una recomendación";
        }
        if (isset($_SESSION['email'])) {
            $msg = "El usuario con email = " . $_SESSION['email'];
        } else {
            $msg = "Un usuario no registrado";
        }
        $msg .= " solicitó que se agregara un restaurante.";
        $msg .= "<table>" .
                "<tr><td>Nombre</td><td>" . $_POST['nombre'] . "</td></tr>" .
                "<tr><td>Id Colonia</td><td>" . $colonia->idColonia . "</td></tr>" .
                "<tr><td>Nombre Colonia</td><td>" . $colonia->nombre . "</td></tr>";

        if (isset($_POST['telefono']))
            $msg .="<tr><td>Teléfono</td><td>" . $_POST['telefono'] . "</td></tr>";;

        if (isset($_POST['telefono']))
            $msg .="<tr><td>Dirección</td><td>" . $_POST['direccion'] . "</td></tr>";;

        $msg .="</table>";
        require_once 'modulos/mail/modelos/mailModelo.php';
        if (enviarEmailDeSolicitudAgregarRestaurante($msg)) {
            setSessionMessage("<h2 class='success'>¡Gracias por tu apoyo!</h2><h3>Agregarémos este restaurante lo antes posible</h3>");
        } else {
            setSessionMessage("<h2 class='error'>Ocurrió un error al enviar tus datos</h2>");
        }
    }
    goToIndex();
}

?>