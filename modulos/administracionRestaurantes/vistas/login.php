<?php
require_once('layout/headers/headInicio.php');
require_once('layout/headers/headFin.php');
?>
<div class="row-fluid"><div class="span8"></div></div>
<div class="row-fluid"><div class="span8"></div></div>
<div class="row-fluid">
    <div class="span6 offset3">
        <legend>Administrador para Restaurantes</legend>        
    </div>
</div>
<div class="row-fluid">
    <div class="span6 offset4">

        <form method="post" action="adminRestaurante.php?a=login">
            <h2>Nombre de usuario</h2>
            <input type="text" name="usuario">
            <h2>Password</h2>
            <input type="password" name="pass">
            <br><br>
            <input type="submit" name="Aceptar" value="  Aceptar  ">
            <?php
            if (isset($pagina)) {
                echo '<input type="hidden" name="pagina" value="' . $pagina . '"/>';
            }
            ?>
        </form>
    </div>
</div>
<?php
require_once('layout/footer.php');
?>