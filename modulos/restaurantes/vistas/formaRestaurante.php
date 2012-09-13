<?php
require_once('layout/headers/headInicio.php');
require_once('layout/headers/headAutocompleteColonias.php');
require_once('layout/headers/headFin.php');
?>

<h2><?php echo $tipo; ?> restaurante</h2>
<?php
if (isset($error)) {
    echo '<h2 style="color: red">' . $error . '</h2>';
}
?>
<?php
if ($tipo == "editar") {
    ?>
    <h3><a href="restaurantes.php?a=establecerPassword&i=<?php echo $restaurante->idRestaurante; ?>">Establecer password</a></h3>
    <?php
}
?>

<form action="restaurantes.php?a=formaRestauranteSubmit&t=<?php echo $tipo; ?>" method="POST">
    <?php
    if ($tipo == "editar")
        echo '<input type="hidden" name="idRestaurante" value="' . $restaurante->idRestaurante . '">';
    ?>
    <ul>
        <li>
            <label>Nombre</label>
            <input type="text" name="nombre" value="<?php echo $restaurante->nombre; ?>">
        </li>
        <li>
            <label>Usuario</label>
            <input type="text" name="usuario" value="<?php echo $restaurante->usuario; ?>">
        </li>
        <?php
        if($tipo == "alta"){
        ?>
        <li>
            <label>Password</label>
            <input type="text" name="password">
        </li>
        <?php
        }
        ?>
        <li>
            <div class="ui-widget">
                <label>Colonia</label>
                <input id="colonias" name="colonia" value="<?php echo $colonia->nombre; ?>"/>       
                <input type="hidden" id="idColonia" name="idColonia" value="<?php echo $restaurante->idColonia; ?>">
            </div>
        </li>
        <li>
            <label>Descripción</label>
            <input type="text" name="descripcion" value="<?php echo $restaurante->descripcion; ?>">
        </li>        
        <li>
            <label>Pedido Mínimo</label>
            <input type="text" name="pedidoMinimo" value="<?php echo $restaurante->pedidoMinimo; ?>">
        </li>
        <li>
            <label>Tipo de gasto de envío:</label>
            <select name="tipoGasto">
                <option value="0" <?php if ($restaurante->tipoGastoEnvio == 0) echo 'selected="true"'; ?>>
                    <?php echo getTextoTipoGastoEnvio(0); ?>
                </option>
                <option value="1" <?php if ($restaurante->tipoGastoEnvio == 1) echo 'selected="true"'; ?>>
                    <?php echo getTextoTipoGastoEnvio(1); ?>
                </option>
                <option value="2" <?php if ($restaurante->tipoGastoEnvio == 2) echo 'selected="true"'; ?>>
                    <?php echo getTextoTipoGastoEnvio(2); ?>
                </option>
            </select>
        </li>
        <li>
            <label>Gasto de envío</label>
            <input type="text" name="gastoEnvio" value="<?php echo $restaurante->gastoEnvio; ?>">
        </li>
        <li>
            <label>Forma de pago</label>
            <select name="formaPago">
                <option value="0" <?php if ($restaurante->formaPago == 0) echo 'selected="true"'; ?>>
                    <?php echo getTextoFormaDePago(0); ?>
                </option>
                <option value="1" <?php if ($restaurante->formaPago == 1) echo 'selected="true"'; ?>>
                    <?php echo getTextoFormaDePago(1); ?>
                </option>
                <option value="2" <?php if ($restaurante->formaPago == 2) echo 'selected="true"'; ?>>
                    <?php echo getTextoFormaDePago(2); ?>
                </option>
            </select>
        </li>
        <li>
            <label>RFC</label>
            <input type="text" name="rfc"  value="<?php echo $restaurante->rfc; ?>">
        </li>
        <li>
            <label>Razón Social</label>
            <input type="text" name="razonSocial" value="<?php echo $restaurante->razonSocial; ?>">
        </li>
        <li>
            <label>Página web</label>
            <input type="text" name="paginaWeb" value="<?php echo $restaurante->paginaWeb; ?>">
        </li>
        <li>
            <label>Telefono</label>
            <input type="text" name="telefono" value="<?php echo $restaurante->telefono; ?>">
        </li>
        <li>
            <label>Email</label>
            <input type="text" name="email" value="<?php echo $restaurante->email; ?>">
        </li>
        <li>
            <label>Método de entrega</label>
            <select name="metodoEntrega">
                <option value="0" <?php if ($restaurante->metodoEntrega == 0) echo 'selected="true"'; ?>>
                    <?php echo getTextoMetodoEntrega(0); ?>
                </option>
                <option value="1" <?php if ($restaurante->metodoEntrega == 1) echo 'selected="true"'; ?>>
                    <?php echo getTextoMetodoEntrega(1); ?>
                </option>
                <option value="2" <?php if ($restaurante->metodoEntrega == 2) echo 'selected="true"'; ?>>
                    <?php echo getTextoMetodoEntrega(2); ?>
                </option>
            </select>
        </li>
        <li>
            <label>Calle</label>
            <input type="text" name="calle" value="<?php echo $restaurante->calle; ?>">
        </li>
        <li>
            <label>Número</label>
            <input type="text" name="numero" value="<?php echo $restaurante->numero; ?>">
        </li>
        <li>
            <label>Número interior</label>
            <input type="text" name="numeroInt" value="<?php echo $restaurante->numeroInt; ?>">
        </li>
        <li>
            <label>Referencia</label>
            <input type="text" name="referencia" value="<?php echo $restaurante->referencia; ?>">
        </li>
        <li>
            <label>Nombre de contacto:</label>
            <input type="text" name="nombreContacto" value="<?php echo $restaurante->nombreContacto; ?>">
        </li>
        <li>
            <label>Teléfono de contacto:</label>
            <input type="text" name="telefonoContacto" value="<?php echo $restaurante->telefonoContacto; ?>">
        </li>
        <li>
            <label>Tipo de comisión:</label>
            <select name="tipoComision">
                <option value="0" <?php if ($restaurante->tipoComision == 0) echo 'selected="true"'; ?>>
                    <?php echo getTextoTipoComision(0); ?>
                </option>
                <option value="1" <?php if ($restaurante->tipoComision == 1) echo 'selected="true"'; ?>>
                    <?php echo getTextoTipoComision(1); ?>
                </option>
                <option value="2" <?php if ($restaurante->tipoComision == 2) echo 'selected="true"'; ?>>
                    <?php echo getTextoTipoComision(2); ?>
                </option>
            </select>
        </li>
        <li>
            <label>Comisión</label>
            <input type="text" name="comision" value="<?php echo $restaurante->comision; ?>">
        </li>

        <li>
            <label>Restaurante habilitado:</label>
            <select name="habilitado">
                <option value="0" <?php if ($restaurante->habilitado == 0) echo 'selected="true"'; ?>>
                    <?php echo getTextoHabilitado(0); ?>
                </option>
                <option value="1" <?php if ($restaurante->habilitado == 1) echo 'selected="true"'; ?>>
                    <?php echo getTextoHabilitado(1); ?>
                </option>
            </select>
        </li>
        <li>
            <label></label>
            <input type="submit" value="  Aceptar  "/>
        </li>
    </ul>
</form>

<?php
$restauranteLoggeado = getRestauranteLoggeado();
if (isset($restauranteLoggeado)) {
    echo '<a href="adminRestaurante.php">Regresar</a>';
} else {
    echo '<a href="restaurantes.php">Regresar</a>';
}
?>

<?php
require_once('layout/footer.php');
?>