<?php
require_once('layout/headers/headInicio.php');
require_once('layout/headers/headAutocompleteColonias.php');
require_once('layout/headers/headFin.php');
?>
<div class="row-fluid"><div class="span12"></div></div>
<div class="row-fluid"><div class="span12"></div></div>
<?php
if (isset($mensaje)) {
    echo $mensaje;
} else {
    echo "<h1>" . $user->email . "</h1><br><a href='usuarios.php'>Regresar</a>";
    ?>
    <form action="usuarios.php?a=modificacionSubmit" method="POST">
        Tel&eacute;fono:<input type="text" name="tel" id="tel" value="<?php echo $user->telefono ?>"/><br>
        <input type="submit" value="Modificar" />
    </form>
    <table border="1">
        <?php
        require_once 'modulos/usuarios/clases/Direccion.php';
        Direccion::printHeader();
        if (isset($direcciones)) {
            foreach ($direcciones as $direccion) {
                $direccion->printDireccion();
            }
        }
        ?>
    </table>
    <form action="usuarios.php?a=agregarDireccionSubmit" method="POST">
        <ul>
            <li>
                <div class="ui-widget">
                    <label>Colonia</label>
                    <input id="colonias" name="colonia"/>
                    <input type="hidden" id="idColonia" name="idColonia">
                </div>
            </li>
            <li>
                <label>Calle</label>
                <input type="text" name="calle" id="calle" /><br>
            </li>
            <li>
                <label>N&uacute;mero</label>
                <input type="text" name="numero" id="numero" /><br>
            </li>
            <li>
                <label>N&uacute;mero interior</label>
                <input type="text" name="numeroInt" id="numeroInt" /><br>
            </li>
            <li>
                <label>Referencia</label>
                <input type="text" name="referencia" id="referencia" /><br>
            </li>
            <li>
                <label></label>
                <input type="submit" value="Agregar" />
            </li>
    </form>
    <?php
}
require_once('layout/footer.php');
?>
