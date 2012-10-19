<?php
namespace RobertLemke\Example\Bookshop\Tests\Unit\Domain\Model;

/*                                                                        *
 * This script belongs to the FLOW3 package "RobertLemke.Example.Bookshop".              *
 *                                                                        *
 *                                                                        */

use RobertLemke\Example\Bookshop\Domain\Model\Basket;
use RobertLemke\Example\Bookshop\Domain\Model\Book;

/**
 * Testcase for Basket
 */
class BasketTest extends \TYPO3\Flow\Tests\UnitTestCase {

	/**
	 * @return array
	 */
	public function books() {
		$book1 = new Book();
		$book1->setPrice(10);
		$book2 = new Book();
		$book2->setPrice(14);
		$book3 = new Book();
		$book3->setPrice(26);
		return array(array($book1), array($book2), array($book3));
	}

	/**
	 * @test
	 * @dataProvider books
	 */
	public function getTotalReturnsPriceOfBookIfBasketContainsOnlyOneBook($book) {
		$basket = new Basket();

		$basket->addBook($book);
		$this->assertEquals($book->getPrice(), $basket->getTotal());
	}

	/**
	 * @test
	 */
	public function getTotalReturnsSumOfPricesForTwoBooks() {
		$basket = new Basket();

		$book1 = new Book();
		$book1->setPrice(10);
		$book2 = new Book();
		$book2->setPrice(14);

		$basket->addBook($book1);
		$basket->addBook($book2);

		$this->assertEquals(24, $basket->getTotal());
	}
}
?>