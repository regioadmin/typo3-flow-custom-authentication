<?php
namespace WL\Demo\Controller;

/*                                                                        *
 * This script belongs to the package "WL.Demo"				              *
 *                                                                        *
 *                                                                        */

use Doctrine\ORM\Mapping as ORM;
use TYPO3\Flow\Annotations as Flow;

/**
 * An action controller with base functionality for all action controllers
 */
abstract class AbstractBaseController extends \TYPO3\Flow\Mvc\Controller\ActionController {

	/**
	 * @param array $settings
	 * @return void
	 */
	public function injectSettings(array $settings) {
		$this->settings = $settings;
	}

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Security\Context
	 */
	protected $securityContext;

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Security\Account
	 */
	protected $account;

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Persistence\PersistenceManagerInterface
	 */
	protected $persistenceManager;

	/**
	 * Initializes the controller before invoking an action method.
	 *
	 * @return void
	 */
	protected function initializeAction() {
	//do some init

		$activeTokens = $this->securityContext->getAuthenticationTokens();
		foreach ($activeTokens as $token) {

			if ($token->isAuthenticated()) {
				$this->account = $token->getAccount();
				//die(\TYPO3\Flow\var_dump($token));
				break;
			}
		}


	}







}

?>