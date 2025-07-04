<?php
// uncomment this to display internal server errors.
// error_reporting(E_ALL);
// ini_set('display_errors', 'On');
//ini_set('include_path', ini_get('include_path').';../../libraries/;');
require_once ('libraries/waad-federation/ConfigurableFederatedLoginManager.php');
session_start();
include("accesos.php");
$token = $_POST['wresult'];
if($_GET["code"]!=""){
	$_SESSION["code"]=$_GET["code"];
}
//echo "-->".$token;
$loginManager = new ConfigurableFederatedLoginManager();

if (!$loginManager->isAuthenticated()) {

	if (isset ($token)) {
		try {
			$loginManager->authenticate($token);
							
		} catch (Exception $e) {
			print_r($e->getMessage());

		}
	} else {
		$returnUrl = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];

		header('Pragma: no-cache');
		header('Cache-Control: no-cache, must-revalidate');
		header("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']) . "/login.php?returnUrl=" . $returnUrl."&origen=".$_SESSION["code"], true, 302);
		exit();
	}
}else{
			
				header("Location:".$_SESSION["servidor_origen"]."/valida365_v2.php?logoffice=1&nickname=".$loginManager->getPrincipal()->getName()."&code=".$_SESSION['code_login'] );
				exit();
			
}
?>