<?php
namespace RobertLemke\Example\Bookshop\Domain\Model;

/*                                                                        *
 * This script belongs to the FLOW3 package "RobertLemke.Example.Bookshop".              *
 *                                                                        *
 *                                                                        */

use Doctrine\ORM\Mapping as ORM;
use Neos\Flow\Annotations as Flow;

/**
 * A Review
 *
 * @Flow\Entity
 */
class Review
{

    /**
     * The book
     * @var \RobertLemke\Example\Bookshop\Domain\Model\Book
     * @ORM\ManyToOne(inversedBy="reviews")
     */
    protected $book;

    /**
     * The title
     * @var string
     */
    protected $title;

    /**
     * The author
     * @var string
     */
    protected $author;

    /**
     * The rating
     * @var integer
     */
    protected $rating;

    /**
     * The comment
     * @var string
     * @ORM\Column(type="text")
     */
    protected $comment;


    /**
     * Get the Review's book
     *
     * @return \RobertLemke\Example\Bookshop\Domain\Model\Book The Review's book
     */
    public function getBook()
    {
        return $this->book;
    }

    /**
     * Sets this Review's book
     *
     * @param \RobertLemke\Example\Bookshop\Domain\Model\Book $book The Review's book
     * @return void
     */
    public function setBook($book)
    {
        $this->book = $book;
    }

    /**
     * Get the Review's title
     *
     * @return string The Review's title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets this Review's title
     *
     * @param string $title The Review's title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get the Review's author
     *
     * @return string The Review's author
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Sets this Review's author
     *
     * @param string $author The Review's author
     * @return void
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * Get the Review's rating
     *
     * @return integer The Review's rating
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Sets this Review's rating
     *
     * @param integer $rating The Review's rating
     * @return void
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * Get the Review's comment
     *
     * @return string The Review's comment
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Sets this Review's comment
     *
     * @param string $comment The Review's comment
     * @return void
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

}

?>
