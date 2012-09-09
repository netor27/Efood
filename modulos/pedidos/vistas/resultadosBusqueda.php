<?php
require_once('layout/headers/headInicio.php');
require_once('layout/headers/headResultadosBusqueda.php');
require_once('layout/headers/headFin.php');
?>

<div id="buscadorContainer">
    <form>
        <input type="text"/>
        <div>
            <select class="select" title="Tipo de comida">
                <option></option>
                <?php
                foreach ($tiposDeComida as $tipo) {
                    echo '<option value="'.$tipo->idTipoComida.'">'.$tipo->nombre.'</option>';
                }
                ?>
            </select>
        </div>
        <div>
            <select class="select"  title="Tipo de entrega">
                <option></option>
                <option>A domicilio</option>
                <option>Pasar a recoger</option>                
                <option>Ambos</option>
            </select>
        </div>
        <input type="submit">
    </form>
</div>

<br><br>
<br><br>
<br><br>
<br><br>

<?php
echo "<table border=1>";
foreach ($restaurantes as $restaurante)
    $restaurante->printRestaurantePedido();
echo "</table>";
?>

<?php
require_once('layout/footer.php');
?>