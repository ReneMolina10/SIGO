<?php
//require_once('mailer/src/PHPMailer.php');
require_once('phpmailer/class.phpmailer.php');


//$phpCorreo = new PHPMailer();
//echo "Ok"; 

class Correo{
    var $phpCorreo;
    function __construct() 
    {
       // $this->phpWord = new \PhpOffice\PhpWord\PhpWord();



        $this->phpCorreo = new PHPMailer();

        //return($phpWord );
    }
 
    function getInstancia(){
        return($this->phpCorreo);
    }
}
?>