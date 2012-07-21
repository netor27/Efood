<HTML>
    <?php
    $form = array('cmd' => '_xclick',
        'business' => 'gerardov15@hotmail.com',
        'cert_id' => 'K3XLPDNFUKNFA',
        'lc' => 'ES_MX',
        'custom' => '123custom456',
        'invoice' => '',
        'currency_code' => 'MXN',
        'no_shipping' => '1',
        'item_name' => 'Pedido a Chillis',
        'item_number' => '123456',
        'amount' => '300'
        
    );

    require_once 'modulos/pagos/modelos/PayPalModelo.php';
    $encrypted = paypal_encrypt($form);
    ?> 
    <HEAD>
        <TITLE>Boton encriptado de Paypal</TITLE>
    </HEAD>
    <BODY bgcolor=white>
        <TABLE border=0>
            <TR><TD align=center>
                    <h1>Pagar pedido</h1>
                    <form action="https://www.paypal.com.mx/cgi-bin/webscr" method="post" target=_blank>
                        <input type="hidden" name="cmd" value="_s-xclick">
                        <input type="hidden" name="encrypted" value="
                               <?PHP echo $encrypted; ?>">
                        <input type="image" src="https://www.paypalobjects.com/es_XC/MX/i/btn/btn_buynowCC_LG.gif" border="0" alt="PayPal, la forma más segura y rápida de pagar en línea.">
                    </form>
                </TD></TR></TABLE>
    </BODY>

</HTML>