<?php
namespace RobertLemke\Example\Bookshop\Command;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "RobertLemke.Example.Bookshop".*
 *                                                                        *
 *                                                                        */

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Cli\CommandController;
use Neos\Flow\Security\AccountFactory;
use Neos\Flow\Security\AccountRepository;
use Neos\Party\Domain\Model\PersonName;
use Neos\Party\Domain\Repository\PartyRepository;
use RobertLemke\Example\Bookshop\Domain\Model\User;

/**
 * Account command controller for the RobertLemke.Example.Bookshop package
 *
 * @Flow\Scope("singleton")
 */
class AccountCommandController extends CommandController
{

    /**
     * @Flow\Inject
     * @var AccountFactory
     */
    protected $accountFactory;

    /**
     * @Flow\Inject
     * @var AccountRepository
     */
    protected $accountRepository;

    /**
     * @Flow\Inject
     * @var PartyRepository
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
     */
    public function createCommand($accountIdentifier, $password, $role = 'RobertLemke.Example.Bookshop:Administrator', $outputHash = FALSE)
    {
        $account = $this->accountFactory->createAccountWithPassword($accountIdentifier, $password, array($role));
        $this->accountRepository->add($account);

        $user = new User($role, 'Robert Lemke');
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
