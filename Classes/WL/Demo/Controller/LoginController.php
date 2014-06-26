<?php
namespace WL\Demo\Controller;

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Security\Authentication\Controller\AbstractAuthenticationController;


	/**
	 * Login controller
	 *
	 * @Flow\Scope("singleton")
	 */
class LoginController extends AbstractAuthenticationController {

	/**
	 * Is called if authentication was successful. If there has been an
	 * intercepted request due to security restrictions, you might want to use
	 * something like the following code to restart the originally intercepted
	 * request:
	 *
	 * if ($originalRequest !== NULL) {
	 *     $this->redirectToRequest($originalRequest);
	 * }
	 * $this->redirect('someDefaultActionAfterLogin');
	 *
	 * @param \TYPO3\Flow\Mvc\ActionRequest $originalRequest The request that was intercepted by the security framework, NULL if there was none
	 * @return string
	 */
	protected function onAuthenticationSuccess(\TYPO3\Flow\Mvc\ActionRequest $originalRequest = NULL) {
		$this->redirect('show', 'Standard');
	}

	/**
	 *
	 */
	public function logoutAction() {
		parent::logoutAction();
		$this->redirect('index', 'Standard');
	}
}


