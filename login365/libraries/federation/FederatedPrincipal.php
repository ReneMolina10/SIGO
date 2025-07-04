<?php

class FederatedPrincipal {
	const NameClaimType = 'http://schemas.xmlsoap.org/ws/2005/05/identity/claims/name';
	const EmailClaimType = 'http://schemas.xmlsoap.org/claims/EmailAddress';
	const NombresClaimType = 'http://schemas.xmlsoap.org/ws/2005/05/identity/claims/givenname';
	const ApellidosClaimType = 'http://schemas.xmlsoap.org/ws/2005/05/identity/claims/surname';
	const CorreoClaimType = 'http://schemas.xmlsoap.org/ws/2005/05/identity/claims/name';
	private $claims = array ();

	public function __construct($claims) {
		$this->claims = $claims;
	}

	public function getName() {
		foreach ($this->claims as $claim) {
			if (strcmp($claim->claimType, FederatedPrincipal :: NameClaimType) === 0)
				return $claim->claimValue;
		}

		foreach ($this->claims as $claim) {
		
			if (strcmp($claim->claimType, FederatedPrincipal :: EmailClaimType) === 0)
				return $claim->claimValue;
		}

		return '';
	}
	public function getCorreo() {
		foreach ($this->claims as $claim) {
			if (strcmp($claim->claimType, FederatedPrincipal :: CorreoClaimType) === 0)
				return $claim->claimValue;
		}

		return '';
	}
	
	public function getNombres() {
		foreach ($this->claims as $claim) {
			if (strcmp($claim->claimType, FederatedPrincipal :: NombresClaimType) === 0)
				return $claim->claimValue;
		}

		return '';
	}
		public function getApellidos() {
		foreach ($this->claims as $claim) {
			if (strcmp($claim->claimType, FederatedPrincipal :: ApellidosClaimType) === 0)
				return $claim->claimValue;
		}

		return '';
	}
	
	
	public function getClaims() {
		return $this->claims;
	}
}
?>
