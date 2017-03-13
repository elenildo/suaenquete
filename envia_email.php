<?php

if(isset($_POST['email'])){
	$usermail = $_POST['email'];
	$n = rand(0,9999);
	$chave = str_pad($n, 4, '0', STR_PAD_LEFT);
	$usr = array('email' => $usermail,'chave'=> $chave );
	
	session_start();
	$_SESSION['user'] = $usr;


	//error_reporting(E_ALL);
	error_reporting(E_STRICT);

	date_default_timezone_set('America/Sao_Paulo');

	require_once('PHPMailer/class.phpmailer.php');
	//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

	$mail             = new PHPMailer();

	//$body             = file_get_contents('conteudo.txt');
	$body             = "<b>Olá, obrigado pelo seu voto.<br> O código de confirmação é : {$chave} </b>";
	//$body             = preg_replace('/[\]/','',$body); 


	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->Host       = "smtp.gmail.com"; // SMTP server
	$mail->SMTPDebug  = false;                     // enables SMTP debug information (for testing)
	                                           // 1 = errors and messages
	                                           // 2 = messages only
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
	$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
	$mail->Port       = 587;                   // set the SMTP port for the GMAIL server
	$mail->Username   = "elenildo.dev@gmail.com";  // GMAIL username
	$mail->Password   = "besouro dourado";            // GMAIL password

	$mail->SetFrom('elenildo.dev@gmail.com', 'Sua Enquete');

	$mail->AddReplyTo("elenildo.dev@gmail.com","Sua Enquete");

	$mail->Subject    = "Codigo de validacao do voto";

	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

	$mail->MsgHTML($body);

	$address = $usermail;
	$mail->AddAddress($address, "Voto em Enquete");

	//$mail->AddAttachment("images/phpmailer.gif");      // attachment
	//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

	if(!$mail->Send()) {
	  echo "Mailer Error: " . $mail->ErrorInfo . "<br>usuario:".$usermail;
	} else {
	  echo "Message sent!";
	}
}else
	echo "Erro ao enviar o POST";
?>

