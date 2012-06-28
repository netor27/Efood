<?php
require_once('layout/headers/headInicio.php');
require_once('layout/headers/headFin.php');
?>
<h1>efood</h1>
<h2><?php echo $tipo; ?> Ingredientes</h2>
<?php
if (isset($error)) {
    echo '<h2 style="color: red">' . $error . '</h2>';
}
?>
<form action="ingredientes.php?a=formaGrupoIngredientesSubmit&t=<?php echo $tipo; ?>" method="POST">
    <?php
        echo '<input type="hidden" name="idGrupoIngredientes" value="' . $idGrupoIngredientes . '">';
        if ($tipo == "editar")
        echo '<input type="hidden" name="idIngrediente" value="' . $ingrediente->idIngrediente . '">';
    ?>
    <ul>
        <li>
            <label>Nombre</label>
            <input type="text" name="nombre" value="<?php echo $ingrediente->nombre; ?>">
        </li>
        <li>
            <label>Precio</label>
            <input type="text" name="precio" value="<?php echo $ingrediente->precio; ?>">
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