<?php
require_once('layout/headers/headInicio.php');
require_once('layout/headers/headFin.php');
?>
<div class="row-fluid"><div class="span12"></div></div>
<div class="row-fluid"><div class="span12"></div></div>
<h2>Alta restaurante</h2>
<form action="restaurantes.php?a=altaSubmit" method="POST">
    <ul>
        <li>
            <label>Nombre</label>
            <input type="text" name="nombre">
        </li>
        <li>
            <label>Usuario</label>
            <input type="text" name="usuario">
        </li>
        <li>
            <label>Password</label>
            <input type="text" name="password">
        </li>
        <li>
            <label>Colonia</label>
            <select name="idColonia">
                <?php
                if (isset($colonias)) {
                    foreach ($colonias as $colonia) {
                        echo '<option value="' . $colonia->idColonia . '">' . $colonia->nombre . '</option>';
                    }
                }
                ?>
            </select>
        </li>
        <li>
            <label>Descripción</label>
            <input type="text" name="descripcion">
        </li>
        <li>
            <label>Logo</label>
            <input type="text" name="logo">
        </li>
        <li>
            <label>Pedido Mínimo</label>
            <input type="text" name="pedidoMinimo">
        </li>
        <li>
            <label>Gasto de envío</label>
            <input type="text" name="gastoEnvio">
        </li>
        <li>
            <label>Forma de pago</label>
            <select name="formaPago">
                <option value="0">Sólo efectivo</option>
                <option value="1">Tarjeta</option>
                <option value="2">Ambos</option>
            </select>
        </li>
        <li>
            <label>RFC</label>
            <input type="text" name="rfc">
        </li>
        <li>
            <label>Razón Social</label>
            <input type="text" name="razonSocial">
        </li>
        <li>
            <label>Página web</label>
            <input type="text" name="paginaWeb">
        </li>
        <li>
            <label>Telefono</label>
            <input type="text" name="telefono">
        </li>
        <li>
            <label>Email</label>
            <input type="text" name="email">
        </li>
        <li>
            <label>Método de entrega</label>
            <select name="metodoEntrega">
                <option value="0">Recojer</option>
                <option value="1">Enviar</option>
                <option value="2">Ambos</option>
            </select>
        </li>
        <li>
            <label>Calle</label>
            <input type="text" name="calle">
        </li>
        <li>
            <label>Número</label>
            <input type="text" name="numero">
        </li>
        <li>
            <label>Número interior</label>
            <input type="text" name="numeroInt">
        </li>
        <li>
            <label>Referencia</label>
            <input type="text" name="referencia">
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