<html>
<head>
<title>PHPMailer - MySQL Database - SMTP basic test with authentication</title>
</head>
<body>

<?php

//error_reporting(E_ALL);
error_reporting(E_STRICT);

date_default_timezone_set('America/Mexico_City');

require_once('../class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail                = new PHPMailer();

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
$mail->MsgHTML($body);

$exito = $mail->Send();
//echo "hola ";

//$intentos=1;

//while ((!$exito) && ($intentos < 5)) { 	sleep(5);

//echo $mail->ErrorInfo;

$exito = $mail->Send();

$intentos++;

//}

if(!$exito) {

echo "Problemas enviando correo electrónico a ".$valor;

echo "<br/>".$mail->ErrorInfo;

}

else {

echo "Mensaje enviado correctamente";  }  

//$exito = $mail->Send();
//$mail->AddStringAttachment($row["photo"], "YourPhoto.jpg");
/*
@MYSQL_CONNECT("localhost","root","password");
@mysql_select_db("my_company");
$query  = "SELECT full_name, email, photo FROM employee WHERE id=$id";
$result = @MYSQL_QUERY($query);
/*
while ($row = mysql_fetch_array ($result)) {
  $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
  $mail->MsgHTML($body);
  $mail->AddAddress($row["email"], $row["full_name"]);
  $mail->AddStringAttachment($row["photo"], "YourPhoto.jpg");

  if(!$mail->Send()) {
    echo "Mailer Error (" . str_replace("@", "&#64;", $row["email"]) . ') ' . $mail->ErrorInfo . '<br />';
  } else {
    echo "Message sent to :" . $row["full_name"] . ' (' . str_replace("@", "&#64;", $row["email"]) . ')<br />';
  }
  // Clear all addresses and attachments for next loop
  $mail->ClearAddresses();
  $mail->ClearAttachments();
}
*/
?>

</body>
</html>
