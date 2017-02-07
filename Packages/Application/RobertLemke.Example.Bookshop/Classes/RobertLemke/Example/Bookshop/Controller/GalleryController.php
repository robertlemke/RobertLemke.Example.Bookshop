<?php
namespace RobertLemke\Example\Bookshop\Controller;

/*
 * This script belongs to the Flow package "RobertLemke.Example.Bookshop".*
 */

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Mvc\Controller\ActionController;
use Neos\Media\Domain\Repository\AssetRepository;
use RobertLemke\Example\Bookshop\Domain\Model\Book;

/**
 * Book controller for the RobertLemke.Example.Bookshop package
 * @Flow\Scope("singleton")
 */
class GalleryController extends ActionController
{

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
     * @Flow\Inject
     * @var AssetRepository
     */
    protected $assetRepository;

    /**
     * @Flow\Inject
     * @var \Neos\Flow\Persistence\PersistenceManagerInterface
     */
    protected $persistenceManager;

    /**
     * A hacky way to implement a menu
     *
     * @return void
     */
    public function initializeView(\Neos\Flow\Mvc\View\ViewInterface $view)
    {
        $view->assign('controller', array('gallery' => TRUE));
        $view->assign('categories', $this->categoryRepository->findAll());
        $view->assign('basket', $this->basket);
    }

    /**
     * Shows a gallery of book covers
     *
     * @return void
     */
    public function indexAction()
    {
        $books = $this->bookRepository->findAll();
        $this->view->assign('books', $books);
    }

    /**
     * Shows a single book object
     *
     * @param Book $book The book to show
     * @return void
     */
    public function showAction(Book $book)
    {
        $image = $book->getImage();
        $variants = $image->getVariants();

        $this->persistenceManager->persistAll();
        $this->view->assign('book', $book);
        $this->view->assign('imageVariant', count($variants) ? current($variants) : NULL);
    }

}

?>
