<?php 
//Accesos permitidos  {"URL","llave"}
$server[0]=["http://sau.uqroo.mx/","123"];
$server[1]=["http://www.uqroo.mx/","456"];
$server[2]=["http://cursos2.uqroo.mx/","789"];
$server[3]=["http://www.uqroo.mx/modelo_form/365acceso.php","uqr002014"];
$server[4]=["http://saladeprensa.uqroo.mx/login_pagina/365valida.php","s4l4pr3ns4"];




function verificaServidor($servidor,$lista)
{
	$encontrado = false;
	$cont=0;
	foreach ($lista as $item)
	{
		if(in_array($servidor,$item))
			{
				$encontrado = $item[1];
				$cont++;
			}
	}
	return($encontrado);
}
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



if (isset($_GET['code']))
    {		
		$llave = verificaServidor($_SERVER['HTTP_REFERER'],$server);
		
		if($llave){
			$_SESSION['code_login'] = encrypt($_GET['code'],$llave);
			$_SESSION["servidor_origen"] = $_SERVER['HTTP_REFERER'];
		}else{
			echo "-->$server";
			echo "Error".$llave;
			exit();
		}
	
	}
	
	

?>