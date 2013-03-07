<?php
namespace RobertLemke\Example\Bookshop\Tests\Functional;

/*                                                                        *
 * This script belongs to the TYPO3 Flow framework.                       *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License, either version 3   *
 * of the License, or (at your option) any later version.                 *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use RobertLemke\Example\Bookshop\Domain\Model\Book;
use TYPO3\Flow\Http\Client\Browser;
use TYPO3\Flow\Mvc\Routing\Route;
use TYPO3\Flow\Http\Request;
use TYPO3\Flow\Http\Response;
use TYPO3\Flow\Http\Uri;

/**
 * Functional tests for the ActionController
 */
class HomepageTest extends \TYPO3\Flow\Tests\FunctionalTestCase {

	/**
	 * Contains a virtual, preinitialized browser
	 *
	 * @var \TYPO3\Flow\Http\Client\Browser
	 * @api
	 */
	protected $browser;

	/**
	 * @var boolean
	 */
	static protected $testablePersistenceEnabled = TRUE;

	/**
	 * Additional setup: Routes
	 */
	public function setUp() {
		parent::setUp();
	}

	/**
	 * @test
	 */
	public function newBookAppearsOnHomepage() {
		$response = $this->browser->request('http://localhost/robertlemke.example.bookshop/book/index');
		$this->assertNotContains('Book #1', $response->getContent());

		$book = new Book();
		$book->setTitle('Book #1');
		$book->setPrice(10);

		$bookRepository = $this->objectManager->get('RobertLemke\Example\Bookshop\Domain\Repository\BookRepository');
		$bookRepository->add($book);

		$response = $this->browser->request('http://localhost/robertlemke.example.bookshop/book/index');
		$this->assertContains('Book #1', $response->getContent());
	}
}
?>
