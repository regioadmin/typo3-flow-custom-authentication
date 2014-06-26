<?php
namespace WL\Demo\Security\Authentication\Provider;

/*                                                                        *
 * This script belongs to the Wl.Demo Package                       *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use WL\Demo\Security\Authentication\Token\Key;
use TYPO3\Flow\Security\Authentication\TokenInterface;
use TYPO3\Flow\Security\Exception\UnsupportedAuthenticationTokenException;

/**
 * An authentication provider that authenticates
 * WL\Demo\Security\Authentication\Token\Email tokens.
 * The accounts are stored in the Content Repository.
 */
class KeyProvider extends \TYPO3\Flow\Security\Authentication\Provider\AbstractProvider {


	/**
	 * @param array $settings
	 * @return void
	 */
	public function injectSettings(array $settings) {
		$this->settings = $settings;
	}

	/**
	 * @var \TYPO3\Flow\Security\Cryptography\HashService
	 * @Flow\Inject
	 */
	protected $hashService;

	/**
	 * @var \TYPO3\Flow\Security\Context
	 * @Flow\Inject
	 */
	protected $securityContext;

	/**
	 * @var \TYPO3\Flow\Security\AccountRepository
	 * @Flow\Inject
	 */
	protected $accountRepository;


	/**
	 * Returns the class names of the tokens this provider can authenticate.
	 *
	 * @return array
	 */
	public function getTokenClassNames() {
		return array('WL\Demo\Security\Authentication\Token\Key');
	}

	/**
	 * Checks the given token for validity and sets the token authentication status
	 * accordingly (success, wrong credentials or no credentials given).
	 *
	 * @param \TYPO3\Flow\Security\Authentication\TokenInterface $authenticationToken The token to be authenticated
	 * @return void
	 * @throws \TYPO3\Flow\Security\Exception\UnsupportedAuthenticationTokenException
	 */
	public function authenticate(\TYPO3\Flow\Security\Authentication\TokenInterface $authenticationToken) {
		if (!($authenticationToken instanceof \WL\Demo\Security\Authentication\Token\Key)) {
			throw new \TYPO3\Flow\Security\Exception\UnsupportedAuthenticationTokenException('This provider cannot authenticate the given token.', 1217339840);
		}

		$account = NULL;
		$credentials = $authenticationToken->getCredentials();

		if ($credentials["key"]=="valid") {
			$providerName = $this->name;
			$providerName = $this->name;
			$account = $this->accountRepository->findActiveByAccountIdentifierAndAuthenticationProviderName($credentials['username'], $providerName);
			$authenticationToken->setAuthenticationStatus(TokenInterface::AUTHENTICATION_SUCCESSFUL);
			$authenticationToken->setAccount($account);
		}
		else
		{
			if ($authenticationToken->getAuthenticationStatus()!= TokenInterface::AUTHENTICATION_SUCCESSFUL) {
				$authenticationToken->setAuthenticationStatus(TokenInterface::NO_CREDENTIALS_GIVEN);
			}
		}


	}

}
?>