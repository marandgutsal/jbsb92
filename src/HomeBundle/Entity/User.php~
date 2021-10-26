<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user", uniqueConstraints={@ORM\UniqueConstraint(name="user_email", columns={"user_email"}), @ORM\UniqueConstraint(name="user_name", columns={"user_name", "user_email"})}, indexes={@ORM\Index(name="location_id", columns={"location_id"})})
 * @ORM\Entity
 */
class User
{
    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="user_profilePhoto", type="string", length=255, nullable=true)
     */
    private $userProfilephoto;

    /**
     * @var string
     *
     * @ORM\Column(name="user_name", type="string", length=255, nullable=false)
     */
    private $userName;

    /**
     * @var string
     *
     * @ORM\Column(name="user_firstGivenName", type="string", length=100, nullable=false)
     */
    private $userFirstgivenname;

    /**
     * @var string
     *
     * @ORM\Column(name="user_secondGivenName", type="string", length=100, nullable=true)
     */
    private $userSecondgivenname;

    /**
     * @var string
     *
     * @ORM\Column(name="user_firstFamilyName", type="string", length=100, nullable=false)
     */
    private $userFirstfamilyname;

    /**
     * @var string
     *
     * @ORM\Column(name="user_secondFamilyName", type="string", length=100, nullable=true)
     */
    private $userSecondfamilyname;

    /**
     * @var string
     *
     * @ORM\Column(name="user_email", type="string", length=255, nullable=false)
     */
    private $userEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="user_password", type="text", length=65535, nullable=true)
     */
    private $userPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="user_biography", type="text", length=65535, nullable=true)
     */
    private $userBiography;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_score", type="integer", nullable=false)
     */
    private $userScore;

    /**
     * @var \Location
     *
     * @ORM\ManyToOne(targetEntity="Location")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="location_id", referencedColumnName="location_id")
     * })
     */
    private $location;



    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set userProfilephoto
     *
     * @param string $userProfilephoto
     *
     * @return User
     */
    public function setUserProfilephoto($userProfilephoto)
    {
        $this->userProfilephoto = $userProfilephoto;

        return $this;
    }

    /**
     * Get userProfilephoto
     *
     * @return string
     */
    public function getUserProfilephoto()
    {
        return $this->userProfilephoto;
    }

    /**
     * Set userName
     *
     * @param string $userName
     *
     * @return User
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * Get userName
     *
     * @return string
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * Set userFirstgivenname
     *
     * @param string $userFirstgivenname
     *
     * @return User
     */
    public function setUserFirstgivenname($userFirstgivenname)
    {
        $this->userFirstgivenname = $userFirstgivenname;

        return $this;
    }

    /**
     * Get userFirstgivenname
     *
     * @return string
     */
    public function getUserFirstgivenname()
    {
        return $this->userFirstgivenname;
    }

    /**
     * Set userSecondgivenname
     *
     * @param string $userSecondgivenname
     *
     * @return User
     */
    public function setUserSecondgivenname($userSecondgivenname)
    {
        $this->userSecondgivenname = $userSecondgivenname;

        return $this;
    }

    /**
     * Get userSecondgivenname
     *
     * @return string
     */
    public function getUserSecondgivenname()
    {
        return $this->userSecondgivenname;
    }

    /**
     * Set userFirstfamilyname
     *
     * @param string $userFirstfamilyname
     *
     * @return User
     */
    public function setUserFirstfamilyname($userFirstfamilyname)
    {
        $this->userFirstfamilyname = $userFirstfamilyname;

        return $this;
    }

    /**
     * Get userFirstfamilyname
     *
     * @return string
     */
    public function getUserFirstfamilyname()
    {
        return $this->userFirstfamilyname;
    }

    /**
     * Set userSecondfamilyname
     *
     * @param string $userSecondfamilyname
     *
     * @return User
     */
    public function setUserSecondfamilyname($userSecondfamilyname)
    {
        $this->userSecondfamilyname = $userSecondfamilyname;

        return $this;
    }

    /**
     * Get userSecondfamilyname
     *
     * @return string
     */
    public function getUserSecondfamilyname()
    {
        return $this->userSecondfamilyname;
    }

    /**
     * Set userEmail
     *
     * @param string $userEmail
     *
     * @return User
     */
    public function setUserEmail($userEmail)
    {
        $this->userEmail = $userEmail;

        return $this;
    }

    /**
     * Get userEmail
     *
     * @return string
     */
    public function getUserEmail()
    {
        return $this->userEmail;
    }

    /**
     * Set userPassword
     *
     * @param string $userPassword
     *
     * @return User
     */
    public function setUserPassword($userPassword)
    {
        $this->userPassword = $userPassword;

        return $this;
    }

    /**
     * Get userPassword
     *
     * @return string
     */
    public function getUserPassword()
    {
        return $this->userPassword;
    }

    /**
     * Set userBiography
     *
     * @param string $userBiography
     *
     * @return User
     */
    public function setUserBiography($userBiography)
    {
        $this->userBiography = $userBiography;

        return $this;
    }

    /**
     * Get userBiography
     *
     * @return string
     */
    public function getUserBiography()
    {
        return $this->userBiography;
    }

    /**
     * Set userScore
     *
     * @param integer $userScore
     *
     * @return User
     */
    public function setUserScore($userScore)
    {
        $this->userScore = $userScore;

        return $this;
    }

    /**
     * Get userScore
     *
     * @return integer
     */
    public function getUserScore()
    {
        return $this->userScore;
    }

    /**
     * Set location
     *
     * @param \HomeBundle\Entity\Location $location
     *
     * @return User
     */
    public function setLocation(\HomeBundle\Entity\Location $location = null)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return \HomeBundle\Entity\Location
     */
    public function getLocation()
    {
        return $this->location;
    }
}
