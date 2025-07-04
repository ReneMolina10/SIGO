<?php

require_once (dirname(__FILE__) . '/../federation/FederatedLoginManager.php');
require_once (dirname(__FILE__) . '/TrustedIssuersRepository.php');

class ConfigurableFederatedLoginManager extends FederatedLoginManager {

	protected function getAudienceUris() {
		$repository = new TrustedIssuersRepository();
		$trustedIssuers = $repository->getTrustedIdentityProviderUrls();
				
		if ($this->audience === null) {
			$repository = new TrustedIssuersRepository();
			$trustedIssuers = $repository->getTrustedIdentityProviderUrls();
			
			$mapSpn = function($issuer){
				return($issuer->spn);
			};
						
			return array_map($mapSpn, $trustedIssuers);
		} else {
			return FederatedConfiguration :: getInstance()->getAudienceUris();
		}
	}
}
?>
