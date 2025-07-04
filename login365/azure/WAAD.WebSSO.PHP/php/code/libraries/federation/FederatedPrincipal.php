<?php

class FederatedPrincipal {
	const NameClaimType = 'http://schemas.xmlsoap.org/ws/2005/05/identity/claims/name';
	const EmailClaimType = 'http://schemas.xmlsoap.org/claims/EmailAddress';

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

	public function getClaims() {
		return $this->claims;
	}
}
?>
