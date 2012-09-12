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
                <select  class="selectAmarillo" title="Horarios">
                    <option></option>
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
    <img src="/layout/imagenes/resultadosBusqueda/separador_856x10.png"/>
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
        $aux = $aux . " tipoEntrega" . $restaurante->metodoEntrega;
        ?>
        <div class="restaurante ui-corner-all <?php echo $aux; ?>">
            <?php
            if ($i % 2 == 0) {
                ?>
                <div class="restauranteHeader">
                    <?php
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
            <div class="restauranteBody">
                <div class="logoRestaurante">
                    <img src="<?php echo $restaurante->logo; ?>"/>
                </div>
                <div class="separadorLogo">
                </div>
                <div class="contenidoRestaurante">
                    <div class="left datosRestaurante">
                        <div class="horario">
                            <img src="/layout/imagenes/resultadosBusqueda/reloj_20x20.png"/>
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
                                echo '<img src="/layout/imagenes/resultadosBusqueda/tipoPagos_190x20.png"/>';
                            }
                            if ($restaurante->formaPago == 2) {
                                echo 'efectivo';
                                echo '<img src="/layout/imagenes/resultadosBusqueda/tipoPagos_190x20.png"/>';
                            }
                            ?>

                        </div>
                    </div>
                    <div class="left metodoEntrega">
                        <?php
                        if ($restaurante->metodoEntrega == 1) {
                            echo '<img src="/layout/imagenes/Home/img_Domicilio_86x39.png"/>';
                        }
                        if ($restaurante->metodoEntrega == 0) {
                            echo '<img src="/layout/imagenes/Home/img_Recoger_64x40.png"/>';
                        }
                        if ($restaurante->metodoEntrega == 2) {
                            echo '<img src="/layout/imagenes/Home/img_Domicilio_86x39.png"/>';
                            echo '<img src="/layout/imagenes/Home/img_Recoger_64x40.png"/>';
                        }
                        ?>


                    </div>
                    <?php ?>
                    <div class="realizarPedido">
                        <a href="pedidos.php?a=menu&i=<?php echo $restaurante->idRestaurante; ?> ">
                            <img src="/layout/imagenes/resultadosBusqueda/btnRealizarPedido_180x45.png"/>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $i++;
    }
    ?>
</div>
<br>
<br><br><br><br><br><br><br><br><br><br>
<?php
require_once('layout/footer.php');
?>