<?php
namespace RoeBooks\Shop\Controller;

/*                                                                        *
 * This script belongs to the FLOW3 package "RoeBooks.Shop".              *
 *                                                                        *
 *                                                                        */

use TYPO3\FLOW3\Annotations as FLOW3;

/**
 * Hello controller for the RoeBooks.Shop package
 *
 * @FLOW3\Scope("singleton")
 */
class HelloController extends \TYPO3\FLOW3\Mvc\Controller\ActionController {

	/**
	 * Index action
	 *
	 * @param string $name
	 * @return string
	 */
	public function indexAction($name) {
		$this->response->setHeader('X-Coffee', 'Arabica/without-sugar');
		$this->response->getHeaders()->setCacheControlDirective('max-age', 500);
		$this->response->setExpires(new \DateTime('tomorrow'));
		return sprintf('Hello %s', $this->request->getFormat());
	}

	/**
	 * @return string
	 */
	public function anotherAction() {
		$this->redirect('index');
	}
}

?>