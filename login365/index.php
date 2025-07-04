<?php
// uncomment this to display internal server errors.
 //error_reporting(E_ALL);
//ini_set('display_errors', 'On');

//ini_set('include_path', ini_get('include_path').';../../libraries/;');
require_once ('libraries/waad-federation/ConfigurableFederatedLoginManager.php');

session_start();
if(isset($_POST['wresult'])){ 
	$token = $_POST['wresult'];
}
if(isset($_GET["origen"])){ 
	if($_GET["origen"]!=""){
		$_SESSION["origen"]=$_GET["origen"];
	}
}
//echo "Ant c";
//include("certificados.php");
//echo "Des c";


$_SESSION["mensaje"] = "Hola a todos";
$loginManager = new ConfigurableFederatedLoginManager();
//echo "-->".$_POST['wctx'];

if (!$loginManager->isAuthenticated()) {

	if (isset ($token)) {
		try {
			$loginManager->authenticate($token);

			//echo "111 --->".$_SESSION['servidor_origen']; exit();
	//	echo $token;
			header("Location:".$_SESSION['servidor_origen']."?logoffice=2&nickname=".$loginManager->getPrincipal()->getCorreo()."&code=".$_SESSION["code_login"]."&nombre=".$loginManager->getPrincipal()->getNombres()."&apellido=".$loginManager->getPrincipal()->getApellidos())."&code2=".md5($loginManager->getPrincipal()->getCorreo().$_SESSION["code_login"]);
			
							
		} catch (Exception $e) {
			print_r($e->getMessage());
			//echo '<input type="button" value="Regresar al SAU" onClick="document.location.reload(true)">';
			//echo "Redireccionando...";
			//echo "Mensaje: ".$_SESSION["mensaje"];
			//echo "-->".$token;
			/* echo '<script language="javascript" >location.reload(); </script>'; */
		}
	} else {

//echo "2222 --->".$_SESSION['servidor_origen']; exit();
		header("Location:https://gesco.uqroo.mx/login365/login.php?returnUrl=https://gesco.uqroo.mx/login365/login.php", true, 302);

	//	echo "HUBO UN ERROR: <br/>";

	//	echo $token;

		/*
		
		$returnUrl = "http://" . '172.16.2.175/login365' . $_SERVER['PHP_SELF'];

		header('Pragma: no-cache');
		header('Cache-Control: no-cache, must-revalidate');
		

			header("Location: http://" . '172.16.2.175/login365'. dirname($_SERVER['SCRIPT_NAME']) . "/login.php?returnUrl=" . $returnUrl, true, 302);

			*/
//echo "3333 --->".$_SESSION['servidor_origen']; exit();

		exit();
	}
	

				
}else{
			
				//echo "444 --->".$_SESSION['servidor_origen']; exit();

				//header("Location:".$_SESSION['servidor_origen']."?logoffice=1&nickname=".$loginManager->getPrincipal()->getCorreo()."&code=".$_SESSION["code_login"]."&nombre=".$loginManager->getPrincipal()->getNombres()."&apellido=".$loginManager->getPrincipal()->getApellidos())."&code2=".md5($loginManager->getPrincipal()->getCorreo().$_SESSION["code_login"]);


header("Location:https://gesco.uqroo.mx/usuarios/login/ingresao365/?logoffice=1&nickname=".$loginManager->getPrincipal()->getCorreo()."&code=".$_SESSION["code_login"]."&nombre=".$loginManager->getPrincipal()->getNombres()."&apellido=".$loginManager->getPrincipal()->getApellidos())."&code2=".md5($loginManager->getPrincipal()->getCorreo().$_SESSION["code_login"]);


				exit();
				
				
			
}


/*
?>


<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Index Page</title>
</head>
<body>
	<h2>Index Page</h2>
	<h3>Welcome <strong><?php print_r($loginManager->getPrincipal()->getCorreo()); ?></strong>!</h3>
	<h3>Welcome <strong><?php print_r($loginManager->getPrincipal()->getNombres()); ?></strong>!</h3>
	<h3>Welcome <strong><?php print_r($loginManager->getPrincipal()->getApellidos()); ?></strong>!</h3>
	<h4>Claim list:</h4>
	<ul>
<?php 
	foreach ($loginManager->getClaims() as $claim) {
		print_r('<li>' . $claim->toString() . '</li>');
	}
?>
	</ul>
</body>
</html>

<?php */  ?>