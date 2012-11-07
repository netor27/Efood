<?php
require_once('layout/headers/headInicio.php');
require_once('layout/headers/headFin.php');
?>
<h1>efood</h1>
<h2>Todos los usuarios</h2>
<h4><a href="usuarios.php?a=alta">Agregar usuario</a></h4>
<h4><a href="usuarios.php?a=modificacion">Editar usuario</a></h4>
<table border="1">
    <?php
    require_once 'modulos/usuarios/clases/Usuario.php';
    Usuario::printHeader();
    if (isset($usuarios)) {
        foreach ($usuarios as $usuario) {
            $usuario->printUsuario();
        }
    }
    ?>
</table>
<br><a href="index.php">Regresar</a>
<br><br>
<?php
require_once('layout/footer.php');
?>
