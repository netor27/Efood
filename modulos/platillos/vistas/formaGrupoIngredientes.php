<?php
require_once('layout/headers/headInicio.php');
require_once('layout/headers/headFormaGrupoIngredientes.php');
require_once('layout/headers/headFin.php');
?>

<h2><?php echo $tipo; ?> Grupo de ingredientes</h2>
<?php
if (isset($error)) {
    echo '<h2 style="color: red">' . $error . '</h2>';
}
?>
<form action="grupoIngredientes.php?a=formaGrupoIngredientesSubmit&t=<?php echo $tipo; ?>" method="POST">
    <?php
        echo '<input type="hidden" name="idPlatillo" value="' . $idPlatillo . '">';
        if ($tipo == "editar")
        echo '<input type="hidden" name="idGrupoIngredientes" value="' . $grupoIngredientes->idGrupoIngredientes . '">';
    ?>
    <ul>
        <li>
            <label>Nombre</label>
            <input type="text" name="nombre" value="<?php echo $grupoIngredientes->nombre; ?>">
        </li>
        <li>
            <label>Excluyente</label>
            <?php
            if($grupoIngredientes->excluyente == 1)
                echo '<input type="checkbox" name="excluyente" checked="true">';
            else
                echo '<input type="checkbox" name="excluyente">';
            ?>
            
        </li>
        <li>
            <label>Requerido</label>            
            <?php
            if($grupoIngredientes->requerido == 1)
                echo '<input type="checkbox" name="requerido" checked="true">';
            else
                echo '<input type="checkbox" name="requerido">';
            ?>
        </li>        
        <li>
            <label>Depende de grupo de ingredientes:</label>
            <select id="grupoIngrediente" name="depende">
                <option value="-1">Ninguno</option>
                <?php
                foreach($gruposIngredientes as $grupo){
                    if($grupo->idGrupoIngredientes == $grupoIngredientes->idGrupoDepende){
                    echo '<option value="' . $grupo->idGrupoIngredientes . '" selected="true">' . $grupo->nombre . '</option>';
                    }else{
                        echo '<option value="' . $grupo->idGrupoIngredientes . '">' . $grupo->nombre . '</option>';
                    }
                }
                ?>
            </select>
        </li>
        
        <li>
            <label>Depende de platillo:</label>
            <input type="hidden" id="ing" name="ing" value="<?php echo $grupoIngredientes->idIngredienteDepende; ?>">
            <select id="ingrediente" name="IngredienteDepende">
                
            </select>
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