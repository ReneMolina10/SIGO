<?php
 //uncomment this to display internal server errors.
// error_reporting(E_ALL);
//ini_set('display_errors', 'On');

ini_set('include_path', ini_get('include_path').';../../libraries/;');
require_once ('libraries/waad-federation/TrustedIssuersRepository.php');

	
	$repository = new TrustedIssuersRepository();
	$trustedIssuers = $repository->getTrustedIdentityProviderUrls();

	foreach ($trustedIssuers as $trustedIssuer) { 
		$returnUrl = $_GET['returnUrl'];
		//if($_GET["origen"]==""){
		if(false){
			print_r('<li><a target="_blank" href="'.$trustedIssuer->getLoginUrl($returnUrl) . '">' . $trustedIssuer->displayName . '[ Clic para continuar ]</a></li>');
		}else{
			header("Location:".$trustedIssuer->getLoginUrl($returnUrl)); 
			//echo "Redireccionando...";
			//echo '<script language="javascript" >window.open("'.$trustedIssuer->getLoginUrl($returnUrl).'","_self")</script>';
			exit();
		}
	}
?>
