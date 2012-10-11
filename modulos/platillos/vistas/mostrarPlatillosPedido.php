<?php
require_once('layout/headers/headInicio.php');
require_once('layout/headers/headSuperbox.php');
require_once('layout/headers/headBlockUI.php');
require_once('layout/headers/headValidate.php');
require_once('layout/headers/headPedidos.php');
require_once('layout/headers/headAutocompleteColonias.php');
require_once('layout/headers/headFin.php');
?>

<div id="buscadorContainer">
    <form method="post" action="pedidos.php?a=buscarRestaurante">
        <div class="formElement">
            <input id="colonias" class="ui-corner-all textoBlanco" type="text" placeholder="¡Escribe tu colonia!" value="<?php echo $colonia->nombre; ?>"/>
            <input type="hidden" id="idColonia" name="idColonia" value="<?php echo $colonia->idColonia; ?>">
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
            <input type="image" src="layout/imagenes/resultadosBusqueda/btnBuscar_190x40.png">
        </div>
    </form>
</div>

<?php
$aux = "";
if (isset($restaurante->tiposComida)) {
    foreach ($restaurante->tiposComida as $tipoComida) {
        $aux = $aux . " tipoComida" . $tipoComida->idTipoComida;
    }
}
$aux = $aux . " tipoEntrega" . $restaurante->metodoEntrega;
?>
<div class="restaurante ui-corner-all <?php echo $aux; ?>">
    <div class="restauranteHeader">
        <div class="titulo">
            <?php echo $restaurante->nombre; ?>
        </div>
        <div class="tiposComida">
            <?php
            $bandera = true;
            if (isset($restaurante->tiposComida)) {
                foreach ($restaurante->tiposComida as $tipoComida) {
                    if ($bandera) {
                        echo $tipoComida->nombre;
                        $bandera = false;
                    } else {
                        echo " / " . $tipoComida->nombre;
                    }
                }
            }
            ?>
        </div>
    </div>
    <div class="restauranteBody">
        <div class="logoRestaurante">
            <img src="<?php echo $restaurante->logo; ?>"/>
        </div>
        <div class="separadorLogo">
        </div>
        <div class="contenidoRestaurante">
            <div class="left datosRestaurante">
                <div class="horario">
                    <img src="layout/imagenes/resultadosBusqueda/reloj_20x20.png"/>
                    <?php
                    $inicio = "";
                    $fin = "";
                    switch (getDay()) {
                        case "lu": $inicio = $restaurante->horario->luIni;
                            $fin = $restaurante->horario->luFin;
                            break;
                        case "ma": $inicio = $restaurante->horario->maIni;
                            $fin = $restaurante->horario->maFin;
                            break;
                        case "mi": $inicio = $restaurante->horario->miIni;
                            $fin = $restaurante->horario->miFin;
                            break;
                        case "ju": $inicio = $restaurante->horario->juIni;
                            $fin = $restaurante->horario->juFin;
                            break;
                        case "vi": $inicio = $restaurante->horario->viIni;
                            $fin = $restaurante->horario->viFin;
                            break;
                        case "sa": $inicio = $restaurante->horario->saIni;
                            $fin = $restaurante->horario->saFin;
                            break;
                        case "do": $inicio = $restaurante->horario->doIni;
                            $fin = $restaurante->horario->doFin;
                            break;
                    }
                    $inicio = quitarSegundosHora($inicio);
                    $fin = quitarSegundosHora($fin);
                    if ($inicio == "00:00" && $fin == "23:59") {
                        echo "<span>Abierto todo el día</span>";
                    } else if ($inicio == "00:00" && $fin == "00:00") {
                        echo "<span>Cerrado</span>";
                    } else {
                        echo "<span>De " . $inicio . " a " . $fin . " hrs.</span>";
                    }
                    ?>

                </div>
                <div class="datos">
                    <span class="datosRed">Pedido mínimo</span>
                    <span>$ <?php echo $restaurante->pedidoMinimo; ?></span>


                    <?php
                    switch ($restaurante->tipoGastoEnvio) {
                        case 0:
                            //monto fijo
                            echo '<span class="datosRed">Gastos de Envío:</span>';
                            echo "<span>$ " . $restaurante->gastoEnvio . "</span>";
                            break;
                        case 1:
                            //porcentaje
                            echo '<span class="datosRed">Gastos de Envío:</span>';
                            echo "<span> " . $restaurante->gastoEnvio . " %</span>";
                            break;
                        case 2:
                            //compuesto
                            //echo '<br><span class="datosRed">Gastos de Envío:</span>';
                            //echo "<span> ".$restaurante->gastoEnvio ."</span>";
                            echo '<span class="datosRed">Gastos de Envío:</span>';
                            echo "<span>Compuesto</span>";
                            break;
                    }
                    ?>
                </div>
                <div class="tipoPago">
                    <?php
                    if ($restaurante->formaPago == 0) {
                        echo 'efectivo';
                    }
                    if ($restaurante->formaPago == 1) {
                        echo '<img src="layout/imagenes/resultadosBusqueda/tipoPagos_190x20.png"/>';
                    }
                    if ($restaurante->formaPago == 2) {
                        echo 'efectivo';
                        echo '<img src="layout/imagenes/resultadosBusqueda/tipoPagos_190x20.png"/>';
                    }
                    ?>

                </div>
            </div>
            <div class="left metodoEntrega">
                <?php
                if ($restaurante->metodoEntrega == 1) {
                    echo '<img src="layout/imagenes/Home/img_Domicilio_86x39.png"/>';
                }
                if ($restaurante->metodoEntrega == 0) {
                    echo '<img src="layout/imagenes/Home/img_Recoger_64x40.png"/>';
                }
                if ($restaurante->metodoEntrega == 2) {
                    echo '<img src="layout/imagenes/Home/img_Domicilio_86x39.png"/>';
                    echo '<img src="layout/imagenes/Home/img_Recoger_64x40.png"/>';
                }
                ?>


            </div>
        </div>
    </div>
</div>

<h2>Platillos del restaurante <?php echo $restaurante->nombre; ?></h2>
<?php
echo "Pedido M&iacute;nimo: $" . $restaurante->pedidoMinimo;
$_SESSION['pedidoMinimo'] = $restaurante->pedidoMinimo;
//echo "<br>Gasto de Env&iacute;o: " . $restaurante->gastoEnvio;
$_SESSION['gastoEnvio'] = $restaurante->gastoEnvio;
$gastoEnvio = $restaurante->gastoEnvio;
$_SESSION['tipoGastoEnvio'] = $restaurante->tipoGastoEnvio;
?>
<table border="1">
    <?php
    require_once 'modulos/platillos/clases/Platillo.php';
    Platillo::printPlatilloPedidoHeader();
    if (isset($platillos)) {
        if ($habilitado) {
            foreach ($platillos as $platillo) {
                $platillo->printPlatilloPedido();
            }
        } else {
            foreach ($platillos as $platillo) {
                $platillo->printPlatilloPedidoDeshabilitado();
            }
        }
    }
    ?>
</table>
<a href="pedidos.php?a=buscarRestauranteHome">Regresar</a>

<div id="headPedido">

</div>
<div id="pedidos" name="pedidos">
    <?php
    $pedidos = obtenPedidos();
    $total = 0;
    if (isset($pedidos)) {
        foreach ($pedidos as $key => $value) {
            foreach ($value as $clave => $valor) {
                foreach ($valor as $clv => $val) {
                    echo '<div id="' . $clv . '">';
                    echo $val[1] . " "; //cantidad
                    echo $val[0] . " "; //nombre
                    //echo $val[2]; //especificaciones
                    echo $val[3] . " "; //total
                    //echo '<div id="des'.$clv.'';
                    echo '<a href="pedidos.php?a=eliminarDelPedido&ir=' . $restaurante->idRestaurante . '&pc=' . $key . '">Eliminar</a>';
                    echo "</div>";
                    $total+=$val[3];
                }
            }
        }

        //echo "<br><div class='popuppedir' id='".$restaurante->idRestaurante."'><a href='pedidos.php?a=pedir&i=".$restaurante->idRestaurante."'>Pedir</a></div>";            
    }
    ?>
</div>
<div id="agregados">
</div>
<div id="pedidosgenera">
    <?php
    if (isset($pedidos) && $pedidos != array())
        echo "<br><div id='totalw' style='float:left;'>Subtotal: $</div> <div id='totalc' style='float:left;'>" . $total . "</div><br>";
    ?>
</div>
<div id="botonpedir">
    <?php
    if (isset($pedidos) && $pedidos != array()) {
        ?>
        A domicilio: <?php
    if ($_SESSION['tipoGastoEnvio'] == 0)
        $cargoExtra = $gastoEnvio;
    else if ($_SESSION['tipoGastoEnvio'] == 1)
        $cargoExtra = ($total * ($gastoEnvio / 100));
    else if ($_SESSION['tipoGastoEnvio'] == 2) {
        $cadena = "$gastoEnvio";
        eval('$cargoExtra = ' . $cadena . ';');
    }
    echo "$" . $cargoExtra;
        ?> 
        <input type="radio" name="envio" value="0" checked/><br>
        Lo paso a recoger:  $0<input type="radio" name="envio" value="1"/><br>
        <?php
        if (($total > $_SESSION['pedidoMinimo']) && isset($pedidos) && $pedidos != array()) {
            //$opcion = '<script language="javascript" type="text/javascript">document.write(document.getElementByName("envio"));<script/>';

            echo "<br><a href='#' id='pedirp'>Pedir</a>";
        }
        else
            echo "El total de su compra no alcanza el pedido m&iacute;nimo";
        ?>
        <?php
    }
    ?>
</div>
<?php
require_once('layout/footer.php');
?>