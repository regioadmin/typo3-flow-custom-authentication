<?php
namespace WL\Demo\Command;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "RobertLemke.Example.Bookshop".*
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Party\Domain\Model\Person;
use TYPO3\Party\Domain\Model\PersonName;

/**
 * Account command controller for this package
 *
 * @Flow\Scope("singleton")
 */
class AccountCommandController extends \TYPO3\Flow\Cli\CommandController {

	/**
	 * @Flow\Inject
	 * @var TYPO3\Flow\Security\AccountFactory
	 */
	protected $accountFactory;

	/**
	 * @Flow\Inject
	 * @var TYPO3\Flow\Security\AccountRepository
	 */
	protected $accountRepository;

	/**
	 * @Flow\Inject
	 * @var TYPO3\Party\Domain\Repository\PartyRepository
	 */
	protected $partyRepository;

	/**
	 * Creates an admin account
	 *
	 * This command creates a <u>new account</u> with Administrator rights for the
	 * package.
	 *
	 * @param string $accountIdentifier The account identifier
	 * @param string $password The password
	 * @param string $role The role to set for the new account
	 * @param boolean $outputHash If the credentials source should be displayed
	 * @return void
	 */
	public function createAdminCommand($accountIdentifier, $password, $role = 'WL.Demo:Administrator', $outputHash = FALSE) {
		$account = $this->accountFactory->createAccountWithPassword($accountIdentifier, $password, array($role));
		$this->accountRepository->add($account);

		$user = new Person();
		$user->addAccount($account);

		$name = new PersonName('', 'Max', '', 'Headroom');
		$user->setName($name);

		$this->partyRepository->add($user);

		$this->outputLine('Created a new account.');
		if ($outputHash) {
			$this->outputLine('The credentials source is: %s', array($account->getCredentialsSource()));
		}
	}
}

?>