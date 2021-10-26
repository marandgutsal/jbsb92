<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usertypescore
 *
 * @ORM\Table(name="userTypeScore", indexes={@ORM\Index(name="userType_id", columns={"userType_id"})})
 * @ORM\Entity
 */
class Usertypescore
{
    /**
     * @var integer
     *
     * @ORM\Column(name="userTypeScore_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $usertypescoreId;

    /**
     * @var \Usertype
     *
     * @ORM\ManyToOne(targetEntity="Usertype")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="userType_id", referencedColumnName="userType_id")
     * })
     */
    private $usertype;



    /**
     * Get usertypescoreId
     *
     * @return integer
     */
    public function getUsertypescoreId()
    {
        return $this->usertypescoreId;
    }

    /**
     * Set usertype
     *
     * @param \HomeBundle\Entity\Usertype $usertype
     *
     * @return Usertypescore
     */
    public function setUsertype(\HomeBundle\Entity\Usertype $usertype = null)
    {
        $this->usertype = $usertype;

        return $this;
    }

    /**
     * Get usertype
     *
     * @return \HomeBundle\Entity\Usertype
     */
    public function getUsertype()
    {
        return $this->usertype;
    }
}
