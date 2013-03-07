<?php
namespace RobertLemke\Example\Bookshop\Tests\Unit\Domain\Model;

/*                                                                        *
 * This script belongs to the Flow package "RobertLemke.Example.Bookshop".              *
 *                                                                        *
 *                                                                        */

use RobertLemke\Example\Bookshop\Domain\Model\Basket;
use RobertLemke\Example\Bookshop\Domain\Model\Book;

/**
 * Testcase for Basket
 */
class BasketTest extends \TYPO3\Flow\Tests\UnitTestCase {

	/**
	 * @test
	 */
	public function getTotalReturnsZeroOnAnEmptyShoppingBasket() {
		$basket = new Basket();
		$this->assertSame(0, $basket->getTotal());
	}

	/**
	 * @test
	 */
	public function getTotalReturnsPriceOfSingleItemInShoppingBasket() {
		$book = new Book();
		$book->setPrice(10);

		$basket = new Basket();
		$basket->addBook($book);

		$this->assertSame($book->getPrice(), $basket->getTotal());
	}

	/**
	 *
	 */
	public function booksAndTotals() {
		$bookA1 = new Book();
		$bookA1->setPrice(10);
		$bookA2 = new Book();
		$bookA2->setPrice(20);
		$totalA = 30;

		$bookB1 = new Book();
		$bookB1->setPrice(30);
		$bookB2 = new Book();
		$bookB2->setPrice(20);
		$totalB = 50;

		$bookC1 = new Book();
		$bookC1->setPrice(11.4);
		$bookC2 = new Book();
		$bookC2->setPrice(20);
		$totalC = 31.4;

		return array(
			array($bookA1, $bookA2, $totalA),
			array($bookB1, $bookB2, $totalB),
			array($bookC1, $bookC2, $totalC),
		);
	}

	/**
	 * @test
	 * @dataProvider booksAndTotals()
	 */
	public function getTotalReturnsTotalPriceOfTwoItemsInShoppingBasket($book1, $book2, $expectedTotal) {
		$basket = new Basket();
		$basket->addBook($book1);
		$basket->addBook($book2);

		$this->assertSame($expectedTotal, $basket->getTotal());
	}

	/**
	 * @test
	 * @expectedException \RobertLemke\Example\Bookshop\Exception\InvalidBasketOperationException
	 */
	public function removeBookThrowsExceptionOnTryingToRemoveABookWhichHasNotBeenAddedBefore() {
		$book1 = new Book();
		$book2 = new Book();

		$basket = new Basket();
		$basket->addBook($book1);
		$basket->removeBook($book2);
	}
}
?>