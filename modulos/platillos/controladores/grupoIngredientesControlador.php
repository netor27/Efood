<?php

/**
 * Description of grupoIngredientesControlador
 *
 * @author neto
 */
function principal() {
    confirmBoxBaja();
    $idPlatillo = $_GET['i'];
    require_once ("modulos/platillos/modelos/platilloModelo.php");
    $idRestaurante = getIdRestauranteDePlatillo($idPlatillo);
    if (validarAdministrador() || validarRestauranteLoggeadoId($idRestaurante)) {
        $platillo = getPlatillo($idPlatillo);
        require_once("modulos/platillos/modelos/grupoIngredientesModelo.php");
        $gruposIngredientes = getGruposIngredientesDePlatillo($idPlatillo);
        require_once 'modulos/platillos/vistas/mostrarGruposIngredientes.php';
    } else {
        goToIndex();
    }
}

function mostrar() {
    confirmBoxBaja();
    $idGrupoIngredientes = $_GET['i'];
    require_once 'modulos/platillos/clases/GrupoIngredientes.php';
    require_once 'modulos/platillos/modelos/grupoIngredientesModelo.php';
    $grupoIngredientes = getGrupoIngredientes($idGrupoIngredientes);
    $idPlatillo = $grupoIngredientes->idPlatillo;
    require_once ("modulos/platillos/modelos/platilloModelo.php");
    $idRestaurante = getIdRestauranteDePlatillo($idPlatillo);
    if (validarAdministrador() || validarRestauranteLoggeadoId($idRestaurante)) {
        echo '<table border=1>';
        echo GrupoIngredientes::printGrupoIngredientesHeader();
        $grupoIngredientes->printGrupoIngredientes();
        echo '</table>';
        echo '<a href="grupoIngredientes.php?i=' . $idPlatillo . '">Regresar</a>';
    } else {
        goToIndex();
    }
}

function agregarGrupoIngredientes() {
    $idPlatillo = $_GET['p'];
    require_once ("modulos/platillos/modelos/platilloModelo.php");
    $idRestaurante = getIdRestauranteDePlatillo($idPlatillo);
    if (validarAdministrador() || validarRestauranteLoggeadoId($idRestaurante)) {
        $tipo = "alta";
        require_once 'modulos/platillos/clases/GrupoIngredientes.php';
        require_once 'modulos/platillos/modelos/grupoIngredientesModelo.php';
        $gruposIngredientes = getGruposIngredientesDePlatillo($idPlatillo);
        $grupoIngredientes = new GrupoIngredientes();
        require_once 'modulos/platillos/vistas/formaGrupoIngredientes.php';
    } else {
        goToIndex();
    }
}

function formaGrupoIngredientesSubmit() {
    $tipo = $_GET['t'];
    require_once 'modulos/platillos/clases/GrupoIngredientes.php';
    $grupoIngredientes = new GrupoIngredientes();
    $idPlatillo = $_POST['idPlatillo'];
    require_once ("modulos/platillos/modelos/platilloModelo.php");
    $idRestaurante = getIdRestauranteDePlatillo($idPlatillo);
    if (validarAdministrador() || validarRestauranteLoggeadoId($idRestaurante)) {

        $grupoIngredientes->idPlatillo = $idPlatillo;
        $grupoIngredientes->nombre = $_POST['nombre'];

        if (isset($_POST['excluyente']))
            $grupoIngredientes->excluyente = 1;
        else
            $grupoIngredientes->excluyente = 0;
        if (isset($_POST['requerido']))
            $grupoIngredientes->requerido = 1;
        else
            $grupoIngredientes->requerido = 0;

        $grupoIngredientes->idGrupoDepende = $_POST['depende'];
        if ($grupoIngredientes->idGrupoDepende == -1) {
            $grupoIngredientes->idIngredienteDepende = -1;
        } else {
            $grupoIngredientes->idIngredienteDepende = $_POST['IngredienteDepende'];
        }

        require_once 'modulos/platillos/modelos/grupoIngredientesModelo.php';
        if ($tipo == "alta") {
            $grupoIngredientes->idGrupoIngredientes = altaGrupoIngredientes($grupoIngredientes);
            if ($grupoIngredientes->idGrupoIngredientes >= 0) {
                setSessionMessage("Se dió de alta el grupo de ingredientes " . $grupoIngredientes->nombre);
            } else {
                $tipo = "alta";
                $error = "Ocurrió un error al dar de alta el grupo de ingredientes";
                require_once 'modulos/platillos/modelos/grupoIngredientesModelo.php';
                $gruposIngredientes = getGruposIngredientesDePlatillo($idPlatillo);
                require_once 'modulos/platillos/vistas/formaPlatillo.php';
            }
        } else if ($tipo == "editar") {
            $grupoIngredientes->idGrupoIngredientes = $_POST['idGrupoIngredientes'];

            if ($grupoIngredientes->idGrupoDepende == $grupoIngredientes->idGrupoIngredientes) {
                $grupoIngredientes->idGrupoDepende = -1;
                $grupoIngredientes->idIngredienteDepende = -1;
            }
            if (modificaGrupoIngredientes($grupoIngredientes)) {
                setSessionMessage('Se modificó correctamente el grupo de ingredientes ' . $grupoIngredientes->nombre);
            } else {
                $tipo = "editar";
                $error = "Ocurrió un error al modificar el grupo de ingredientes";
                require_once 'modulos/platillos/modelos/grupoIngredientesModelo.php';
                $gruposIngredientes = getGruposIngredientesDePlatillo($idPlatillo);
                require_once 'modulos/platillos/vistas/formaPlatillo.php';
            }
        }
        redirect("grupoIngredientes.php?i=" . $grupoIngredientes->idPlatillo);
    } else {
        goToIndex();
    }
}

function modificar() {
    $tipo = "editar";
    $idGrupoIngredientes = $_GET['i'];
    require_once 'modulos/platillos/modelos/grupoIngredientesModelo.php';
    $idPlatillo = getIdPlatilloDeGrupoIngredientes($idGrupoIngredientes);
    require_once ("modulos/platillos/modelos/platilloModelo.php");
    $idRestaurante = getIdRestauranteDePlatillo($idPlatillo);
    if (validarAdministrador() || validarRestauranteLoggeadoId($idRestaurante)) {
        $grupoIngredientes = getGrupoIngredientes($idGrupoIngredientes);
        $gruposIngredientes = getGruposIngredientesDePlatillo($idPlatillo);
        require_once 'modulos/platillos/vistas/formaGrupoIngredientes.php';
    } else {
        goToIndex();
    }
}

function borrar() {
    $idGrupoIngredientes = $_GET['i'];
    require_once 'modulos/platillos/modelos/grupoIngredientesModelo.php';
    $idPlatillo = getIdPlatilloDeGrupoIngredientes($idGrupoIngredientes);
    require_once ("modulos/platillos/modelos/platilloModelo.php");
    $idRestaurante = getIdRestauranteDePlatillo($idPlatillo);
    if (validarAdministrador() || validarRestauranteLoggeadoId($idRestaurante)) {
        $gruposQueDependen = getGruposIngredientesQueDependenDeEsteGrupo($idGrupoIngredientes);
        if (is_null($gruposQueDependen) || sizeof($gruposQueDependen) == 0) {
            if (bajaGrupoIngredientes($idGrupoIngredientes)) {
                setSessionMessage("<div class='success'>Se borró correctamente</div>");
            } else {
                setSessionMessage("<div class='error'>Ocurrió un error al borrar</div>");
            }
        } else {
            setSessionMessage("<div class='error'>No puedes borrar este grupo de ingredientes porque hay grupos que dependen de el.</div>");
        }
        redirect("grupoIngredientes.php?i=" . $idPlatillo);
    } else {
        goToIndex();
    }
}

function getIngredientesJSON() {
    $idGrupoIngredientes = $_GET['i'];
    require_once 'modulos/platillos/modelos/ingredienteModelo.php';
    $ingredientes = getIngredientesDeGrupo($idGrupoIngredientes);
    echo json_encode($ingredientes);
}

?>