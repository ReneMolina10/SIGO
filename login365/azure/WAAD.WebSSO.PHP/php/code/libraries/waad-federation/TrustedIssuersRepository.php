<?php

require_once ('TrustedIssuer.php');

class TrustedIssuersRepository {
	private $repositoryFileName;
	
	public function __construct($repositoryFileName = null) {
		if (!isset($repositoryFileName)) {
			$this->repositoryFileName =  "trustedIssuers.xml";
		} else {
			$this->repositoryFileName = $repositoryFileName;
		}
	}
	
	private function GetBasePath() {
		return substr($_SERVER['SCRIPT_FILENAME'], 0, strlen($_SERVER['SCRIPT_FILENAME']) - strlen(strrchr($_SERVER['SCRIPT_FILENAME'], "\\")));
	}
	
	public function getTrustedIdentityProviderUrls() {
		$xml = new XMLReader();
		$xml->open($this->repositoryFileName);
		
		$trustedIssuers = array ();
		
		while ($xml->read()) {
			if ($xml->nodeType == XMLReader::ELEMENT && $xml->name == "issuer") {				
				array_push($trustedIssuers, new TrustedIssuer($xml->getAttribute("name"), $xml->getAttribute("displayName"), $xml->getAttribute("realm")));
			}			
		}
		
		return $trustedIssuers;
	}
	
	public function getTrustedIdentityProviderUrl($name, $replyUrl) {		
		$xml = new XMLReader();
		$xml->open($this->repositoryFileName);
		
		$trustedIssuers = array ();
		
		while ($xml->read()) {
			if ($xml->nodeType == XMLReader::ELEMENT && $xml->name == "issuer" && $xml->getAttribute("name") == $name) {
				return new TrustedIssuer($xml->getAttribute("name"), $xml->getAttribute("displayName"), $xml->getAttribute("realm"), $replyUrl);
			}
		}
		
		return null;		
	}
}
?>