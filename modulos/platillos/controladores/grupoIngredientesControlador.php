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
    $platillo = getPlatillo($idPlatillo);
    require_once("modulos/platillos/modelos/grupoIngredientesModelo.php");
    $gruposIngredientes = getGruposIngredientesDePlatillo($idPlatillo);
    require_once 'modulos/platillos/vistas/mostrarGruposIngredientes.php';
}

function mostrar() {
    confirmBoxBaja();
    $idGrupoIngredientes = $_GET['i'];
    require_once 'modulos/platillos/clases/GrupoIngredientes.php';
    require_once 'modulos/platillos/modelos/grupoIngredientesModelo.php';
    $grupoIngredientes = getGrupoIngredientes($idGrupoIngredientes);
    $idPlatillo = $grupoIngredientes->idPlatillo;
    echo '<table border=1>';
    echo GrupoIngredientes::printGrupoIngredientesHeader();
    $grupoIngredientes->printGrupoIngredientes();
    echo '</table>';
    echo '<a href="grupoIngredientes.php?i=' . $idPlatillo . '">Regresar</a>';
}

function agregarGrupoIngredientes() {
    $idPlatillo = $_GET['p'];
    $tipo = "alta";
    require_once 'modulos/platillos/clases/GrupoIngredientes.php';
    require_once 'modulos/platillos/modelos/grupoIngredientesModelo.php';
    $gruposIngredientes = getGruposIngredientesDePlatillo($idPlatillo);
    $grupoIngredientes = new GrupoIngredientes();
    require_once 'modulos/platillos/vistas/formaGrupoIngredientes.php';
}

function formaGrupoIngredientesSubmit() {
    $tipo = $_GET['t'];
    require_once 'modulos/platillos/clases/GrupoIngredientes.php';
    $grupoIngredientes = new GrupoIngredientes();
    $idPlatillo = $_POST['idPlatillo'];
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
}

function modificar() {
    $tipo = "editar";
    $idGrupoIngredientes = $_GET['i'];
    require_once 'modulos/platillos/modelos/grupoIngredientesModelo.php';
    $idPlatillo = getIdPlatilloDeGrupoIngredientes($idGrupoIngredientes);
    $grupoIngredientes = getGrupoIngredientes($idGrupoIngredientes);
    $gruposIngredientes = getGruposIngredientesDePlatillo($idPlatillo);
    require_once 'modulos/platillos/vistas/formaGrupoIngredientes.php';
}

function borrar() {
    $idGrupoIngredientes = $_GET['i'];
    require_once 'modulos/platillos/modelos/grupoIngredientesModelo.php';
    $idPlatillo = getIdPlatilloDeGrupoIngredientes($idGrupoIngredientes);
    if (bajaGrupoIngredientes($idGrupoIngredientes)) {
        setSessionMessage("Se borró correctamente");
    } else {
        setSessionMessage("Ocurrió un error al borrar");
    }
    redirect("grupoIngredientes.php?i=" . $grupoIngredientes->idPlatillo);
}

function getIngredientesJSON() {
    $idGrupoIngredientes = $_GET['i'];
    require_once 'modulos/platillos/modelos/ingredienteModelo.php';
    $ingredientes = getIngredientesDeGrupo($idGrupoIngredientes);
    echo json_encode($ingredientes);
}

?>
