<?php 




//Accesos permitidos  {"URL","llave"}
/*
$server[1]=["http://www.uqroo.mx/","456","http://www.uqroo.mx/valida365_v2.php"];
$server[2]=["http://cursos2.uqroo.mx/","789","http://sigc.uqroo.mx/valida365_v2.php"];
$server[3]=["sigc.uqroo.mx","s1gcuqr002014","http://sigc.uqroo.mx/365valida.php"];
$server[4]=["http://updown.uqroo.mx/uqrooftp/index.php","upd0wuqr002014","http://updown.uqroo.mx/uqrooftp/365valida.php"];
$server[5]=["http://www3.uqroo.mx/biblioteca/","bibli0uqr002014","http://www3.uqroo.mx/biblioteca/365valida.php"];
$server[6]=["http://cursos2.uqroo.mx/moodle2/login/index.php","moodle2uqroo2014","http://cursos2.uqroo.mx/moodle2/login/azure.php"];
$server[7]=["http://cursos2.uqroo.mx/moodle/login/index.php","moodle2uqroo2014","http://cursos2.uqroo.mx/moodle/login/azure.php"];

$server[8]=["https://saladeprensa.uqroo.mx/","sala2uqr002014","https://saladeprensa.uqroo.mx/azure.php"];
$server[9]=["https://www5.uqroo.mx","sigcuqr002014","https://www5.uqroo.mx/sigc/365valida.php"];
*/
$server[0]=["http://gestion.uqroo.mx/sad/valida365.php","Wua8ODTez"];
$server[1]=["http://sau.uqroo.mx/valida365_v2.php","s4u2014"];
$server[2]=["http://sigc.uqroo.mx/365valida.php","s1gcuqr002014"];
$server[3]=["https://www5.uqroo.mx/sigc/365valida.php","sigcuqr002014"];
$server[4]=["http://cursos2.uqroo.mx/moodle/login/azure.php","moodle2uqroo2014"];
$server[5]=["http://saladeprensa.uqroo.mx/login_pagina/365valida.php","s4l4pr3ns4"];
$server[6]=["http://formularios.uqroo.mx/sgeg/365valida.php","uqr002014"];
$server[7]=["http://www3.uqroo.mx/biblioteca/365valida.php","bibli0uqr002014"];
$server[8]=["http://formularios.uqroo.mx/tesis/login/validaOffice365","tesisuqr002015"];

$server[9]=["http://gestion.uqroo.mx/gestacad/valida365.php","G35710n_2015"];
$server[10]=["http://www.uqroo.mx/365valida.php","portaluqr002015"];
$server[11]=["http://gestion.uqroo.mx/tableros/365valida.php","tableros2016"];







$ACCESO_UNIVERSAL = "universaluqr002014";


function encrypt($string, $key) {
   $result = '';
   for($i=0; $i<strlen($string); $i++) {
      $char = substr($string, $i, 1);
      $keychar = substr($key, ($i % strlen($key))-1, 1);
      $char = chr(ord($char)+ord($keychar));
      $result.=$char;
   }
   return md5(base64_encode($result));
}
function verificaServidor($servidor,$lista)
{	
	//echo "[".$servidor."]";
	//$encontrado = false;
$encontrado = "universaluqr002014";
	foreach ($lista as $item)
	{
		if($item[0]==$servidor)
			{
				$encontrado = $item[1];
				break;
			}
	}
	
	return($encontrado);
}


if (isset($_GET['code']))
    {
		if (isset($_GET['server']))
		{
			//echo "Servidor: -->".$_GET['server']; exit();
			$servidor =  $_GET['server'];
			$_SESSION['servidor_origen'] = $servidor;
	

		
			$llave = verificaServidor($servidor,$server);
			//echo "-->".$llave; 
			//exit();
			if($llave){
				$_SESSION['llave'] = $llave;
				$_SESSION['code_login'] = encrypt($_GET['code'],$llave);
				$_SESSION['code_login_original'] = $_GET['code'];
			}else{
				echo "Error:".$servidor;
				exit();
			}


		}
/*
		else{
			echo "No server";
			exit();
		}
*/

	
	}

?>