<?php
// uncomment this to display internal server errors.
 //error_reporting(E_ALL);
// ini_set('display_errors', 'On');
//ini_set('include_path', ini_get('include_path').';../../libraries/;');
require_once ('../../libraries/waad-federation/ConfigurableFederatedLoginManager.php');
session_start();
$token = $_POST['wresult'];

$loginManager = new ConfigurableFederatedLoginManager();

if (!$loginManager->isAuthenticated()) {

	if (isset ($token)) {
		try {
			$loginManager->authenticate($token);
							
		} catch (Exception $e) {
		//echo $token; 
			//print_r($e->getMessage());
			echo "Redireccionando...";
			//echo '<script language="javascript" >location.reload(); </script>';
			echo '<input type="button" value="Regresar al SAU" onClick="document.location.reload(true)">';
			
		}
	} else {
		$returnUrl = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];

		//header('Pragma: no-cache');
		//header('Cache-Control: no-cache, must-revalidate');
		header("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']) . "/login.php?returnUrl=" . $returnUrl."&origen=sau", true, 302);
		exit();
	}
}else{
				header("Location:http://sau.uqroo.mx/valida365.php?logoffice=1&nickname=".$loginManager->getPrincipal()->getName());
				exit();
			
}
?>