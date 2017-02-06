<?php
namespace RobertLemke\Example\Bookshop\Domain\Model;

/*                                                                        *
 * This script belongs to the FLOW3 package "RobertLemke.Example.Bookshop".              *
 *                                                                        *
 *                                                                        */

use Doctrine\ORM\Mapping as ORM;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Package\MetaData\Person;

/**
 * A User
 *
 * @Flow\Entity
 */
class User extends Person
{

    /**
     * @var string
     */
    protected $department;

    /**
     * @param string $department
     */
    public function setDepartment($department)
    {
        $this->department = $department;
    }

    /**
     * @return string
     */
    public function getDepartment()
    {
        return $this->department;
    }

}

?>
