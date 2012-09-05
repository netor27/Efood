<?php
require_once('layout/headers/headInicio.php');
require_once('layout/headers/headIndex.php');
require_once('layout/headers/headAutocompleteColonias.php');
require_once('layout/headers/headAutocompleteRestaurantes.php');
require_once('layout/headers/headFin.php');
?>

<div id="buscadorContainer" style="overflow:hidden;">
    <form action="pedidos.php?a=buscarColonia" method="POST">
        <div id="top_buscador" style="overflow:hidden;">
            <div class="left">
                <div id="logo_chef">                    
                    <img id="cuerpo_chef" src="layout/imagenes/Home/Logo_Chef_93x22(2).png" alt="logoCheff"/>
                    <img id="sombra_chef" src="layout/imagenes/Home/Sombra_Chef_93x22.png" alt="sombra"/>                    
                </div>
            </div>
            <div class="left" id="top_buscador_center">
                <span id="estoy_en">Estoy en:</span><br>
                <input class="ui-corner-all" id="colonias" name="colonia" type="text" placeholder="¡Escribe tu colonia!"><br>
                <input type="hidden" id="idColonia" name="idColonia">
                <div id="bottom_center_buscador">
                    <span>Hoy se me antoja:</span><br>
                    <span class="texto_parentesis">(Deja todos en blanco para ver todos los tipos de comida)</span><br>
                    <img src="layout/imagenes/Home/img_flecha_115x15.png">
                </div>
            </div>
            <div class="right">
                <div id="lo_nuevo">
                    <img src="layout/imagenes/Home/LoNuevo_242x86(2).png" alt="lo nuevo"><br>
                    <div id="lo_nuevo_texto">
                        <span>¡Tu comida favorita</span><br>
                        <span class="span_big">a Domicilio</span><br>
                        <span>con un solo click!</span>
                    </div>
                </div>

            </div>
        </div>
        <div id="sliderContainer">
            <ul id="slider1" class="multiple">
                <?php
                if (isset($tiposComida)) {
                    foreach ($tiposComida as $tipo) {
                        ?>
                        <li class="imagen_slider">
                            <div>
                                <img src="<?php echo $tipo->imagen; ?>" >
                                <br>
                                <div id="<?php echo $tipo->idTipoComida; ?>" class="checkbox_antojo_clear">&nbsp;</div>
                                <input type="hidden" id="antojo<?php echo $tipo->idTipoComida; ?>" name="antojos[]" value="-1"/>
                            </div>
                        </li>
                        <?php
                    }
                }
                ?>
            </ul>
            <input id="antojos" type="hidden" name="antojos" />
        </div>
        <div id="bottom_buscador_container">
            <div id="bottom_buscador">
                <span>Prefiero:</span>
                <br><br>
                <div class="left">
                    <div class="left preferencia_texto" >A mí domicilio</div>
                    <img class="left" src="layout/imagenes/Home/img_Domicilio_86x39.png">
                    <input class="left" type="checkbox">
                </div>
                <div class="right">
                    <div class="left preferencia_texto" >Lo paso a recoger</div>
                    <img class="left" src="layout/imagenes/Home/img_Recoger_64x40.png">
                    <input class="left" type="checkbox">
                </div>
                <br><br><br><br>
                <div style="margin: 0 auto;">
                    <input type="image" src="layout/imagenes/Home/btn_Buscar_188x37(2).png">
                </div>
            </div>
        </div>
    </form>
</div>

<h2 class="left">
    <a href="adminRestaurante.php">Login de restaurantes</a
</h2>
<?php
require_once('layout/footer.php');
?>