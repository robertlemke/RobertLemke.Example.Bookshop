<?php
namespace RobertLemke\Example\Bookshop\Controller;

/*
 * This script belongs to the Flow package "RobertLemke.Example.Bookshop".
 */

use Neos\Cache\Frontend\StringFrontend;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Mvc\Controller\ActionController;
use Neos\Flow\Mvc\View\ViewInterface;
use Neos\Flow\Property\TypeConverter\PersistentObjectConverter;
use Neos\Flow\ResourceManagement\PersistentResource;
use Neos\Flow\ResourceManagement\ResourceTypeConverter;
use Neos\Media\Domain\Model\AssetCollection;
use Neos\Media\Domain\Model\Image;
use Neos\Media\Domain\Repository\AssetCollectionRepository;
use Neos\Media\Domain\Repository\AssetRepository;
use RobertLemke\Example\Bookshop\Domain\Model\Basket;
use RobertLemke\Example\Bookshop\Domain\Model\Book;
use RobertLemke\Example\Bookshop\Domain\Model\Category;
use RobertLemke\Example\Bookshop\Domain\Repository\BookRepository;
use RobertLemke\Example\Bookshop\Domain\Repository\CategoryRepository;
use RobertLemke\Example\Bookshop\Service\IsbnLookupService;

/**
 * Book controller for the RobertLemke.Example.Bookshop package
 * @Flow\Scope("singleton")
 */
class BookController extends ActionController
{

    /**
     * @Flow\Inject
     * @var StringFrontend
     */
    protected $htmlCache;

    /**
     * @Flow\Inject
     * @var BookRepository
     */
    protected $bookRepository;

    /**
     * @Flow\Inject
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * @Flow\Inject
     * @var AssetRepository
     */
    protected $assetRepository;

    /**
     * @Flow\Inject
     * @var Basket
     */
    protected $basket;

    /**
     * @Flow\Inject
     * @var IsbnLookupService
     */
    protected $isbnLookupService;

    /**
     * @Flow\Inject
     * @var AssetCollectionRepository
     */
    protected $assetCollectionRepository;

    /**
     * @Flow\Inject(lazy=false)
     * @var PersistentObjectConverter
     */
    protected $persistentObjectConverter;

    /**
     * @Flow\Inject(lazy=false)
     * @var ResourceTypeConverter
     */
    protected $resourceTypeConverter;

    /**
     * A hacky way to implement a menu
     *
     * @param ViewInterface $view
     * @return void
     */
    public function initializeView(ViewInterface $view)
    {
        $view->assign('controller', array('book' => TRUE));
        $view->assign('categories', $this->categoryRepository->findAll());
        $view->assign('basket', $this->basket);
    }

    /**
     * Shows a list of books
     *
     * @param Category $category
     * @return string
     */
    public function indexAction(Category $category = NULL)
    {
        $output = $this->htmlCache->get('BookController_index');
        if ($output === FALSE) {
            if ($category !== NULL) {
                $books = $this->bookRepository->findByCategory($category);
            } else {
                $books = $this->bookRepository->findAll();
            }
            $this->view->assign('books', $books);
            $output = $this->view->render();
            # $this->htmlCache->set('BookController_index', $output);
        }
        return $output;
    }

    /**
     * Shows a single book object
     *
     * @param Book $book The book to show
     * @return void
     */
    public function showAction(Book $book)
    {
        $this->view->assign('book', $book);
    }

    /**
     * Shows a form for creating a new book object
     *
     * @return void
     */
    public function newAction()
    {
    }

    /**
     * Adds the given new book object to the book repository
     *
     * @param Book $newBook A new book to add
     * @return void
     */
    public function createAction(Book $newBook)
    {
        $this->bookRepository->add($newBook);
        $this->addFlashMessage('Created a new book.');
        $this->redirect('index');
    }

    /**
     * Adds the book specified by an ISBN
     *
     * @param array $newBook An array containing an isbn property
     * @return void
     */
    public function createIsbnAction(array $newBook)
    {
        $bookInfo = $this->isbnLookupService->getBookInfo($newBook['isbn']);
        if ($bookInfo === array()) {
            $this->addFlashMessage(sprintf('No book found with ISBN %s.', $newBook['isbn']));
        } else {
            $book = new Book();
            $book->setTitle($bookInfo['title']);
            $book->setDescription('Automatically imported');
            $book->setIsbn($newBook['isbn']);
            $book->setPrice(16);
            $this->bookRepository->add($book);
            $this->addFlashMessage('Created a new book.');
        }
        $this->redirect('index');
    }

    /**
     * Shows a form for editing an existing book object
     *
     * @param Book $book The book to edit
     * @return void
     */
    public function editAction(Book $book)
    {
        $this->view->assign('book', $book);
    }

    /**
     * Updates the given book object
     *
     * @param Book $book The book to update
     * @return void
     */
    public function updateAction(Book $book)
    {
        $this->bookRepository->update($book);
        $this->addFlashMessage('Updated the book.');
        $this->redirect('index');
    }

    /**
     * Removes the given book object from the book repository
     *
     * @param Book $book The book to delete
     * @return void
     */
    public function deleteAction(Book $book)
    {
        $this->bookRepository->remove($book);
        $this->addFlashMessage('Deleted a book.');
        $this->redirect('index');
    }

    /**
     * @param Book $book
     */
    public function addSampleImagesAction(Book $book)
    {
        $this->view->assign('book', $book);
    }

    /**
     * @param Book $book
     * @param Image $image
     */
    public function addSampleImageAction(Book $book, Image $image)
    {
        $sampleImagesCollection = $book->getSampleImages();
        if ($sampleImagesCollection === null) {
            $sampleImagesCollection = new AssetCollection('Sample images');
            $this->assetCollectionRepository->add($sampleImagesCollection);
            $book->setSampleImages($sampleImagesCollection);
            $this->bookRepository->update($book);
        } else {
            $this->assetCollectionRepository->update($sampleImagesCollection);
        }

        $sampleImagesCollection->addAsset($image);

        $this->redirect('addSampleImages', 'Book', null, ['book' => $book]);
    }

    /**
     * @param Book $book
     * @param array $imageResources
     */
    public function addMultipleSampleImagesAction(Book $book, array $imageResources)
    {
        $sampleImagesCollection = $book->getSampleImages();
        if ($sampleImagesCollection === null) {
            $sampleImagesCollection = new AssetCollection('Sample images');
            $this->assetCollectionRepository->add($sampleImagesCollection);
            $book->setSampleImages($sampleImagesCollection);
            $this->bookRepository->update($book);
        } else {
            $this->assetCollectionRepository->update($sampleImagesCollection);
        }

        foreach ($imageResources as $imageResource) {
            $resource = $this->resourceTypeConverter->convertFrom($imageResource['resource'], PersistentResource::class);
            $image = new Image($resource);
            $sampleImagesCollection->addAsset($image);
            $this->assetRepository->add($image);
        }

        $this->redirect('addSampleImages', 'Book', null, ['book' => $book]);
    }

    /**
     * @param Book $book
     * @param Image $image
     */
    public function removeSampleImageAction(Book $book, Image $image)
    {
        $sampleImagesCollection = $book->getSampleImages();
        if ($sampleImagesCollection instanceof AssetCollection && $sampleImagesCollection->getAssets()->contains($image)) {
            $sampleImagesCollection->removeAsset($image);
            $this->assetCollectionRepository->update($sampleImagesCollection);
            $this->assetRepository->remove($image);
        }

        $this->redirect('addSampleImages', 'Book', null, ['book' => $book]);
    }
}
