<?php
require_once('layout/headers/headInicio.php');
require_once('layout/headers/headResultadosBusqueda.php');
require_once('layout/headers/headAutocompleteColonias.php');
require_once('layout/headers/headFin.php');
?>

<div id="buscadorContainer">
    <form method="post" action="pedidos.php?a=buscarRestaurante">
        <div class="formElement">
            <input id="colonias" class="ui-corner-all textoBlanco" type="text" placeholder="¡Escribe tu colonia!"/>
            <input type="hidden" id="idColonia" name="idColonia">
        </div>
        <div class="formElement">
            <select class="selectBlanco" title="Tipo de comida" name="idTipoComida">
                <option value=""></option>
                <?php
                foreach ($tiposDeComida as $tipo) {
                    echo '<option value="' . $tipo->idTipoComida . '">' . $tipo->nombre . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="formElement">
            <select class="selectBlanco"  title="Tipo de entrega" name="idMetodoEntrega">
                <option></option>
                <option value="0">Pasar a recoger</option>                
                <option value="1">A domicilio</option>                
                <option value="2">Ambos</option>
            </select>
        </div>
        <div class="formElement">
            <input type="image" src="/layout/imagenes/resultadosBusqueda/btnBuscar_190x40.png">
        </div>
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