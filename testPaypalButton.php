<HTML>
    <?php
    require_once 'modulos/pagos/modelos/PayPalModelo.php';
    //Ejemplo para crear un boton de pago de paypal con la información encriptada
    //La funcion recibe 4 variables:
    //$nombreArticulo => Descripción de lo que el usuario va a comprar. Aparecerá en la página de paypal 
    //                  como descripción de máximo 127 caracteres. La longitud se valida dentro de la función,
    //                  si hace un substring.
    //$numeroArticulo => Variable que aparece como "numero de articulo", esta variable se muestra al usuario.
    //                  Máximo 127 caracteres, se valida dentro de la función
    //$precio         =>    Precio total
    //$variableId     => Variable que no se muestra al usuario, es para usarse dentro del sistema. Cuando paypal
    //                  avisa que se realizo el pago, envía esta variable para que el sistema pueda identificar
    //                  que pedido se pago. Lo mejor sería poner el idPedido o algo así en esta variable
    //                  Máximo 256 caracteres, se valida dentro de la función
    //
    $variable;
    $botonPaypal = encriptarInformacionBotonPago("Pedido a Chillis", "123456", "300", "123custom456");
    ?> 
    <HEAD>
        <TITLE>Boton encriptado de Paypal</TITLE>
    </HEAD>
    <BODY bgcolor=white>
        <TABLE border=0>
            <TR>
                <TD align=center>
                    <h1>Pagar pedido</h1>
                    <?PHP echo $botonPaypal; ?>
                </TD>
            </TR>
        </TABLE>
    </BODY>

</HTML>