<?php
// uncomment this to display internal server errors.
// error_reporting(E_ALL);
// ini_set('display_errors', 'On');
//ini_set('include_path', ini_get('include_path').';../../libraries/;');
require_once ('libraries/waad-federation/ConfigurableFederatedLoginManager.php');
session_start();
$token = $_POST['wresult'];
if($_GET["origen"]!=""){
	$_SESSION["origen"]=$_GET["origen"];
}
$_SESSION["mensaje"] = "Hola a todos";
$loginManager = new ConfigurableFederatedLoginManager();
//echo "-->".$_POST['wctx'];
if (!$loginManager->isAuthenticated()) {

	if (isset ($token)) {
		try {
			$loginManager->authenticate($token);
			header("Location:http://sau.uqroo.mx/valida365.php?logoffice=1&nickname=".$loginManager->getPrincipal()->getName());
			exit();	
							
		} catch (Exception $e) {
			print_r($e->getMessage());
			//echo '<input type="button" value="Regresar al SAU" onClick="document.location.reload(true)">';
			//echo "Redireccionando...";
			//echo "Mensaje: ".$_SESSION["mensaje"];
			//echo "-->".$token;
			/* echo '<script language="javascript" >location.reload(); </script>'; */
		}
	} else {
		$returnUrl = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];

		header('Pragma: no-cache');
		header('Cache-Control: no-cache, must-revalidate');
		header("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']) . "/login.php?returnUrl=" . $returnUrl."&origen=".$_SESSION["origen"], true, 302);
	
		
		exit();
	}
	

				
}else{
			
				header("Location:http://sau.uqroo.mx/valida365.php?logoffice=1&nickname=".$loginManager->getPrincipal()->getName());
				exit();
			
}
?>