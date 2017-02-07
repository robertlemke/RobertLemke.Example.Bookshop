<?php
namespace RobertLemke\Example\Bookshop\Controller;

/*
 * This script belongs to the Flow package "RobertLemke.Example.Bookshop".
 */

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Mvc\Controller\ActionController;
use RobertLemke\Example\Bookshop\Domain\Model\Basket;
use RobertLemke\Example\Bookshop\Domain\Model\Book;

/**
 * Basket controller for the RobertLemke.Example.Bookshop package
 * @Flow\Scope("singleton")
 */
class BasketController extends ActionController
{

    /**
     * @Flow\Inject
     * @var Basket
     */
    protected $basket;

    /**
     *
     */
    public function indexAction()
    {
        $this->view->assign('basket', $this->basket);
    }

    /**
     * Adds a book to the shopping basket
     *
     * @param Book $book
     * @return void
     */
    public function addAction(Book $book)
    {
        $this->basket->addBook($book);
        $this->addFlashMessage('Added "' . $book->getTitle() . '" to your shopping basket.');
        $this->redirect('index', 'Book');
    }

    /**
     * Removes a book from the shopping basket
     *
     * @param Book $book
     * @return void
     */
    public function removeAction(Book $book)
    {
        $this->basket->removeBook($book);
        $this->addFlashMessage('Removed "' . $book->getTitle() . '" from your shopping basket.');
        $this->redirect('index');
    }

}

?>
