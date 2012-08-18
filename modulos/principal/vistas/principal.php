<?php
require_once('layout/headers/headInicio.php');
require_once('layout/headers/headAutocompleteColonias.php');
require_once('layout/headers/headAutocompleteRestaurantes.php');
require_once('layout/headers/headFin.php');
require_once 'modulos/colonias/modelos/ColoniaModelo.php';
$colonias = getColonias();
require_once 'modulos/colonias/clases/Colonia.php';
$colonia = new Colonia();
?>

<?php
if (isset($_SESSION['tipo']) && $_SESSION['tipo'] == 1) {
    echo 'Eres administrador';
    ?>
    
    <h2><a href="usuarios.php"> Administración de usuarios</a></h2>
    <h2><a href="restaurantes.php"> Administración de restaurantes</a></h2>
    <?php
}
?>
<?php
require_once('modulos/principal/vistas/buscador.html');
?>
<br><br><br>
<h2><a href="adminRestaurante.php">Login de restaurantes</a></h2>
<?php
require_once('layout/footer.php');
?>