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
                <img src="layout/imagenes/Home/Logo_Chef_93x22(2).png" alt="logoCheff">
            </div>
            <div class="left" id="top_buscador_center">
                <span id="estoy_en">Estoy en:</span><br>
                <input class="ui-corner-all" id="colonias" name="colonia" type="text" placeholder="Escribe tu colonia!"><br>
                <input type="hidden" id="idColonia" name="idColonia">
                <div id="bottom_center_buscador">
                    <span>Hoy se me antoja:</span><br>
                    <span class="texto_parentesis">(Deja todos en blanco para ver todos los tipos de comida)</span><br>
                    <img src="layout/imagenes/Home/img_flecha_115x15.png">
                </div>
            </div>
            <div class="right">
                <img src="layout/imagenes/Home/LoNuevo_242x86(2).png" alt="lo nuevo">
            </div>
        </div>
        <div id="sliderContainer">
            <ul id="slider1" class="multiple">
                <li class="imagen_slider">
                    <div>
                        <img src="layout/imagenes/Home/Hamburguesa_68x57.png" >
                        <br>
                        <input type="checkbox">
                    </div>
                </li>
                <li class="imagen_slider">
                    <div>
                        <img src="layout/imagenes/Home/Pasta_62x48.png" >
                        <br>
                        <input type="checkbox">
                    </div>
                </li>
                <li class="imagen_slider">
                    <div>
                        <img src="layout/imagenes/Home/Sandwich_109x46.png" >
                        <br>
                        <input type="checkbox">
                    </div>
                </li>
                <li class="imagen_slider">
                    <div>
                        <img src="layout/imagenes/Home/Sushi_109x69.png" >
                        <br>
                        <input type="checkbox">
                    </div>
                </li>
                <li class="imagen_slider">
                    <div>
                        <img src="layout/imagenes/Home/Tacos_143x86.png" >
                        <br>
                        <input type="checkbox">
                    </div>
                </li>
            </ul>
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