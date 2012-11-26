<?php
require_once('layout/headers/headInicio.php');
require_once('layout/headers/headPedidos.php');
require_once('layout/headers/headAutocompleteColonias.php');
require_once('layout/headers/headFin.php');
?>


<?php
if (isset($pedidoGenerado)) {
    print_r("<br><br><br><br><br>" . $pedidoGenerado);
}
/* if($errores)
  print_r('Se generó correctamente su pedido');
  else
  print_r('Ocurrió un error durante la generación de su pedido'); */
if($_GET['p']==0){
echo '<div id="direcciones">';
if (isset($direcciones) && count($direcciones) > 0) {
    echo '<select id="direccionesU">';
    foreach ($direcciones as $key => $direccion) {
        echo '<option value="' . $direccion->idDireccion . '">' . $direccion->calle . ' #' . $direccion->numero . ' interior:' . $direccion->numeroInt . '</option>';
        //echo '<input type="radio" name="direccion" id="direccion" value="'.$direccion->idDireccion.'">' . $direccion->calle . ' #' . $direccion->numero . ' interior:' . $direccion->numeroInt . "<br>";
    }
    echo '</select><br><br>';
}
}
echo '</div>';
if(isLogued()){
?>
<?php
if($_GET['p']==0){ //pregunto si es a domicilio para poner la dirección, sino no poner nada
    ?>
Da de alta una nueva Direcci&oacute;n:<br>
<form id="altaDireccion" method="Post" action="">
    <div class="span6" id="top_buscador_center">
        <span id="estoy_en">Colonia:</span>
        <input class="ui-corner-all requerido" id="colonias" name="colonia" type="text" placeholder="¡Escribe tu colonia!">
        <input type="hidden" id="idColonia" name="idColonia">
        <?php
        if (isset($_GET['coloniaNoReconocida'])) {
            ?>
            <div style="color:red;">
                ¡Oopps! No pudimos encontrar tu colonia. ¿Te aseguraste de seleccionarla de nuestra lista? Por favor ingrésala nuevamente y selecciona tu colonia de la lista desplegable. ¡Gracias!
            </div>
            <?php
        }
        ?><br>
         <div class="row-fluid">
        Calle:<input type="text" id="calle" name="calle" class="requerido"/><br>
        N&uacute;mero:<input type="text" id="numero" name="numero" class="requerido"/><br>
        N&uacute;mero Interior:<input type="text" id="numeroint" name="numeroint" /><br>
        Referencia:<input type="text" id="referencia" name="referencia" /><br>
        <input type="button" value="Nueva Direccion" id="altaDireccion" name="altaDireccion" onclick="altaDir();"><br>
         </div>
 <?php
    }//cierre del if para saber si es a domicilio o a recoger
 ?>
        M&eacute;do de pago<br>
         Efectivo:<input type="radio" name="pago" value="0" checked/><br>
         Paypal:<input type="radio" name="pago" value="1"/><br>
        </form>


        <?php
        echo '<a id="avanzarp" href="#">Avanzar</a>';
}
        require_once('layout/footer.php');
        ?>