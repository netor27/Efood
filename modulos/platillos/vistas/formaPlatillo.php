<?php
require_once('layout/headers/headInicio.php');
require_once('layout/headers/headAutocompleteCategorias.php');
require_once('layout/headers/headFin.php');
?>
<h1>efood</h1>
<h2><?php echo $tipo; ?> platillo</h2>
<?php
if (isset($error)) {
    echo '<h2 style="color: red">' . $error . '</h2>';
}
?>
<form action="platillos.php?a=formaPlatilloSubmit&t=<?php echo $tipo; ?>" method="POST">
    <?php
    echo '<input type="hidden" name="idRestaurante" value="' . $idRestaurante . '">';
    if ($tipo == "editar")
        echo '<input type="hidden" name="idPlatillo" value="' . $platillo->idPlatillo . '">';
    ?>
    <ul>
        <li>
            <label>Nombre</label>
            <input type="text" name="nombre" value="<?php echo $platillo->nombre; ?>">
        </li>
        <li>
            <div class="ui-widget">
                <label>Categor&iacute;a</label>
                <input id="categorias" name="categoria" value="<?php echo $categoria->nombre; ?>"/>       
                <input type="hidden" id="idCategoria" name="idCategoria" value="<?php echo $platillo->idCategoria; ?>">
            </div>
        </li>
        <li>
            <label>Descripción</label>
            <input type="text" name="descripcion" value="<?php echo $platillo->descripcion; ?>">
        </li>        
        <li>
            <label>Precio Base</label>
            <input type="text" name="precioBase" value="<?php echo $platillo->precioBase; ?>">
        </li>
        <li>
            <label>Hint</label><br>
            <textarea name="hint" cols="50" rows="10"><?php echo $platillo->hint; ?></textarea>
        </li>

        <li>
            <label></label>
            <input type="submit" value="  Aceptar  "/>
        </li>
    </ul>
</form>

<?php
require_once('layout/footer.php');
?>