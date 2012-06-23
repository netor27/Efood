<?php

/**
 * Description of ingredientesControlador
 *
 * @author neto
 */
function principal(){
    confirmBoxBaja();
    $idGrupoIngredientes = $_GET['i'];
    require_once 'modulos/platillos/modelos/grupoIngredientesModelo.php';
    $grupoIngredientes = getGrupoIngredientes($idGrupoIngredientes);
    require_once 'modulos/platillos/modelos/ingredienteModelo.php';
    $ingredientes = getIngredientesDeGrupo($idGrupoIngredientes);
    require_once 'modulos/platillos/vistas/mostrarIngredientes.php';
}

function agregarIngrediente() {
    $idGrupoIngredientes = $_GET['g'];
    $tipo = "alta";
    require_once 'modulos/platillos/clases/Ingrediente.php';
    $ingrediente = new Ingrediente();
    require_once 'modulos/platillos/vistas/formaIngrediente.php';
}

function formaGrupoIngredientesSubmit() {
    $tipo = $_GET['t'];
    require_once 'modulos/platillos/clases/Ingrediente.php';
    $ingrediente = new Ingrediente();
    $idGrupoIngredienteso = $_POST['idGrupoIngredientes'];
    
    $ingrediente->idGrupoIngredientes = $idGrupoIngredienteso;
    $ingrediente->nombre = $_POST['nombre'];
    $ingrediente->precio = $_POST['precio'];
    
    require_once 'modulos/platillos/modelos/ingredienteModelo.php';
    if ($tipo == "alta") {
        $ingrediente->idIngrediente = altaIngrediente($ingrediente);
        if ($ingrediente->idIngrediente >= 0) {
            setSessionMessage("Se dió de alta el ingrediente " . $ingrediente->nombre);
            redirect("ingredientes.php?i=" . $ingrediente->idGrupoIngredientes );
        } else {
            $tipo = "alta";
            $error = "Ocurrió un error al dar de alta el ingrediente";
            require_once 'modulos/platillos/vistas/formaPlatillo.php';
        }
    } else if ($tipo == "editar") {
        $ingrediente->idIngrediente = $_POST['idIngrediente'];
        if (modificaIngrediente($ingrediente)) {
            setSessionMessage("Se modificó el ingrediente " . $ingrediente->nombre);
        } else {
            $tipo = "editar";
            $error = "Ocurrió un error al modificar el ingrediente";
            require_once 'modulos/platillos/vistas/formaPlatillo.php';
        }
    }
    redirect("ingredientes.php?i=" . $ingrediente->idGrupoIngredientes );
}

function modificar() {
    $tipo = "editar";
    $idIngrediente = $_GET['i'];
    require_once 'modulos/platillos/modelos/ingredienteModelo.php';
    $idGrupoIngredientes = getIdGrupoIngredientesDeIngrediente($idIngrediente);
    $ingrediente = getIngrediente($idIngrediente);
    require_once 'modulos/platillos/vistas/formaIngrediente.php';
}

function borrar() {
    $idIngrediente = $_GET['i'];
    require_once 'modulos/platillos/modelos/ingredienteModelo.php';
    $idGrupoIngredientes = getIdGrupoIngredientesDeIngrediente($idIngrediente);
    if (bajaIngrediente($idIngrediente)) {
        setSessionMessage("Se borró el ingrediente correctamente");
    } else {
        setSessionMessage("Ocurrió un error al borrar");
    }
    redirect("ingredientes.php?i=" . $idGrupoIngredientes );
}

function mostrar(){
    require_once 'modulos/platillos/modelos/ingredienteModelo.php';
    $idIngrediente = $_GET['i'];
    $ingrediente = getIngrediente($idIngrediente);
    echo '<table border=1>';
    Ingrediente::printIngredienteHeader();
    $ingrediente->printIngrediente();
    echo '</table>';
}
?>
