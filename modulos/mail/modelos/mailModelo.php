<?php
require_once 'bd/conx.php';

function enviarEmailDeConfirmacion($destinatario,$codigo){
    $mensaje = "Favor de confirmar tu cuenta de efood dando click en el siguiente link";
    $asunto = "Confirmacion";
    $remitente = "registro@efood.com.mx";

    $mensaje = $mensaje . ' <br>http://www.efood.com.mx/beta/correoConfirmacion.php?conf='.$codigo.'<br><br>';

    $res = enviaMailSMTP($asunto, $mensaje, $remitente, $destinatario);
    //$res = enviaMail($asunto, $mensaje, $remitente, $destinatarios);
    return $res;
}

function enviaMailSMTP($asunto, $mensaje,$remitente, $destinatario){
    require_once "modulos/mail/clases/class.phpmailer.php";
                
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->IsHTML(true);
	$mail->SMTPAuth = true;
	$mail->Host = 'efoodcommx.ipower.com';
	$mail->Port = 587;
	$mail->Username = 'registro@efood.com.mx';
	$mail->Password = 'Registro1';    

	$mail->AddReplyTo($remitente,'Efood');
	$mail->SetFrom($remitente,'Efood');
	
	$enviado = false;
	$errores = 0;
	$mailsError='';
	try{
            $mail->AddAddress($destinatario, '');
            $mail->Subject = $asunto;
            $mail->Body = $mensaje;

            if ($mail->Send()) {
                $enviado = true;
            }
	}
	catch(Exception $e){
		$h2 = 'Error al iniciar el servicio de e-mail.';
		$msg = $e->getMessage();
	}
        return $enviado;
}

function confirmarContacto($codigo){
    global $conex;
    $stmt = $conex->prepare("UPDATE usuario SET habilitado='1' WHERE habilitado=:codigo");
    $stmt->bindParam(':codigo',$codigo);
    $val = $stmt->execute();
    return $val;
}
?>
