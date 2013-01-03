<?php
require_once('layout/headers/headInicio.php');
require_once('layout/headers/headFin.php');
?>

<h2><?php echo $tipo; ?> categoría platillo</h2>
<?php
if (isset($error)) {
    echo '<h2 style="color: red">' . $error . '</h2>';
}
?>
<form action="platillos.php?c=categorias&a=formaCategoriaSubmit&t=<?php echo $tipo; ?>" method="POST">
    <?php
        echo '<input type="hidden" name="idRestaurante" value="' . $idRestaurante . '">';
        if ($tipo == "editar")
        echo '<input type="hidden" name="idCategoriaPlatillo" value="' . $categoriaPlatillo->idCategoriaPlatillo . '">';
    ?>
    <ul>
        <li>
            <label>Nombre</label>
            <input type="text" name="nombre" value="<?php echo $categoriaPlatillo->nombre; ?>">
        </li>
        <li>
            <label>Descripción</label>
            <input type="text" name="descripcion" value="<?php echo $categoriaPlatillo->descripcion; ?>">
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