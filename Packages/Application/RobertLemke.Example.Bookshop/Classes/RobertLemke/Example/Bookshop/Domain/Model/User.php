<?php
namespace RobertLemke\Example\Bookshop\Domain\Model;

/*                                                                        *
 * This script belongs to the FLOW3 package "RobertLemke.Example.Bookshop".              *
 *                                                                        *
 *                                                                        */

use Neos\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;
use TYPO3\Party\Domain\Model\Person;

/**
 * A User
 *
 * @Flow\Entity
 */
class User extends Person {

	/**
	 * @var string
	 */
	protected $department;

	/**
	 * @param string $department
	 */
	public function setDepartment($department) {
		$this->department = $department;
	}

	/**
	 * @return string
	 */
	public function getDepartment() {
		return $this->department;
	}

}
?>