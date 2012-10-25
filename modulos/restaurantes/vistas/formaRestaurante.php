<?php
require_once('layout/headers/headInicio.php');
require_once('layout/headers/headAutocompleteColonias.php');
require_once('layout/headers/headFin.php');
?>

<div class="row-fluid"><div class="span12"></div></div>
<div class="row-fluid"><div class="span12"></div></div>
<div class="row-fluid">
    <div class="span6 offset4">
        <?php
        if ($tipo == "alta") {
            echo '<h2> Agregar un restaurante</h2>';
        } else {
            echo '<h2> Editar restaurante</h2>';
        }
        ?>        
    </div>    
</div>
<div class="row-fluid">
    <div class="span6 offset2">
        <?php
        if (isset($error)) {
            echo '<h2 style="color: red">' . $error . '</h2>';
        }
        ?>
    </div>
</div>
<form action="restaurantes.php?a=formaRestauranteSubmit&t=<?php echo $tipo; ?>" method="POST" class="form-horizontal">
    <div class="row-fluid">
        <div class="span6">
            <legend class="span11 offset1">Datos del restaurante</legend>
            <?php
            if ($tipo == "editar")
                echo '<input type="hidden" name="idRestaurante" value="' . $restaurante->idRestaurante . '">';
            ?>
            <div class="control-group">
                <label class="control-label">Nombre</label>
                <div class="controls">
                    <input class="span12" type="text" name="nombre" value="<?php echo $restaurante->nombre; ?>">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Descripción</label>
                <div class="controls">
                    <input class="span12" type="text" name="descripcion" value="<?php echo $restaurante->descripcion; ?>">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Información</label>
                <div class="controls">
                    <textarea name="informacion" rows="5" class="span12"><?php echo $restaurante->informacion; ?></textarea> 
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Razón Social</label>
                <div class="controls">
                    <input class="span12" type="text" name="razonSocial" value="<?php echo $restaurante->razonSocial; ?>">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">RFC</label>
                <div class="controls">
                    <input class="span12" type="text" name="rfc"  value="<?php echo $restaurante->rfc; ?>">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Página web</label>
                <div class="controls">
                    <input class="span12" type="text" name="paginaWeb" value="<?php echo $restaurante->paginaWeb; ?>">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Telefono</label>
                <div class="controls">
                    <input class="span12" type="text" name="telefono" value="<?php echo $restaurante->telefono; ?>">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Email</label>
                <div class="controls">
                    <input class="span12" type="text" name="email" value="<?php echo $restaurante->email; ?>">
                </div>
            </div>


            <legend  class="span11 offset1">Ubicación del restaurante</legend>
            <div class="control-group">
                <label class="control-label">Calle</label>
                <div class="controls">
                    <input class="span12" type="text" name="calle" value="<?php echo $restaurante->calle; ?>">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Número</label>
                <div class="controls">
                    <input class="span12" type="text" name="numero" value="<?php echo $restaurante->numero; ?>">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Número interior</label>
                <div class="controls">
                    <input class="span12" type="text" name="numeroInt" value="<?php echo $restaurante->numeroInt; ?>">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Colonia</label>
                <div class="controls">
                    <div class="ui-widget">
                        <input class="span12" id="colonias" name="colonia" value="<?php echo $colonia->nombre; ?>"/>       
                        <input type="hidden" id="idColonia" name="idColonia" value="<?php echo $restaurante->idColonia; ?>">
                    </div>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Referencia</label>
                <div class="controls">
                    <input class="span12" type="text" name="referencia" value="<?php echo $restaurante->referencia; ?>">
                </div>
            </div>
        </div>    

        <div class="span6">
            <legend class="span11 offset1">Datos de usuario</legend>
            <div class="control-group">
                <label class="control-label">Usuario</label>
                <div class="controls">
                    <input class="span11" type="text" name="usuario" value="<?php echo $restaurante->usuario; ?>">
                </div>
            </div>
            <?php
            if ($tipo == "editar") {
                ?>
                <div class="control-group">
                    <label class="control-label">Password</label>
                    <div class="controls">
                        <h3>
                            <a href="restaurantes.php?a=establecerPassword&i=<?php echo $restaurante->idRestaurante; ?>">
                                Cambiar password
                            </a>
                        </h3>
                    </div>
                </div>
                <?php
            }
            ?>
            <?php
            if ($tipo == "alta") {
                ?>
                <div class="control-group">
                    <label class="control-label">Password</label>
                    <div class="controls">
                        <input class="span11" type="text" name="password">
                    </div>
                </div>
                <?php
            }
            ?>
            <div class="control-group">
                <label class="control-label">Nombre de contacto:</label>
                <div class="controls">
                    <input class="span11" type="text" name="nombreContacto" value="<?php echo $restaurante->nombreContacto; ?>">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Teléfono de contacto:</label>
                <div class="controls">
                    <input class="span11" type="text" name="telefonoContacto" value="<?php echo $restaurante->telefonoContacto; ?>">
                </div>
            </div>

            <legend class="span10 offset1">Datos de entrega</legend>
            <div class="control-group">
                <label class="control-label">Forma de pago</label>
                <div class="controls">
                    <select class="span11" name="formaPago">
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
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Método de entrega</label>
                <div class="controls">
                    <select class="span11" name="metodoEntrega">
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
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Pedido Mínimo a domicilio</label>
                <div class="controls">
                    <input class="span11" type="text" name="pedidoMinimo" value="<?php echo $restaurante->pedidoMinimo; ?>">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Tipo de gasto de envío:</label>
                <div class="controls">
                    <select  class="span11" name="tipoGasto">
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
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Gasto de envío</label>
                <div class="controls">
                    <input class="span11" type="text" name="gastoEnvio" value="<?php echo $restaurante->gastoEnvio; ?>">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Tipo de comisión:</label>
                <div class="controls">
                    <select class="span11" name="tipoComision">
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
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Comisión</label>
                <div class="controls">
                    <input class="span11" type="text" name="comision" value="<?php echo $restaurante->comision; ?>">
                </div>
            </div>

            <legend class="span10 offset1">Estado del restaurante</legend>
            <div class="control-group">
                <label class="control-label">Restaurante habilitado:</label>
                <div class="controls">
                    <select class="span11" name="habilitado">
                        <option value="0" <?php if ($restaurante->habilitado == 0) echo 'selected="true"'; ?>>
                            <?php echo getTextoHabilitado(0); ?>
                        </option>
                        <option value="1" <?php if ($restaurante->habilitado == 1) echo 'selected="true"'; ?>>
                            <?php echo getTextoHabilitado(1); ?>
                        </option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span4 offset4">
            <input class="span12" type="submit" value="  Aceptar  "/>
        </div>
    </div>


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