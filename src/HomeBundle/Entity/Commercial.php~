<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commercial
 *
 * @ORM\Table(name="commercial", uniqueConstraints={@ORM\UniqueConstraint(name="commercial_name", columns={"commercial_name", "commercial_tin", "user_id", "userType_id"})}, indexes={@ORM\Index(name="user_id", columns={"user_id"}), @ORM\Index(name="userType_id", columns={"userType_id"}), @ORM\Index(name="commercialParent_id", columns={"commercialParent_id"}), @ORM\Index(name="commercial_funding", columns={"commercial_funding"})})
 * @ORM\Entity
 */
class Commercial
{
    /**
     * @var integer
     *
     * @ORM\Column(name="commercial_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $commercialId;

    /**
     * @var string
     *
     * @ORM\Column(name="commercial_name", type="string", length=255, nullable=false)
     */
    private $commercialName;

    /**
     * @var string
     *
     * @ORM\Column(name="commercial_logo", type="string", length=255, nullable=false)
     */
    private $commercialLogo;

    /**
     * @var integer
     *
     * @ORM\Column(name="commercial_tin", type="integer", nullable=false)
     */
    private $commercialTin;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     * })
     */
    private $user;

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
     * @var \Commercial
     *
     * @ORM\ManyToOne(targetEntity="Commercial")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="commercialParent_id", referencedColumnName="commercial_id")
     * })
     */
    private $commercialparent;

    /**
     * @var \Price
     *
     * @ORM\ManyToOne(targetEntity="Price")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="commercial_funding", referencedColumnName="price_id")
     * })
     */
    private $commercialFunding;



    /**
     * Get commercialId
     *
     * @return integer
     */
    public function getCommercialId()
    {
        return $this->commercialId;
    }

    /**
     * Set commercialName
     *
     * @param string $commercialName
     *
     * @return Commercial
     */
    public function setCommercialName($commercialName)
    {
        $this->commercialName = $commercialName;

        return $this;
    }

    /**
     * Get commercialName
     *
     * @return string
     */
    public function getCommercialName()
    {
        return $this->commercialName;
    }

    /**
     * Set commercialLogo
     *
     * @param string $commercialLogo
     *
     * @return Commercial
     */
    public function setCommercialLogo($commercialLogo)
    {
        $this->commercialLogo = $commercialLogo;

        return $this;
    }

    /**
     * Get commercialLogo
     *
     * @return string
     */
    public function getCommercialLogo()
    {
        return $this->commercialLogo;
    }

    /**
     * Set commercialTin
     *
     * @param integer $commercialTin
     *
     * @return Commercial
     */
    public function setCommercialTin($commercialTin)
    {
        $this->commercialTin = $commercialTin;

        return $this;
    }

    /**
     * Get commercialTin
     *
     * @return integer
     */
    public function getCommercialTin()
    {
        return $this->commercialTin;
    }

    /**
     * Set user
     *
     * @param \HomeBundle\Entity\User $user
     *
     * @return Commercial
     */
    public function setUser(\HomeBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \HomeBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set usertype
     *
     * @param \HomeBundle\Entity\Usertype $usertype
     *
     * @return Commercial
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

    /**
     * Set commercialparent
     *
     * @param \HomeBundle\Entity\Commercial $commercialparent
     *
     * @return Commercial
     */
    public function setCommercialparent(\HomeBundle\Entity\Commercial $commercialparent = null)
    {
        $this->commercialparent = $commercialparent;

        return $this;
    }

    /**
     * Get commercialparent
     *
     * @return \HomeBundle\Entity\Commercial
     */
    public function getCommercialparent()
    {
        return $this->commercialparent;
    }

    /**
     * Set commercialFunding
     *
     * @param \HomeBundle\Entity\Price $commercialFunding
     *
     * @return Commercial
     */
    public function setCommercialFunding(\HomeBundle\Entity\Price $commercialFunding = null)
    {
        $this->commercialFunding = $commercialFunding;

        return $this;
    }

    /**
     * Get commercialFunding
     *
     * @return \HomeBundle\Entity\Price
     */
    public function getCommercialFunding()
    {
        return $this->commercialFunding;
    }
}
