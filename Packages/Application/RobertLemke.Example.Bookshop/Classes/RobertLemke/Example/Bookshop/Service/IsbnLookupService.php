<?php
namespace RobertLemke\Example\Bookshop\Service;

/*                                                                        *
 * This script belongs to the FLOW3 package "RobertLemke.Example.Bookshop".              *
 *                                                                        */

use Neos\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;
use Neos\Flow\Http\Client\Browser;
use Neos\Flow\Http\Client\CurlEngine;

/**
 * An ISBN Lookup Service
 *
 * @Flow\Scope("singleton")
 */
class IsbnLookupService {

	/**
	 * @Flow\Inject
	 * @var \Neos\Flow\Http\Client\Browser
	 */
	protected $browser;

	/**
	 * @return array
	 */
	public function getBookInfo($isbn) {
		$this->browser->setRequestEngine(new CurlEngine());
		$response = $this->browser->request('http://isbndb.com/api/books.xml?access_key=CCFEHU64&index1=isbn&value1=' . $isbn);
		$xml = simplexml_load_string($response->getContent());

		$bookData = $xml->xpath('//BookData');
		if (count($bookData)) {
			$bookInfo = array(
				'title' => (string)$bookData[0]->Title,
				'publisher' => (string)$bookData[0]->PublisherText,
				'authors' => (string)$bookData[0]->AuthorsText
			);
		} else {
			$bookInfo = array();
		}
		return $bookInfo;
	}

}
?>