<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Login
 *
 * @ORM\Table(name="logIn", indexes={@ORM\Index(name="user_id", columns={"user_id"})})
 * @ORM\Entity
 */
class Login
{
    /**
     * @var integer
     *
     * @ORM\Column(name="logIn_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $loginId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="logIn_hour", type="datetime", nullable=false)
     */
    private $loginHour;

    /**
     * @var string
     *
     * @ORM\Column(name="logIn_geolocalization", type="string", length=255, nullable=false)
     */
    private $loginGeolocalization;

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
     * Get loginId
     *
     * @return integer
     */
    public function getLoginId()
    {
        return $this->loginId;
    }

    /**
     * Set loginHour
     *
     * @param \DateTime $loginHour
     *
     * @return Login
     */
    public function setLoginHour($loginHour)
    {
        $this->loginHour = $loginHour;

        return $this;
    }

    /**
     * Get loginHour
     *
     * @return \DateTime
     */
    public function getLoginHour()
    {
        return $this->loginHour;
    }

    /**
     * Set loginGeolocalization
     *
     * @param string $loginGeolocalization
     *
     * @return Login
     */
    public function setLoginGeolocalization($loginGeolocalization)
    {
        $this->loginGeolocalization = $loginGeolocalization;

        return $this;
    }

    /**
     * Get loginGeolocalization
     *
     * @return string
     */
    public function getLoginGeolocalization()
    {
        return $this->loginGeolocalization;
    }

    /**
     * Set user
     *
     * @param \HomeBundle\Entity\User $user
     *
     * @return Login
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
}
