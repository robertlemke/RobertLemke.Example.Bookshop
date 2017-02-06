<?php
namespace RobertLemke\Example\Bookshop\Domain\Repository;

/*                                                                        *
 * This script belongs to the FLOW3 package "RobertLemke.Example.Bookshop".              *
 *                                                                        *
 *                                                                        */

use Neos\Flow\Annotations as Flow;

/**
 * A repository for Books
 *
 * @Flow\Scope("singleton")
 */
class BookRepository extends \Neos\Flow\Persistence\Repository {

	/**
	 * @Flow\Inject
	 * @var \Neos\Flow\Cache\Frontend\StringFrontend
	 */
	protected $htmlCache;

	public function add($object) {
		parent::add($object);
		$this->htmlCache->remove('BookController_index');
	}

	public function remove($object) {
		parent::remove($object);
		$this->htmlCache->remove('BookController_index');
	}

	public function update($object) {
		parent::update($object);
		$this->htmlCache->remove('BookController_index');
	}


}
?>