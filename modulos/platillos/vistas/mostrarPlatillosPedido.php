<?php
require_once('layout/headers/headInicio.php');
require_once('layout/headers/headPedidos.php');
require_once('layout/headers/headAutocompleteColonias.php');
require_once('layout/headers/headSocialMedia.php');
require_once('layout/headers/headFin.php');
?>
<div id="modalDialogIngredientes" title="Aquí es al gusto" style="display:none;">
</div>
<div id="buscadorContainer" class="row-fluid">
    <form method="get" action="pedidos.php">
        <input type="hidden" name="a" value="buscarRestaurante">
        <div class="formElement">
            <input id="colonias" class="ui-corner-all textoBlanco" type="text" placeholder="¡Escribe tu colonia!" value="<?php echo $colonia->nombre; ?>"/>
            <input type="hidden" id="idColonia" name="idColonia" value="<?php echo $colonia->idColonia; ?>">
        </div>
        <div class="formElement">
            <select class="selectBlanco" title="Tipo de comida" name="idTipoComida">
                <option value=""></option>
                <?php
                foreach ($tiposDeComida as $tipo) {
                    echo '<option value="' . $tipo->idTipoComida . '" >' . $tipo->nombre . '</option>';
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
switch ($restaurante->metodoEntrega) {
    case 0:
        $aux = $aux . " tipoEntrega0";
        break;
    case 1:
        $aux = $aux . " tipoEntrega1";
        break;
    case 2:
        $aux = $aux . " tipoEntrega0 tipoEntrega1 tipoEntrega2";
        break;
}

if ($habilitado) {
    $aux = $aux . " restauranteAbierto";
} else {
    $aux = $aux . " restauranteCerrado";
}
?>
<div class="restaurante ui-corner-all <?php echo $aux; ?>">
    <?php
    if ($habilitado) {
        ?>
        <div class="restauranteHeader row-fluid">
            <?php
        } else {
            echo '<div class="restauranteHeaderCerrado row-fluid">';
        }
        ?>

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
    <div class="restauranteBody row-fluid">
        <div class="logoRestaurante span2">
            <img class="span9 offset1" src="<?php echo $restaurante->logo; ?>"/>
            <div class="span1 offset1 separadorLogo"></div>
        </div>
        <div class="contenidoRestaurante span4">
            <div class="row-fluid">
                <div class=" span12 datosRestaurante">
                    <p class="textoDireccion">
                        <?php
                        echo $restaurante->calle . " ";
                        echo $restaurante->numero;
                        if ($restaurante->numeroInt != "")
                            echo " interior " . $restaurante->numeroInt;
                        echo ", " . $restaurante->nombreColonia . " ";
                        echo "Del. " . $restaurante->delegacion->nombre . ", " . $restaurante->delegacion->entidad;
                        ?>
                    </p>
                    <p class="textoDireccion">
                        Llama si prefieres al <span class="telefono"><?php echo $restaurante->telefono; ?></span>
                    </p>
                    <p class="textoDireccion">
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
                    </p>
                    <p class="textoDireccion">
                        <?php
                        if ($restaurante->formaPago == 0) {
                            echo '<img src="layout/imagenes/resultadosBusqueda/Efectivo.png"/>';
                        }
                        if ($restaurante->formaPago == 1) {
                            echo '<img src="layout/imagenes/resultadosBusqueda/tipoPagos_190x20.png"/>';
                        }
                        if ($restaurante->formaPago == 2) {
                            echo '<img src="layout/imagenes/resultadosBusqueda/Efectivo.png"/>';
                            echo '<img src="layout/imagenes/resultadosBusqueda/tipoPagos_190x20.png"/>';
                        }
                        ?>

                    </p>
                </div>                 
            </div>
        </div>
        <div class="span4">

            <?php
            if ($restaurante->metodoEntrega != 0) {
                ?>
                <div class="row-fluid rowMetodoEntrega">
                    <div class="span4">
                        <img src="layout/imagenes/Home/img_Domicilio_86x39.png"/>                                    
                    </div>
                    <div class="span8">
                        <?php
                        if ($restaurante->pedidoMinimo == 0) {
                            echo '<span class="textoEntregaGreen">¡No hay pedido mínimo!</span>';
                        } else {
                            echo '<span class="textoEntrega">Pedido mínimo: </span>' . '<span class="textoEntregaNumero">$' . $restaurante->pedidoMinimo . '</span>';
                        }
                        echo '<br>';
                        if ($restaurante->gastoEnvio == 0) {
                            echo '<span class="textoEntregaGreen">¡Es gratis!</span>';
                        } else {
                            switch ($restaurante->tipoGastoEnvio) {
                                case 0:
                                    echo '<span class="textoEntrega">Gastos de envío: </span>' . '<span class="textoEntregaNumero">$' . $restaurante->gastoEnvio . '</span>';
                                    break;
                                case 1:
                                    echo '<span class="textoEntrega">Gastos de envío: </span>' . '<span class="textoEntregaNumero">' . $restaurante->gastoEnvio . '%</span>';
                                    break;
                                case 2:
                                    echo '<span class="textoEntrega">Gastos de envío: </span>' . '<span class="textoEntregaNumero">Compuesto</span>';
                                    break;
                            }
                        }
                        ?>
                    </div>
                </div>
                <?php
            }
            if ($restaurante->metodoEntrega != 1) {
                ?>
                <div class="row-fluid rowMetodoEntrega">
                    <div class="span4">
                        <img src="layout/imagenes/Home/img_Recoger_64x40.png"/>                                    
                    </div>
                    <div class="span8">
                        <span class="textoEntregaGreen">¡No hay pedido mínimo!</span>
                        <br>
                        <span class="textoEntregaGreen">¡Es gratis!</span>
                    </div>
                </div>
                <?php
            }
            ?>

        </div>   
        <div class="span2">
            <div class="span12">
                <img class="recomiendaRestaurante" src="layout/imagenes/Menu/RecomiendaEsteRestaurante.png">
                <a href="https://twitter.com/share" class="twitter-share-button" data-via="eFoodMX" data-lang="es">Tweet</a>
                <div class="fb-like" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false" data-font="tahoma"></div>
            </div>
        </div>
    </div>
</div>

<?php
$_SESSION['pedidoMinimo'] = $restaurante->pedidoMinimo;
//echo "<br>Gasto de Env&iacute;o: " . $restaurante->gastoEnvio;
$_SESSION['gastoEnvio'] = $restaurante->gastoEnvio;
$gastoEnvio = $restaurante->gastoEnvio;
$_SESSION['tipoGastoEnvio'] = $restaurante->tipoGastoEnvio;
?>
<div class="row-fluid"><div class="span12"></div></div>
<div class="row-fluid">
    <div id="menu" class="span8">     
        <div class="row-fluid">
            <div class="span3 offset1">
                <a id="btnMostrarMenu">
                    <img src="layout/imagenes/Menu/Btn_Menu_rojo.png" id="btnMenuRojo">
                    <img src="layout/imagenes/Menu/Btn_Menu_gris.png" id="btnMenuGris" style="display: none;">
                </a>
            </div>
            <div class="span3">
                <a id="btnMostrarOpiniones">
                    <img src="layout/imagenes/Menu/Btn_Opiniones_rojo.png" id="btnOpinionesRojo" style="display: none;">
                    <img src="layout/imagenes/Menu/Btn_Opiniones_gris.png" id="btnOpinionesGris">
                </a>
            </div>
            <div class="span4">
                <a id="btnMostrarInformacion">
                    <img src="layout/imagenes/Menu/Btn_Informacion_rojo.png" id="btnInformacionRojo" style="display: none; height: 34px;">
                    <img src="layout/imagenes/Menu/Btn_Informacion_gris.png" id="btnInformacionGris" style=" height: 34px;">
                </a>
            </div>
        </div>
        <div class="row-fluid"><div class="span12"></div></div>
        <div class="row-fluid" id="menuContenido">
            <?php
            require_once 'modulos/platillos/clases/Platillo.php';
            $contador = 0;
            $filaPar = false;
            $tipoPlatillo = "";
            $tipoFila = "";
            if (isset($platillos)) {
                //el restaurante esta abierto, hay que validar cada platillo con su horario
                foreach ($platillos as $platillo) {
                    if ($contador % 2 == 0) {
                        //inicia un renglón           
                        echo '<div class="row-fluid">';
                        $tipoPlatillo = "platilloPar";
                        $filaPar = !$filaPar;
                        if ($filaPar) {
                            $tipoFila = "filaPar";
                        } else {
                            $tipoFila = "filaNon";
                        }
                    } else {
                        $tipoPlatillo = "platilloNon";
                    }

                    if ($habilitado && platilloDisponibleAhorita($platillo->idPlatillo)) {
                        $platillo->printPlatilloPedido($tipoPlatillo, $tipoFila);
                    } else {
                        $platillo->printPlatilloPedidoDeshabilitado($tipoPlatillo, $tipoFila);
                    }

                    if ($contador % 2 == 1) {
                        echo '</div>'; //termina el renglón
                    }
                    $contador++;
                }
            }
            ?>
            <div class="row-fluid">
                <div class="span12"></div>
            </div>
        </div>
        <div class="row-fluid" id="opinionesContenido">
            <div class="row-fluid">
                <?php
                //tenemos que quitar el ic del url, para que los comentarios aparezcan sin 
                //importar desde que colonia se hizo la busqueda
                $url = getUrl();
                $aux = explode("&", $url);
                $url = $aux[0] . "&" . $aux[1] . "&ic=8";
                ?>
                <div class="fb-comments" data-href="<?php echo $url; ?>" data-num-posts="10" data-width="600"></div>
            </div>
            <div class="row-fluid"><div class="span12"></div></div>
        </div>
        <div class="row-fluid" id="informacionContenido">
            <div class="span10 offset1">
                <legend>Información del restaurante</legend>
                <p>
                    <?php echo $restaurante->informacion; ?>
                </p>
            </div>
        </div>
    </div>
    <div class="span4">
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
                            echo '<a href="pedidos.php?a=eliminarDelPedido&ir=' . $restaurante->idRestaurante . '&pc=' . $key . '&ic=' . $idColonia . '">Eliminar</a>';
                            echo "</div>";
                            $total+=$val[3];
                        }
                    }
                }
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
                if (($total >= $_SESSION['pedidoMinimo']) && isset($pedidos) && $pedidos != array()) {
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
    </div>
</div>
<div class="row-fluid"><div class="span12"></div></div>
<div class="row-fluid"><div class="span12"></div></div>
<?php
require_once('layout/footer.php');
?>