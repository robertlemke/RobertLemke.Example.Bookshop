<?php
namespace RoeBooks\Shop\Controller;

/*                                                                        *
 * This script belongs to the FLOW3 package "RoeBooks.Shop".              *
 *                                                                        *
 *                                                                        */

use TYPO3\FLOW3\Annotations as FLOW3;

use TYPO3\FLOW3\Mvc\Controller\ActionController;
use \RoeBooks\Shop\Domain\Model\Book;

/**
 * Book controller for the RoeBooks.Shop package
 *
 * @FLOW3\Scope("singleton")
 */
class BookController extends ActionController {

	/**
	 * @FLOW3\Inject
	 * @var \RoeBooks\Shop\Domain\Repository\BookRepository
	 */
	protected $bookRepository;

	/**
	 * @FLOW3\Inject
	 * @var \RoeBooks\Shop\Domain\Repository\CategoryRepository
	 */
	protected $categoryRepository;

	/**
	 * @FLOW3\Inject
	 * @var \RoeBooks\Shop\Domain\Model\Basket
	 */
	protected $basket;

	/**
	 * A hacky way to implement a menu
	 *
	 * @return void
	 */
	public function initializeView(\TYPO3\FLOW3\Mvc\View\ViewInterface $view) {
		$view->assign('controller', array('book' => TRUE));
		$view->assign('categories', $this->categoryRepository->findAll());
		$view->assign('basket', $this->basket);
	}

	/**
	 * Shows a list of books
	 *
	 * @return void
	 */
	public function indexAction() {
		$this->view->assign('books', $this->bookRepository->findAll());
	}

	/**
	 * Shows a single book object
	 *
	 * @param \RoeBooks\Shop\Domain\Model\Book $book The book to show
	 * @return void
	 */
	public function showAction(Book $book) {
		$this->view->assign('book', $book);
	}

	/**
	 * Shows a form for creating a new book object
	 *
	 * @return void
	 */
	public function newAction() {
	}

	/**
	 * Adds the given new book object to the book repository
	 *
	 * @param \RoeBooks\Shop\Domain\Model\Book $newBook A new book to add
	 * @return void
	 */
	public function createAction(Book $newBook) {
		$this->bookRepository->add($newBook);
		$this->addFlashMessage('Created a new book.');
		$this->redirect('index');
	}

	/**
	 * Shows a form for editing an existing book object
	 *
	 * @param \RoeBooks\Shop\Domain\Model\Book $book The book to edit
	 * @return void
	 */
	public function editAction(Book $book) {
		$this->view->assign('book', $book);
	}

	/**
	 * Updates the given book object
	 *
	 * @param \RoeBooks\Shop\Domain\Model\Book $book The book to update
	 * @return void
	 */
	public function updateAction(Book $book) {
		$this->bookRepository->update($book);
		$this->addFlashMessage('Updated the book.');
		$this->redirect('index');
	}

	/**
	 * Removes the given book object from the book repository
	 *
	 * @param \RoeBooks\Shop\Domain\Model\Book $book The book to delete
	 * @return void
	 */
	public function deleteAction(Book $book) {
		$this->bookRepository->remove($book);
		$this->addFlashMessage('Deleted a book.');
		$this->redirect('index');
	}

}

?>