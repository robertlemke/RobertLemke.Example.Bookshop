<?php
namespace RobertLemke\Example\Bookshop\Controller;

/*                                                                        *
 * This script belongs to the FLOW3 package "RobertLemke.Example.Bookshop".              *
 *                                                                        *
 *                                                                        */

use RobertLemke\Example\Bookshop\Domain\Model\Category;
use Neos\Flow\Annotations as Flow;

use Neos\Flow\Mvc\Controller\ActionController;
use \RobertLemke\Example\Bookshop\Domain\Model\Book;
use Neos\Media\Domain\Model\Adjustment\ResizeImageAdjustment;
use Neos\Media\Domain\Model\ImageVariant;
use Neos\Media\Domain\Repository\AssetRepository;

/**
 * Book controller for the RobertLemke.Example.Bookshop package
 *
 * @Flow\Scope("singleton")
 */
class BookController extends ActionController {

	/**
	 * @Flow\Inject
	 * @var \Neos\Cache\Frontend\StringFrontend
	 */
	protected $htmlCache;

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
	 * @var AssetRepository
	 */
	protected $assetRepository;

	/**
	 * @Flow\Inject
	 * @var \RobertLemke\Example\Bookshop\Domain\Model\Basket
	 */
	protected $basket;

	/**
	 * @Flow\Inject
	 * @var \RobertLemke\Example\Bookshop\Service\IsbnLookupService
	 */
	protected $isbnLookupService;

	/**
	 * A hacky way to implement a menu
	 *
	 * @return void
	 */
	public function initializeView(\Neos\Flow\Mvc\View\ViewInterface $view) {
		$view->assign('controller', array('book' => TRUE));
		$view->assign('categories', $this->categoryRepository->findAll());
		$view->assign('basket', $this->basket);
	}

	/**
	 * Shows a list of books
	 *
	 * @param \RobertLemke\Example\Bookshop\Domain\Model\Category $category
	 * @return void
	 */
	public function indexAction(Category $category = NULL) {
		$output = $this->htmlCache->get('BookController_index');
		if ($output === FALSE) {
			if ($category !== NULL) {
				$books = $this->bookRepository->findByCategory($category);
			} else {
				$books = $this->bookRepository->findAll();
			}
			$this->view->assign('books', $books);
			$output = $this->view->render();
#			$this->htmlCache->set('BookController_index', $output);
		}
		return $output;
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
	 * Adds the book specified by an ISBN
	 *
	 * @param array $newBook An array containing an isbn property
	 * @return void
	 */
	public function createIsbnAction(array $newBook) {
		$bookInfo = $this->isbnLookupService->getBookInfo($newBook['isbn']);
		if ($bookInfo === array()) {
			$this->addFlashMessage(sprintf('No book found with ISBN %s.', $newBook['isbn']));
		} else {
			$book = new Book();
			$book->setTitle($bookInfo['title']);
			$book->setDescription('Automatically imported');
			$book->setIsbn($newBook['isbn']);
			$book->setPrice(16);
			$this->bookRepository->add($book);
			$this->addFlashMessage('Created a new book.');
		}
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
