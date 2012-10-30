<?php
require_once('layout/headers/headInicio.php');
require_once('layout/headers/headResultadosBusqueda.php');
require_once('layout/headers/headAutocompleteColonias.php');
require_once('layout/headers/headFin.php');
?>

<?php
if (sizeof($restaurantes) <= 0) {
    ?>
    <div id="modalDialogNoHayRestaurantes" title="Ohh-ohh... Ya nos cachaste...">
        <div class="row-fluid">
            <div class="span12">
                <p>
                    La verdad todavía no tenemos restaurantes registrados en cada rincón del país, 
                    pero deja los datos del restaurante que te gustaría ver aquí y lo registramos de volada.
                </p>
            </div>
        </div>
        <legend>Datos del restaurante</legend>
        <form action="pedidos.php?a=usuarioSolicitudRestaurante" method="post">
            <div class="row-fluid">
                <label class="span4">Nombre:</label>
                <input class="span8" type="text" name="nombre"> 
            </div>
            <div class="row-fluid">
                <label class="span4">Teléfono: (Opcional)</label>
                <input class="span8" type="text" name="telefono">
            </div>
            <div class="row-fluid">
                <label class="span4">Dirección:  (Opcional)</label>
                <input class="span8" type="text" name="direccion">
            </div>
            <div class="row-fluid"><div class="span12"></div></div>
            <div class="row-fluid">
                <div class="span5 offset4">
                    <input type="image" src="layout/imagenes/btnEnviarDatos.png">
                </div>
            </div>
            <input type="hidden" name="idColonia" value="<?php echo $idColonia; ?>">
        </form>
    </div>

    <?php
}
?>

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
                    if ($tipo->idTipoComida == $idTipoComida)
                        echo '<option value="' . $tipo->idTipoComida . '" selected>' . $tipo->nombre . '</option>';
                    else
                        echo '<option value="' . $tipo->idTipoComida . '">' . $tipo->nombre . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="formElement">
            <select class="selectBlanco"  title="Tipo de entrega" name="idMetodoEntrega">
                <option></option>
                <?php
                switch ($metodoEntrega) {
                    case 0:
                        echo '<option value="0" selected>Pasar a recoger</option>                
                              <option value="1">A domicilio</option>                
                              <option value="2">Ambos</option>';
                        break;
                    case 1:
                        echo '<option value="0">Pasar a recoger</option>                
                              <option value="1" selected>A domicilio</option>                
                              <option value="2">Ambos</option>';
                        break;
                    case 2:
                        echo '<option value="0">Pasar a recoger</option>                
                              <option value="1">A domicilio</option>                
                              <option value="2" selected>Ambos</option>';
                        break;
                }
                ?>

            </select>
        </div>
        <div class="formElement">
            <input type="image" src="layout/imagenes/resultadosBusqueda/btnBuscar_190x40.png">
        </div>
    </form>
</div>
<div id="numeroRestauranteContainer">
    <span class="redText"><?php echo sizeof($restaurantes); ?> restaurantes cerca de </span>
    <span class="coloniaText"><?php echo $colonia->nombre; ?></span>
</div>
<div id="filtrosContainer">
    <div id="filtroContainer" class="left">
        <span id="filtroContainerTexto">Filtra tu comida</span>
        <form action="#" method="post">
            <div class="formElement">
                <select id="selectTipoComida" class="selectAmarillo" title="Tipo de comida">
                    <option value=""></option>
                    <option value="-1">Mostrar todo</option>
                    <?php
                    foreach ($tiposDeComida as $tipo) {
                        echo '<option value="' . $tipo->idTipoComida . '">' . $tipo->nombre . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="formElement">
                <select id="selectMetodoEntrega" class="selectAmarillo" title="Tipo de entrega">
                    <option></option>
                    <option value="-1">Mostrar todo</option>
                    <option value="0">Pasar a recoger</option>                
                    <option value="1">A domicilio</option>                
                    <option value="2">Ambos</option>
                </select>
            </div>
            <div class="formElement">
                <select id="selectHorario"  class="selectAmarillo" title="Horarios">
                    <option></option>
                    <option value="-1">Mostrar todo</option>
                    <option value="0">Abiertos</option>
                </select>
            </div>
        </form>
    </div>
    <div id="ordenaContainer" class="right">
        <span id="ordenaContainerTexto">Ordena tus restaurantes</span>
        <form action="#" method="post">
            <div>
                <select class="selectAmarillo" >
                    <option value="0">Rating</option>
                </select>
            </div>
        </form>
    </div>
</div>
<div id="separadorContainer">
    <img src="layout/imagenes/resultadosBusqueda/separador_856x10.png"/>
</div>
<div id="restaurantesContainer">
    <?php
    $i = 0;
    foreach ($restaurantes as $restaurante) {
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
        $restauranteAbierto = restauranteAbiertoAhorita($restaurante->idRestaurante);
        if ($restauranteAbierto) {
            $aux = $aux . " restauranteAbierto";
        } else {
            $aux = $aux . " restauranteCerrado";
        }
        ?>
        <div class="restaurante ui-corner-all <?php echo $aux; ?>">
            <?php
            if (!$restauranteAbierto) {
                ?>
                <div class="restauranteHeaderCerrado">
                    <?php
                } else if ($i % 2 == 0) {
                    echo '<div class="restauranteHeader row-fluid">';
                } else {
                    echo '<div class="restauranteHeaderPar">';
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
                <div class="contenidoRestaurante span7">
                    <div class="row-fluid">
                        <div class=" span8 datosRestaurante">
                            <div class="horario row-fluid">
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
                            <div class="datos row-fluid">
                                <div class="span6">
                                    <span class="datosRed">Pedido mínimo:</span>
                                    <span>$<?php echo $restaurante->pedidoMinimo; ?></span>
                                </div>
                                <div class="span6">
                                    <?php
                                    switch ($restaurante->tipoGastoEnvio) {
                                        case 0:
                                            //monto fijo
                                            echo '<span class="datosRed">Gastos de Envío:</span>';
                                            echo "<span> $" . $restaurante->gastoEnvio . "</span>";
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
                                            echo '<span class="datosRed">Gastos de Envío: </span>';
                                            echo "<span>Compuesto</span>";
                                            break;
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="tipoPago row-fluid">
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
                        <div class="span4">
                            <div class="row-fluid">
                                <?php
                                if ($restaurante->metodoEntrega != 0) {
                                    ?>
                                    <div class="span5 metodoEntrega">
                                        <img src="layout/imagenes/Home/img_Domicilio_86x39.png"/>                                    
                                    </div>                                    
                                    <?php
                                }
                                if ($restaurante->metodoEntrega != 1) {
                                    ?>
                                    <div class="span5 offset1 metodoEntrega">
                                        <img src="layout/imagenes/Home/img_Recoger_64x40.png"/>                                    
                                    </div>                                    
                                    <?php
                                }
                                ?>
                            </div>
                        </div>                    
                    </div>
                </div>
                <div class="realizarPedido span3">
                    <a href="pedidos.php?a=menu&i=<?php echo $restaurante->idRestaurante; ?>&ic=<?php echo $colonia->idColonia; ?>">
                        <?php 
                        if($restauranteAbierto)
                            echo '<img src="layout/imagenes/resultadosBusqueda/btnRealizarPedido_180x45.png"/>';
                        else
                            echo '<img src="layout/imagenes/resultadosBusqueda/btnVerMenu.png"/>';
                        ?>
                    </a>
                </div>
            </div>
        </div>
        <?php
        $i++;
    }
    ?>
</div>
<?php
require_once('layout/footer.php');
?>