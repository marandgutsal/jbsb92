<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usertype
 *
 * @ORM\Table(name="userType", uniqueConstraints={@ORM\UniqueConstraint(name="userType_class", columns={"userType_class"})})
 * @ORM\Entity
 */
class Usertype
{
    /**
     * @var integer
     *
     * @ORM\Column(name="userType_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $usertypeId;

    /**
     * @var string
     *
     * @ORM\Column(name="userType_class", type="string", length=255, nullable=false)
     */
    private $usertypeClass;



    /**
     * Get usertypeId
     *
     * @return integer
     */
    public function getUsertypeId()
    {
        return $this->usertypeId;
    }

    /**
     * Set usertypeClass
     *
     * @param string $usertypeClass
     *
     * @return Usertype
     */
    public function setUsertypeClass($usertypeClass)
    {
        $this->usertypeClass = $usertypeClass;

        return $this;
    }

    /**
     * Get usertypeClass
     *
     * @return string
     */
    public function getUsertypeClass()
    {
        return $this->usertypeClass;
    }
}
