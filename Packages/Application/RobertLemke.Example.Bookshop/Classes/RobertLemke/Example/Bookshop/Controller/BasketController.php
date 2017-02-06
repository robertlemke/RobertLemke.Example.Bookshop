<?php
namespace RobertLemke\Example\Bookshop\Controller;

/*                                                                        *
 * This script belongs to the FLOW3 package "RobertLemke.Example.Bookshop".              *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * Basket controller for the RobertLemke.Example.Bookshop package
 *
 * @Flow\Scope("singleton")
 */
class BasketController extends \TYPO3\Flow\Mvc\Controller\ActionController {

	/**
	 * @Flow\Inject
	 * @var \RobertLemke\Example\Bookshop\Domain\Model\Basket
	 */
	protected $basket;

	/**
	 *
	 */
	public function indexAction() {
		$this->view->assign('basket', $this->basket);
	}

	/**
	 * Adds a book to the shopping basket
	 *
	 * @param \RobertLemke\Example\Bookshop\Domain\Model\Book $book
	 * @return void
	 */
	public function addAction(\RobertLemke\Example\Bookshop\Domain\Model\Book $book) {
		$this->basket->addBook($book);
		$this->addFlashMessage('Added "' . $book->getTitle() . '" to your shopping basket.');
		$this->redirect('index', 'Book');
	}

	/**
	 * Removes a book from the shopping basket
	 *
	 * @param \RobertLemke\Example\Bookshop\Domain\Model\Book $book
	 * @return void
	 */
	public function removeAction(\RobertLemke\Example\Bookshop\Domain\Model\Book $book) {
		$this->basket->removeBook($book);
		$this->addFlashMessage('Removed "' . $book->getTitle() . '" from your shopping basket.');
		$this->redirect('index');
	}

}

?>