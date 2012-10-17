<?php
namespace RobertLemke\Example\Bookshop\Domain\Model;

/*                                                                        *
 * This script belongs to the FLOW3 package "RobertLemke.Example.Bookshop".              *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * A Basket
 *
 * @Flow\Scope("session")
 */
class Basket {

	/**
	 * The books
	 * @var \Doctrine\Common\Collections\Collection<\RobertLemke\Example\Bookshop\Domain\Model\Book>
	 * @ORM\ManyToMany
	 */
	protected $books;

	/**
	 *
	 */
	public function __construct() {
		$this->books = new \Doctrine\Common\Collections\ArrayCollection();
	}

	/**
	 * Get the Basket's books
	 *
	 * @return \Doctrine\Common\Collections\Collection<\RobertLemke\Example\Bookshop\Domain\Model\Book> The Basket's books
	 */
	public function getBooks() {
		return $this->books;
	}

	/**
	 * Adds a book to the basket
	 *
	 * @param \RobertLemke\Example\Bookshop\Domain\Model\Book $book The book to add
	 * @return void
	 * @Flow\Session(autoStart=true)
	 */
	public function addBook(Book $book) {
		$this->books->add($book);
	}

	/**
	 * Adds a book to the basket
	 *
	 * @param \RobertLemke\Example\Bookshop\Domain\Model\Book $book The book to add
	 * @return void
	 */
	public function removeBook(Book $book) {
		$this->books->removeElement($book);
	}

}
?>