<?php
 //uncomment this to display internal server errors.
error_reporting(E_ALL);
ini_set('display_errors', 'On');
ini_set('include_path', ini_get('include_path').';../../libraries/;');
require_once ('../../libraries/waad-federation/TrustedIssuersRepository.php');

	
	$repository = new TrustedIssuersRepository();
	$trustedIssuers = $repository->getTrustedIdentityProviderUrls();

	foreach ($trustedIssuers as $trustedIssuer) {
		$returnUrl = $_GET['returnUrl'];
		if(false){
			print_r('<li><a href="' . $trustedIssuer->getLoginUrl($returnUrl) . '">' . $trustedIssuer->displayName . '</a></li>');
		}else{
			header("Location:".$trustedIssuer->getLoginUrl($returnUrl));
			exit();
		}
	}
?>
