<?php
require_once('layout/headers/headInicio.php');
require_once('layout/headers/headIndex.php');
require_once('layout/headers/headAutocompleteColonias.php');
//require_once('layout/headers/headAutocompleteRestaurantes.php');
require_once('layout/headers/headFin.php');
?>

<div class="row-fluid" id="buscadorContainer" style="overflow:hidden;">
    <form action="pedidos.php" method="get">
        <input type="hidden" name="a" value="buscarRestauranteHome">
        <div class="row-fluid" id="top_buscador" style="overflow:hidden;">
            <div class="span3" >
                <div id="logo_chef">                    
                    <img id="cuerpo_chef" src="layout/imagenes/Home/Logo_Chef_93x22(2).png" alt="logoCheff"/>
                    <img id="sombra_chef" src="layout/imagenes/Home/Sombra_Chef_93x22.png" alt="sombra"/>                    
                </div>
            </div>
            <div class="span6" id="top_buscador_center">
                <span id="estoy_en">Estoy en:</span><br>
                <input class="ui-corner-all" id="colonias" name="colonia" type="text" placeholder="¡Escribe tu colonia!"><br>
                <input type="hidden" id="idColonia" name="idColonia">

                <div id="bottom_center_buscador">
                    <div style="color:red; height: 40px;">
                        <?php
                        if (isset($_GET['coloniaNoReconocida'])) {
                            ?>

                            ¡Oopps! No pudimos encontrar tu colonia. Por favor ingrésala nuevamente y selecciona tu colonia de la lista desplegable. ¡Gracias!

                            <?php
                        }
                        ?>
                    </div>
                    <span>Hoy se me antoja:</span>
                    <br>
                    <span class="texto_parentesis">(Deja todos en blanco para ver todos los tipos de comida)</span>
                </div>
            </div>
            <div class="span3">
                <div class="row-fluid">
                    <div class="span12" id="lo_nuevo">
                        <img src="layout/imagenes/Home/LoNuevo_242x86(2).png" alt="lo nuevo"><br>
                        <div id="lo_nuevo_texto" >
                            <div class="row-fluid">
                                <span class="span12">¡Tu comida favorita</span>
                            </div>                            
                            <div class="row-fluid">
                                <span class="span12 span_big">a Domicilio</span>
                            </div>
                            <div class="row-fluid">
                                <span class="span12" style="margin-top: -13px;">con un solo click!</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="row-fluid" id="sliderContainer">
            <div class="span12">
                <ul id="slider1" class="multiple">
                    <?php
                    if (isset($tiposComida)) {
                        foreach ($tiposComida as $tipo) {
                            ?>
                            <li class="imagen_slider" style="margin:0px;">
                                <div class="imagen_slider_div checkbox_antojo_container" id="<?php echo $tipo->idTipoComida; ?>">
                                    <img src="<?php echo $tipo->imagen; ?>" title="<?php echo urldecode($tipo->nombre); ?>">
                                    <br>
                                    <div id="checkbox_<?php echo $tipo->idTipoComida; ?>" class="checkbox_antojo_clear">&nbsp;</div>
                                    <input type="hidden" class="checkbox_vacio" id="antojo<?php echo $tipo->idTipoComida; ?>" name="antojos[]" value="<?php echo $tipo->idTipoComida; ?>"/>
                                    <input type="hidden" id="antojo_nombre_<?php echo $tipo->idTipoComida; ?>" value="<?php echo urldecode($tipo->nombre); ?>"/>
                                </div>
                            </li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>

        <div id="sliderTextContainer">
            <img src="layout/imagenes/Home/img_sombra_133x9.png"/><br>
            <span id="sliderText"></span>
        </div>

        <div class="row-fluid">
            <div id="bottom_buscador_container">
                <div id="bottom_buscador">
                    <span>Prefiero:</span>
                    <br><br>
                    <div class="left">
                        <div class="left preferencia_texto" >A mi domicilio</div>
                        <img class="left" src="layout/imagenes/Home/img_Domicilio_86x39.png">
                        <div id="domicilio" class="checkbox_preferencia_clear">&nbsp;</div>
                        <input class="checkbox_vacio" type="hidden" id="preferencia_domicilio" name="preferenciaDomicilio" value="1"/>
                    </div>
                    <div class="right">
                        <div class="left preferencia_texto" >Lo paso a recoger</div>
                        <img class="left" src="layout/imagenes/Home/img_Recoger_64x40.png">
                        <div id="recoger" class="checkbox_preferencia_clear">&nbsp;</div>
                        <input class="checkbox_vacio" type="hidden" id="preferencia_recoger" name="preferenciaRecoger" value="1"/>
                    </div>
                    <br><br><br><br>
                    <div style="margin: 0 auto;">
                        <input id="btnBuscar" type="image" src="layout/imagenes/Home/btn_Buscar_188x37(2).png">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="row-fluid">
    <div class="span10 offset1">
        <img src="layout/imagenes/Home/SeparadorBlog.png">
    </div>
</div>
<div class="row-fluid">
    <div class="span10 offset1">
        <?php
        $i = 0;
        foreach ($blogEntries as $entry) {
            if ($i < 3) {
                //Listamos las demás entradas
                ?>
                <div class="row-fluid blogEntry">
                    <div class="span3">
                        <?php
                        if ($i == 0) {
                            //si es la primera entrada ponemos la imagen
                            echo '<a href="http://testefood.blogspot.mx"><img src="layout/imagenes/Home/ultimasNoticias.png"></a>';
                        }
                        ?>
                    </div>
                    <div class="span9">
                        <div class="row-fluid">
                            <div class="span12">
                                <div class="tituloBlog">
                                    <a href="<?php echo $entry['link']; ?>">
                                        <?php echo $entry['titulo']; ?>
                                    </a>
                                </div>
                                <div class="fechaPublicadoBlog">
                                    <?php echo $entry['fecha']; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span12">
                                <div class="contenidoBlog">
                                    <?php
                                    if (strlen($entry['contenido']) > 750) {
                                        echo substr($entry['contenido'], 0, 750) . "...<br>";
                                        echo ' <a target="_blank" href="' . $entry['link'] . '"> Continuar leyendo..</a>';
                                    } else {
                                        echo $entry['contenido'];
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        $i++;
    }
    ?>

</div>
<div class="row-fluid"><div class="span10"></div></div>
<div class="row-fluid"><div class="span10"></div></div>
</div>
<?php
require_once('layout/footer.php');
?>