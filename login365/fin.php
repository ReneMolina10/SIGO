<?php
session_start();
require_once ('libraries/waad-federation/ConfigurableFederatedLoginManager.php');



$loginManager = new ConfigurableFederatedLoginManager();

$loginManager->closeAuthenticated();

if(isset($_GET["retorno"])==""){
	if($_SERVER['HTTP_REFERER']!=""){
		$part = split("/",$_SERVER['HTTP_REFERER']);
		$servidor = "http://".$part[2];
	}else{
		$servidor =  "http://www.uqroo.mx";
	}
}else{
	$servidor = $_GET["retorno"];
}
		
		

header("Location:https://login.windows.net/common/oauth2/logout?post_logout_redirect_uri=".$servidor) ;


?>