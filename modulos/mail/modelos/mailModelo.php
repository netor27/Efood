<?php
require_once 'bd/conx.php';

function enviarEmailDeSolicitudAgregarRestaurante($mensaje){
    $asunto = "Solicitud de nuevo restaurante";
    $remitente = "no-reply@efood.com.mx";
    $destinatario = "neto.r27@gmail.com";
    $res = enviaMailSMTP($asunto, $mensaje, $remitente, $destinatario);
    return $res;
}

function enviarEmailDeConfirmacion($destinatario, $codigo){
    $mensaje = "Favor de confirmar tu cuenta de efood dando click en el siguiente link";
    $asunto = "Confirmacion";
    $remitente = "no-reply@efood.com.mx";

    $mensaje = $mensaje . ' <br>http://www.efood.com.mx/correoConfirmacion.php?conf='.$codigo.'<br><br>';

    $res = enviaMailSMTP($asunto, $mensaje, $remitente, $destinatario);
    return $res;
}

function enviaMailSMTP($asunto, $mensaje,$remitente, $destinatario){
    require_once "modulos/mail/clases/class.phpmailer.php";
                
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->IsHTML(true);
	$mail->SMTPAuth = true;
	$mail->Host = 'mail.efood.com.mx';
	$mail->Port = 587;
	$mail->Username = 'no-reply+efood.com.mx';
	$mail->Password = 'Chef2012!';    

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