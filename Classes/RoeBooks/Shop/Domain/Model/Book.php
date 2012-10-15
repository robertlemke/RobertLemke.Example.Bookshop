<?php
namespace RoeBooks\Shop\Domain\Model;

/*                                                                        *
 * This script belongs to the FLOW3 package "RoeBooks.Shop".              *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * A Book
 *
 * @Flow\Entity
 */
class Book {

	/**
	 * The title
	 * @var string
	 * @Flow\Validate(type="StringLength", options={ "minimum"=1, "maximum"=100 })
	 */
	protected $title;

	/**
	 * The price
	 * @var integer
	 * @Flow\Validate(type="NumberRange", options={ "minimum"=1, "maximum"=1000 })
	 */
	protected $price;

	/**
	 * The description
	 * @var string
	 * @ORM\Column(type="text")
	 */
	protected $description;

	/**
	 * The category
	 * @var \RoeBooks\Shop\Domain\Model\Category
	 * @ORM\ManyToOne
	 * @ORM\Column(nullable=true)
	 */
	protected $category;

	/**
	 * Reviews of this book
	 * @var \Doctrine\Common\Collections\Collection<\RoeBooks\Shop\Domain\Model\Review>
	 * @ORM\OneToMany(mappedBy="book")
	 */
	protected $reviews;

	/**
	 * @var \TYPO3\Flow\Resource\Resource
	 * @ORM\ManyToOne
	 * @ORM\Column(nullable=true)
	 */
	protected $image;

	/**
	 * Constructs this book
	 */
	public function __construct() {
		$this->reviews = new \Doctrine\Common\Collections\ArrayCollection();
	}

	/**
	 * Get the Book's title
	 *
	 * @return string The Book's title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets this Book's title
	 *
	 * @param string $title The Book's title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Get the Book's price
	 *
	 * @return integer The Book's price
	 */
	public function getPrice() {
		return $this->price;
	}

	/**
	 * Sets this Book's price
	 *
	 * @param integer $price The Book's price
	 * @return void
	 */
	public function setPrice($price) {
		$this->price = $price;
	}

	/**
	 * Get the Book's description
	 *
	 * @return string The Book's description
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Sets this Book's description
	 *
	 * @param string $description The Book's description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Get the Book's category
	 *
	 * @return \RoeBooks\Shop\Domain\Model\Category The Book's category
	 */
	public function getCategory() {
		return $this->category;
	}

	/**
	 * Sets this Book's category
	 *
	 * @param \RoeBooks\Shop\Domain\Model\Category $category The Book's category
	 * @return void
	 */
	public function setCategory(Category $category) {
		$this->category = $category;
	}

	/**
	 * @param \TYPO3\Flow\Resource\Resource $image
	 */
	public function setImage(\TYPO3\Flow\Resource\Resource $image) {
		$this->image = $image;
	}

	/**
	 * @return \TYPO3\Flow\Resource\Resource
	 */
	public function getImage() {
		return $this->image;
	}


}
?>
