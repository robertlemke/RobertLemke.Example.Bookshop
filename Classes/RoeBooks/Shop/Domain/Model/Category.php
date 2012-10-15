<?php
namespace RoeBooks\Shop\Domain\Model;

/*                                                                        *
 * This script belongs to the FLOW3 package "RoeBooks.Shop".              *
 *                                                                        *
 *                                                                        */

use TYPO3\FLOW3\Annotations as FLOW3;
use Doctrine\ORM\Mapping as ORM;

/**
 * A Category
 *
 * @FLOW3\Entity
 */
class Category {

	/**
	 * The name
	 * @var string
	 */
	protected $name;


	/**
	 * Get the Category's name
	 *
	 * @return string The Category's name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Sets this Category's name
	 *
	 * @param string $name The Category's name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

}
?>