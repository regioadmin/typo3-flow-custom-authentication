<?php
namespace WL\Demo\Security\Authentication\Token;

/*                                                                        *
 * This script belongs to the WL.Demo				                      *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * An authentication token used for simple username and password authentication.
 */
class Key extends \TYPO3\Flow\Security\Authentication\Token\AbstractToken {

	/**
	 * The key credentials
	 * @var string
	 * @Flow\Transient
	 */
	protected $credentials = array('username' => 'test1','password'=>'test1','hash'=>'');

	/**
	 * Updates credentials from the GET param.
	 *
	 * Note: You need to send email in this POST parameter:
	 *
	 * @param \TYPO3\Flow\Mvc\ActionRequest $actionRequest The current action request
	 * @return void
	 */
	public function updateCredentials(\TYPO3\Flow\Mvc\ActionRequest $actionRequest) {


		$arguments = $actionRequest->getArguments();
		if (array_key_exists('key', $arguments)) 	{
			$this->credentials["key"]=$arguments["key"];
			$this->setAuthenticationStatus(self::AUTHENTICATION_NEEDED);
		}

	}

	/**
	 * Returns a string representation of the token for logging purposes.
	 *
	 * @return string The username credential
	 */
	public function  __toString() {
		return 'username: "' . $this->credentials['username'] . '"';
	}

}
?>