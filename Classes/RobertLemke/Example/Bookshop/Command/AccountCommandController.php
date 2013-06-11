<?php
namespace RobertLemke\Example\Bookshop\Command;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "RobertLemke.Example.Bookshop".*
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use RobertLemke\Example\Bookshop\Domain\Model\User;
use TYPO3\Party\Domain\Model\PersonName;

/**
 * Account command controller for the RobertLemke.Example.Bookshop package
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
	 * Creates an account
	 *
	 * This command creates a <u>new account</u> with Administrator rights for the
	 * Book Shop.
	 *
	 * @param string $accountIdentifier The account identifier
	 * @param string $password The password
	 * @param string $role The role to set for the new account
	 * @param boolean $outputHash If the credentials source should be displayed
	 * @return void
	 * @see typo3:flow:cache:flush
	 */
	public function createCommand($accountIdentifier, $password, $role = 'RobertLemke.Example.BookshopAdministrator', $outputHash = FALSE) {
		$account = $this->accountFactory->createAccountWithPassword($accountIdentifier, $password, array($role));
		$this->accountRepository->add($account);

		$user = new User();
		$user->addAccount($account);

		$user->setDepartment('Workshop');

		$name = new PersonName('', 'Robert', '', 'Lemke');
		$user->setName($name);

		$this->partyRepository->add($user);

		$this->outputLine('Created a new account.');
		if ($outputHash) {
			$this->outputLine('The credentials source is: %s', array($account->getCredentialsSource()));
		}
	}
}

?>