     <?php
require_once('layout/headers/headInicio.php');
require_once('layout/headers/headSuperbox.php');
require_once('layout/headers/headBlockUI.php');
require_once('layout/headers/headValidate.php');
require_once('layout/headers/headPedidos.php');
require_once('layout/headers/headFin.php');
?>

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
        if($habilitado){
            foreach ($platillos as $platillo) {
                $platillo->printPlatilloPedido();
            } 
        }else{
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
            foreach($value as $clave=>$valor){
                foreach($valor as $clv=>$val){
                    echo '<div id="'.$clv.'">';
                    echo $val[1] . " "; //cantidad
                    echo $val[0] . " "; //nombre
                    //echo $val[2]; //especificaciones
                    echo $val[3] . " "; //total
                    //echo '<div id="des'.$clv.'';
                    echo '<a href="pedidos.php?a=eliminarDelPedido&ir='.$restaurante->idRestaurante.'&pc='.$key.'">Eliminar</a>';
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
    if(isset($pedidos) && $pedidos!=array())
        echo "<br><div id='totalw' style='float:left;'>Subtotal: $</div> <div id='totalc' style='float:left;'>" . $total."</div><br>";  
    ?>
</div>
<div id="botonpedir">
    <?php
        if(isset($pedidos) && $pedidos!=array())    {
    ?>
            A domicilio: <?php 
                            if($_SESSION['tipoGastoEnvio']==0)
                                $cargoExtra = $gastoEnvio;
                            else if($_SESSION['tipoGastoEnvio']==1)                
                                $cargoExtra = ($total*($gastoEnvio/100));
                            else if($_SESSION['tipoGastoEnvio']==2){
                                $cadena = "$gastoEnvio";
                                eval('$cargoExtra = ' . $cadena . ';');
                            }
                            echo "$".$cargoExtra;
                        ?> 
            <input type="radio" name="envio" value="0" checked/><br>
            Lo paso a recoger:  $0<input type="radio" name="envio" value="1"/><br>
    <?php
    if(($total > $_SESSION['pedidoMinimo']) && isset($pedidos) && $pedidos!=array()){
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