<?php
session_start();
require_once ('../../libraries/waad-federation/ConfigurableFederatedLoginManager.php');



$loginManager = new ConfigurableFederatedLoginManager();

$loginManager->closeAuthenticated();

header("Location:https://login.windows.net/common/oauth2/logout?post_logout_redirect_uri=http://sau.uqroo.mx");


?>