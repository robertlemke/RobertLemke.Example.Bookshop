<?php
namespace RobertLemke\Example\Bookshop\Controller;

/*                                                                        *
 * This script belongs to the FLOW3 package "RobertLemke.Example.Bookshop".              *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

use TYPO3\Flow\Mvc\Controller\ActionController;
use \RobertLemke\Example\Bookshop\Domain\Model\Book;

/**
 * Book controller for the RobertLemke.Example.Bookshop package
 *
 * @Flow\Scope("singleton")
 */
class BookController extends ActionController {

	/**
	 * @Flow\Inject
	 * @var \RobertLemke\Example\Bookshop\Domain\Repository\BookRepository
	 */
	protected $bookRepository;

	/**
	 * @Flow\Inject
	 * @var \RobertLemke\Example\Bookshop\Domain\Repository\CategoryRepository
	 */
	protected $categoryRepository;

	/**
	 * @Flow\Inject
	 * @var \RobertLemke\Example\Bookshop\Domain\Model\Basket
	 */
	protected $basket;

	/**
	 * A hacky way to implement a menu
	 *
	 * @return void
	 */
	public function initializeView(\TYPO3\Flow\Mvc\View\ViewInterface $view) {
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
	 * @param \RobertLemke\Example\Bookshop\Domain\Model\Book $book The book to show
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
	 * @param \RobertLemke\Example\Bookshop\Domain\Model\Book $newBook A new book to add
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
	 * @param \RobertLemke\Example\Bookshop\Domain\Model\Book $book The book to edit
	 * @return void
	 */
	public function editAction(Book $book) {
		$this->view->assign('book', $book);
	}

	/**
	 * Updates the given book object
	 *
	 * @param \RobertLemke\Example\Bookshop\Domain\Model\Book $book The book to update
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
	 * @param \RobertLemke\Example\Bookshop\Domain\Model\Book $book The book to delete
	 * @return void
	 */
	public function deleteAction(Book $book) {
		$this->bookRepository->remove($book);
		$this->addFlashMessage('Deleted a book.');
		$this->redirect('index');
	}

}

?>