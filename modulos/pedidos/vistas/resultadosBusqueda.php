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
                <select class="selectAmarillo" title="Tipo de comida">
                    <option value=""></option>
                    <?php
                    foreach ($tiposDeComida as $tipo) {
                        echo '<option value="' . $tipo->idTipoComida . '">' . $tipo->nombre . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="formElement">
                <select class="selectAmarillo" title="Tipo de entrega">
                    <option></option>
                    <option value="0">Pasar a recoger</option>                
                    <option value="1">A domicilio</option>                
                    <option value="2">Ambos</option>
                </select>
            </div>
            <div class="formElement">
                <select class="selectAmarillo" title="Horarios">
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
    foreach ($restaurantes as $restaurante) {
        ?>
        <div class="restaurante ui-corner-all">
            <div class="restauranteHeader">
                <div class="titulo">
                    <?php echo $restaurante->nombre; ?>
                </div>
                <div class="tiposComida">
                    Tacos y Chilaquiles / Mexicana
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
                            <span>De 13:00 a 19:00 hrs.</span>
                        </div>
                        <div class="datos">
                            <span class="datosRed">Pedido mínimo</span>
                            <span>$ <?php echo $restaurante->pedidoMinimo; ?></span>
                            <span class="datosRed">Gastos de Envío:</span>
                            <span><?php echo $restaurante->gastoEnvio; ?></span>
                        </div>
                        <div class="tipoPago">
                            <?php
                            if($restaurante->formaPago == 0){
                                echo 'efectivo';
                            }
                            if($restaurante->formaPago == 1){
                                echo '<img src="/layout/imagenes/resultadosBusqueda/tipoPagos_190x20.png"/>';
                            }
                            if($restaurante->formaPago == 2){
                                echo 'efectivo';
                                echo '<img src="/layout/imagenes/resultadosBusqueda/tipoPagos_190x20.png"/>';
                            }
                            ?>
                            
                        </div>
                    </div>
                    <div class="left metodoEntrega">
                        <?php
                        if($restaurante->metodoEntrega == 1){
                            echo '<img src="/layout/imagenes/Home/img_Domicilio_86x39.png"/>';
                        }
                        if($restaurante->metodoEntrega == 0){
                            echo '<img src="/layout/imagenes/Home/img_Recoger_64x40.png"/>';
                        }
                        if($restaurante->metodoEntrega == 2){
                            echo '<img src="/layout/imagenes/Home/img_Domicilio_86x39.png"/>';
                            echo '<img src="/layout/imagenes/Home/img_Recoger_64x40.png"/>';
                        }
                        ?>
                        
                        
                    </div>
                    <div class="realizarPedido">
                        <a href="#">
                            <img src="/layout/imagenes/resultadosBusqueda/btnRealizarPedido_180x45.png"/>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
</div>
<br>
<br><br><br><br><br><br><br><br><br><br>
<?php
require_once('layout/footer.php');
?>