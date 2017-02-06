<?php
namespace RobertLemke\Example\Bookshop\Domain\Model;

/*                                                                        *
 * This script belongs to the FLOW3 package "RobertLemke.Example.Bookshop".              *
 *                                                                        *
 *                                                                        */

use Doctrine\ORM\Mapping as ORM;
use Neos\Flow\Annotations as Flow;

/**
 * A Category
 *
 * @Flow\Entity
 */
class Category
{

    /**
     * The name
     * @var string
     */
    protected $name;


    /**
     * Get the Category's name
     *
     * @return string The Category's name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets this Category's name
     *
     * @param string $name The Category's name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

}

?>
