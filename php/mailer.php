<?php
require 'PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'stumpyNoruega@gmail.com';                 // SMTP username
$mail->Password = '1234QWER';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('stumpyNoruega@gmail.com', 'The Italian Restaurant');
$mail->addAddress($_POST['email_to']);     // Add a recipient

$mail->Subject = $_POST['email_subject'];
$body = 
'<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style type="text/css">
		@import url("https://fonts.googleapis.com/css?family=Baloo");
		.container{
			margin-right: 20px;
			margin-left: 20px;
		}
		.message-body{
			font-family: "Baloo", Verdana, sans-serif;
			font-size: 16px;
			background-color: #F5F6CE;
			padding: 15px 0px;

		}
		.message-footer{
			font-size: 12px;
		}

		.container > img{
			width: 100%;
			height: 100%;
		}
	</style>
</head>
<body>
	<div class="container">
		<img src="http://theitalianrestaurant.esy.es/img/email_banner.png">
	</div>
  	<div class="container">
  		<p class="message-body">' . $_POST["email_body"] . '</p>
  		<p class="message-footer">Este mensaje ha sido redactado por uno de nuestros administradores mediante un sistema automatico de envio de correos electronicos, favor de no responder este mensaje y utilizar el sistema de envio de comentarios de la pagina si necesita alguna aclaracion.</p>
  	</div>
</body>
</html> ';
$mail->Body = $body;
$mail->AltBody = $_POST['email_body'];

if(!$mail->send()) {
	$response['status'] = false;
	$response['msg'] = "Ocurrio un error al entregar el correo: $mail->ErrorInfo";
} else {
	$response['status'] = true;
    $response['msg'] = 'Se ha enviado correctamente un correo electronico a la cuenta: ' . $_POST['email_to'];
}
echo json_encode($response);

