<?php
namespace RoeBooks\Shop\Controller;

/*                                                                        *
 * This script belongs to the FLOW3 package "RoeBooks.Shop".              *
 *                                                                        *
 *                                                                        */

use TYPO3\FLOW3\Annotations as FLOW3;

/**
 * Basket controller for the RoeBooks.Shop package
 *
 * @FLOW3\Scope("singleton")
 */
class BasketController extends \TYPO3\FLOW3\Mvc\Controller\ActionController {

	/**
	 * @FLOW3\Inject
	 * @var \RoeBooks\Shop\Domain\Model\Basket
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
	 * @param \RoeBooks\Shop\Domain\Model\Book $book
	 * @return void
	 */
	public function addAction(\RoeBooks\Shop\Domain\Model\Book $book) {
		$this->basket->addBook($book);
		$this->addFlashMessage('Added "' . $book->getTitle() . '" to your shopping basket.');
		$this->redirect('index', 'Book');
	}

	/**
	 * Removes a book from the shopping basket
	 *
	 * @param \RoeBooks\Shop\Domain\Model\Book $book
	 * @return void
	 */
	public function removeAction(\RoeBooks\Shop\Domain\Model\Book $book) {
		$this->basket->removeBook($book);
		$this->addFlashMessage('Removed "' . $book->getTitle() . '" from your shopping basket.');
		$this->redirect('index');
	}

}

?>