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
    <div class="span7" style="padding-left:35px">
        <div class="row-fluid">
            <a href="http://testefood.blogspot.mx"><img src="layout/imagenes/Home/ultimasNoticias.png"></a>
        </div>        
        <?php
        $i = 0;
        foreach ($blogEntries as $entry) {
            if ($i < 3) {
                //Listamos las demás entradas
                ?>
                <div class="row-fluid blogEntry">
                    <div class="span12">
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
                                        echo substr($entry['contenido'], 0, 750) . "...";
                                        echo '</div>'; //Ponemos este tag porque "seguramente" 
                                        //hay un div sin cerrar en el contenido del blog.   
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

                <?php
            }
            $i++;
        }
        ?>
    </div>
    <div class="span5">
        <div class="row-fluid ">
            <div class="span10 contenedorLikes">
                <div class="row-fluid">
                    <div class="span6 likeSoloSi">
                        "Like" sólo si
                    </div>
                    <div class="span6">
                        <img src="layout/imagenes/Home/Gorrito_corazon.png">
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="fb-like" data-send="false" data-width="300" data-show-faces="true" data-font="tahoma"></div>
                </div>
                <div class="row-fluid">
                    <a href="https://twitter.com/eFoodMX" class="twitter-follow-button" data-show-count = true data-lang="es">Follow @eFoodMX</a>
                    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row-fluid"><div class="span12 "></div></div>
<div class="row-fluid">
    <div class="span10 offset1">
        <img src="layout/imagenes/Home/SeparadorBlog.png">
    </div>
</div>
<div class="row-fluid">
    <div class="span8 offset2 comoSeCome">
            ¿eFood? ... Y cómo se come?!
    </div>    
</div>
<div class="row-fluid">
    <div class="span10 offset1 comoSeComeTexto">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse adipiscing velit quis sapien ullamcorper at viverra lacus eleifend. Maecenas nisi erat, pulvinar a interdum at, rhoncus vel orci. In blandit risus vitae erat posuere et tincidunt enim pharetra. Quisque congue, nulla at rutrum hendrerit, quam ligula ultrices augue, sed volutpat eros diam in ante. Sed diam tortor, mollis non vehicula sed, ultricies eget enim. Nunc dictum, sapien at facilisis facilisis, ante ante placerat nulla, molestie sodales erat elit vitae nisl. Mauris 
    </div>    
</div>

<?php
require_once('layout/footer.php');
?>