<html>
<head>
<title>PHPMailer - MySQL Database - SMTP basic test with authentication</title>
</head>
<body>

<?php

//error_reporting(E_ALL);
error_reporting(E_STRICT);

date_default_timezone_set('America/Toronto');

require_once('src/class.phpmailer.php');
require_once("src/class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail     = new PHPMailer();
//$body                = file_get_contents('contents.html');
//$body                = eregi_replace("[\]",'',$body);
$body = "Hola esto es un ejemplo";
//exit();
$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host          = "smtp.office365.com";
//$mail->Host          = "smtp1.site.com;smtp2.site.com";
$mail->SMTPSecure = "tls";
$mail->SMTPAuth      = true;                  // enable SMTP authentication
$mail->SMTPKeepAlive = true;                  // SMTP connection will not close after each email sent
$mail->Host          = "smtp.office365.com"; // sets the SMTP server
$mail->Port          = 587;                    // set the SMTP port for the GMAIL server
$mail->Username      = "1517985@uqroo.mx"; // SMTP account username
$mail->Password      = "UniQRoo1!_";        // SMTP account password
$mail->SetFrom('1517985@uqroo.mx', 'List manager');
$mail->AddReplyTo('1517985@uqroo.mx', 'List manager');
$mail->AddAddress("1517985@uqroo.mx");
$mail->Subject       = "PHPMailer Test Subject via smtp, basic with authentication";
$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
$mail->MsgHTML("hola");

$exito= $mail->Send();
echo "hola ";
if(!$exito) {
echo "Problemas enviando correo electrónico a ".$valor;
echo "<br/>".$mail->ErrorInfo;
}
else {
echo "Mensaje enviado correctamente";  }  
?>

</body>
</html>
