<?php
// uncomment this to display internal server errors.
// error_reporting(E_ALL);
// ini_set('display_errors', 'On');
//ini_set('include_path', ini_get('include_path').';../../libraries/;');
require_once ('../../libraries/waad-federation/ConfigurableFederatedLoginManager.php');
session_start();
$token = $_POST['wresult'];
if($_GET["origen"]!=""){
	$_SESSION["origen"]=$_GET["origen"];
}
//echo "-->".$token;
$loginManager = new ConfigurableFederatedLoginManager();

if (!$loginManager->isAuthenticated()) {

	if (isset ($token)) {
		try {
			$loginManager->authenticate($token);
							
		} catch (Exception $e) {
			//print_r($e->getMessage());

		}
	} else {
		$returnUrl = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];

		header('Pragma: no-cache');
		header('Cache-Control: no-cache, must-revalidate');
		header("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']) . "/login.php?returnUrl=" . $returnUrl."&origen=".$_SESSION["origen"], true, 302);
		exit();
	}
}else{
			if($_SESSION["origen"]=="sau"){
				header("Location:http://sau.uqroo.mx/valida365.php?logoffice=1&nickname=".$loginManager->getPrincipal()->getName());
				exit();
			}
}
?>