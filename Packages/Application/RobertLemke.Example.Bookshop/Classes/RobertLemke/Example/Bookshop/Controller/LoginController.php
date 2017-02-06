<?php
namespace RobertLemke\Example\Bookshop\Controller;

/*                                                                        *
 * This script belongs to the FLOW3 package "RobertLemke.Example.Bookshop".              *
 *                                                                        *
 *                                                                        */

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Security\Authentication\Controller\AbstractAuthenticationController;


/**
 * Login controller for the RobertLemke.Example.Bookshop package
 *
 * @Flow\Scope("singleton")
 */
class LoginController extends AbstractAuthenticationController
{

    /**
     * Is called if authentication was successful. If there has been an
     * intercepted request due to security restrictions, you might want to use
     * something like the following code to restart the originally intercepted
     * request:
     *
     * if ($originalRequest !== NULL) {
     *     $this->redirectToRequest($originalRequest);
     * }
     * $this->redirect('someDefaultActionAfterLogin');
     *
     * @param \Neos\Flow\Mvc\ActionRequest $originalRequest The request that was intercepted by the security framework, NULL if there was none
     * @return string
     */
    protected function onAuthenticationSuccess(\Neos\Flow\Mvc\ActionRequest $originalRequest = NULL)
    {
        $this->redirect('index', 'Book');
    }

    /**
     *
     */
    public function logoutAction()
    {
        parent::logoutAction();
        $this->redirect('index', 'Book');
    }
}

?>
