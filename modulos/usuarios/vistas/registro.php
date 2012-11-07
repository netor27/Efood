<?php
require_once('layout/headers/headInicio.php');
require_once('layout/headers/headAutocompleteColonias.php');
require_once('layout/headers/headFin.php');
?>
<br>
<br>
<br>
<br>
<div>
    <form action="usuarios.php?a=altaSubmit" method="post">
        <input type="hidden" name="terminos" value="1">
        <input type="hidden" name="pagina" value="/usuarios">
        <div class="row-fluid">
            <label class="span2 offset1">Correo electrónico:</label>
            <input class="span4" type="text" name="email" id="usuario" />
        </div>
        <div class="row-fluid">
            <label class="span2 offset1">Contraseña:</label>
            <input class="span4" type="password" name="password" id="password"/>
        </div>
        <div class="row-fluid">
            <label class="span2 offset1">Confirma contraseña:</label>
            <input class="span4" type="password" name="passwordr" id="password"/>
        </div>
        <div class="row-fluid">
            <div class="span5 offset5">
                <input type="submit" value=" Aceptar "/>
            </div>
        </div>
        <input type="hidden" name="pagina" value="<?php echo $pagina; ?>">
    </form>
</div>
<div>
    <a class="offset1" href="usuarios">Regresar</a>
</div>
<?php
require_once('layout/footer.php');
?>
