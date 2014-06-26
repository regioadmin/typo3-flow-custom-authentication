<?php
namespace WL\Demo\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "WL.Demo".               *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

class StandardController extends AbstractBaseController {
//class StandardController extends \TYPO3\Flow\Mvc\Controller\ActionController {

	/**
	 * @return void
	 */
	public function showAction() {
		$this->view->assign("tokens",$this->securityContext->getAuthenticationTokens());
		$this->view->assign("account",$this->account);
	}

	/**
	 * @return void
	 */
	public function indexAction() {
		$this->view->assign('foos', array(
			'bar', 'baz'
		));
	}
}