<?php
namespace RobertLemke\Example\Bookshop\Tests\Unit\Controller;

/*                                                                        *
 * This script belongs to the FLOW3 package "RobertLemke.Example.Bookshop".              *
 *                                                                        *
 *                                                                        */

/**
 * Testcase for BookController (demo case for mock objects)
 *
 * DON'T TRY THIS AT HOME
 *
 * Usually you don't want to create unit tests for controllers (write functional
 * tests instead)
 */
use RobertLemke\Example\Bookshop\Controller\BookController;
use RobertLemke\Example\Bookshop\Domain\Model\Book;
use RobertLemke\Example\Bookshop\Domain\Model\Category;

class BookControllerTest extends \Neos\Flow\Tests\UnitTestCase
{

    /**
     * @test
     */
    public function indexActionFiltersByCategoryIfCategoryIsSet()
    {
        $mockCache = $this->getMock('Neos\Flow\Cache\StringFrontend', array('get', 'set'), array(), '', FALSE);
        $mockCache->expects($this->any())->method('get')->will($this->returnValue(FALSE));

        $category = new Category();
        $category->setName('Coffee');
        $books = array(
            new Book()
        );

        $mockRepository = $this->getMock('RobertLemke\Example\Bookshop\Domain\Repository\BookRepository',
            array('findByCategory')
        );
        $mockRepository->expects($this->once())->method('findByCategory')->with($category)
            ->will($this->returnValue($books));

        $mockView = $this->getMock('Neos\FluidAdaptor\View\TemplateView', array(), array(), '', FALSE);

        $controller = new BookController();
        $this->inject($controller, 'htmlCache', $mockCache);
        $this->inject($controller, 'bookRepository', $mockRepository);
        $this->inject($controller, 'view', $mockView);

        $mockView->expects($this->once())->method('assign')->with('books', $books);

        $controller->indexAction($category);
    }
}

?>
