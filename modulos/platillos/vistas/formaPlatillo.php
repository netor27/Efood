<?php
require_once('layout/headers/headInicio.php');
require_once('layout/headers/headFin.php');
?>
<div class="row-fluid"><div class="span8 offset2"></div></div>
<div class="row-fluid"><div class="span8 offset2"></div></div>
<div class="row-fluid">
    <div class="span8 offset2">
        <?php
        switch ($tipo) {
            case "alta":
                echo "<h2>Agregar un platillo</h2>";
                break;
            case "editar":
                echo "<h2>Editar platillo</h2>";
                break;
        }
        ?>
    </div>
</div>
<?php
if (isset($error)) {
    echo '<h2 style="color: red">' . $error . '</h2>';
}
?>
<div class="row-fluid">
    <div class="span8 offset2">
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
                    <label>Categoría</label>
                    <input type="text" name="categoria" value="<?php echo $platillo->categoria; ?>">
                </li>
                <li>
                    <label>Descripción</label>  
                    <textarea name="descripcion" class="span8" rows="5"><?php echo $platillo->descripcion; ?></textarea>
                </li>        
                <li>
                    <label>Precio Base</label>
                    <input type="text" name="precioBase" value="<?php echo $platillo->precioBase; ?>">
                </li>
                <li>
                    <label>Hint</label><br>
                    <textarea name="hint" class="span8"  rows="5"><?php echo $platillo->hint; ?></textarea>
                </li>

                <li>
                    <label></label>
                    <input type="submit" value="  Aceptar  "/>
                </li>
            </ul>
        </form>
    </div>
</div>
<?php
require_once('layout/footer.php');
?>