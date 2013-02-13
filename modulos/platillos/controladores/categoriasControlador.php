<?php

function principal() {
    confirmBoxBaja();
    $idRestaurante = $_GET['i'];
    if (validarAdministrador() || validarRestauranteLoggeadoId($idRestaurante)) {
        require_once 'modulos/restaurantes/modelos/RestauranteModelo.php';
        $restaurante = getRestaurante($idRestaurante);
        if (isset($restaurante)) {
            require_once 'modulos/platillos/modelos/CategoriaPlatilloModelo.php';
            $categorias = getCategoriasdeRestaurante($idRestaurante);
            require_once 'modulos/platillos/vistas/mostrarCategoriasPlatillo.php';
        } else {
            goToIndex();
        }
    } else {
        goToIndex();
    }
}

function alta() {
    $tipo = "alta";
    $idRestaurante = $_GET['r'];
    if (validarAdministrador() || validarRestauranteLoggeadoId($idRestaurante)) {
        require_once 'modulos/platillos/clases/CategoriaPlatillo.php';
        $categoriaPlatillo = new CategoriaPlatillo();
        require_once 'modulos/platillos/vistas/formaCategoriaPlatillo.php';
    } else {
        goToIndex();
    }
}

function modificar() {
    $tipo = "editar";
    $idRestaurante = $_GET['r'];
    $idCategoriaPlatillo = $_GET['i'];
    if (validarAdministrador() || validarRestauranteLoggeadoId($idRestaurante)) {
        require_once 'modulos/platillos/clases/CategoriaPlatillo.php';
        require_once 'modulos/platillos/modelos/CategoriaPlatilloModelo.php';
        $categoriaPlatillo = getCategoriaPlatillo($idCategoriaPlatillo);
        require_once 'modulos/platillos/vistas/formaCategoriaPlatillo.php';
    } else {
        goToIndex();
    }
}

function formaCategoriaSubmit() {
    $tipo = $_GET['t'];
    $idRestaurante = $_POST['idRestaurante'];
    if (validarAdministrador() || validarRestauranteLoggeadoId($idRestaurante)) {
        require_once 'modulos/platillos/clases/CategoriaPlatillo.php';
        require_once 'modulos/platillos/modelos/CategoriaPlatilloModelo.php';
        $categoriaPlatillo = new CategoriaPlatillo();
        $categoriaPlatillo->nombre = $_POST['nombre'];
        $categoriaPlatillo->descripcion = $_POST['descripcion'];
        $categoriaPlatillo->idRestaurante = $idRestaurante;
        if ($tipo == "alta") {
            $id = altaCategoriaPlatillo($categoriaPlatillo);
            if ($id >= 0) {
                setSessionMessage("Se dió de alta la categoría " . $categoriaPlatillo->nombre);
                redirect("platillos.php?c=categorias&i=" . $idRestaurante);
            } else {
                //error al dar de alta
                $error = "Ocurrió un error al dar de alta la categoría";
                require_once 'modulos/platillos/vistas/formaCategoriaPlatillo.php';
            }
        } else if ($tipo == "editar") {
            $categoriaPlatillo->idCategoriaPlatillo = $_POST['idCategoriaPlatillo'];
            if (modificaCategoriaPlatillo($categoriaPlatillo)) {
                setSessionMessage("Se modificó la categoría " . $categoriaPlatillo->nombre);
                redirect("platillos.php?c=categorias&i=" . $idRestaurante);
            } else {
                //error al dar de alta
                $error = "Ocurrió un error al modificar la categoría";
                require_once 'modulos/platillos/vistas/formaCategoriaPlatillo.php';
            }
        }
    }
}

function borrar() {
    $idRestaurante = $_GET['r'];
    if (validarAdministrador() || validarRestauranteLoggeadoId($idRestaurante)) {
        require_once 'modulos/platillos/modelos/CategoriaPlatilloModelo.php';
        $idCategoriaPlatillo = $_GET['i'];
        if (bajaCategoriaPlatillo($idCategoriaPlatillo) > 0) {
            setSessionMessage("Se eliminó correctamente la categoría ");
            redirect("platillos.php?c=categorias&i=" . $idRestaurante);
        } else {
            setSessionMessage("Ocurrió un error al eliminar la categoría");
            redirect("platillos.php?c=categorias&i=" . $idRestaurante);
        }
    }
}

function actualizarOrden(){
    $ids = $_POST['ids'];
    $idRestaurante = $_GET['r'];
    $bandera = true;
    foreach ($ids as $id){
        $idCategoriaPlatillo = $_POST['id'.$id];
        $orden = $_POST['orden'.$id];
        //echo 'Se establecera al id = ' . $idCategoriaPlatillo . ' el orden ' .$orden . '<br>';
        require_once 'modulos/platillos/modelos/CategoriaPlatilloModelo.php';
        if(modificaOrdenCategoriaPlatillo($idCategoriaPlatillo, $orden)){
            $bandera = true;
        }else{
            $bandera = false;
        }
    }
    if($bandera){
        setSessionMessage("Se actualizó correctamente el orden de las categorías");
    }else{
        setSessionMessage("Ocurrió un error al actualizar el orden de las categorías");
    }
    redirect("platillos.php?c=categorias&i=".$idRestaurante);
}
?>
