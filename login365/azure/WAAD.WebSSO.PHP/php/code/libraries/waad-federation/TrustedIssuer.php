<?php

require_once ('../../libraries/federation/FederatedLoginManager.php');

class TrustedIssuer {
	public $name;
	public $displayName;
	public $spn;
	public $replyUrl;
		
	public function __construct($name, $displayName, $spn, $replyUrl = null) {
		$this->name = $name;
		$this->displayName = $displayName;
		$this->spn = $spn;
		$this->replyUrl = $replyUrl;
	}
	
	public function getLoginUrl($returnUrl) {
		return FederatedLoginManager :: getFederatedCustomLoginUrl($this->spn, $this->replyUrl, $returnUrl);
	}
}
?>