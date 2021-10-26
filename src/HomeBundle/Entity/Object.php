<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Object
 *
 * @ORM\Table(name="object", indexes={@ORM\Index(name="userType_id", columns={"userType_id"}), @ORM\Index(name="keyword_id", columns={"keyword_id"}), @ORM\Index(name="language_id", columns={"language_id"})})
 * @ORM\Entity
 */
class Object
{
    /**
     * @var integer
     *
     * @ORM\Column(name="object_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $objectId;

    /**
     * @var integer
     *
     * @ORM\Column(name="object_score", type="integer", nullable=false)
     */
    private $objectScore;

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
     * @var \Keyword
     *
     * @ORM\ManyToOne(targetEntity="Keyword")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="keyword_id", referencedColumnName="keyword_id")
     * })
     */
    private $keyword;

    /**
     * @var \Language
     *
     * @ORM\ManyToOne(targetEntity="Language")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="language_id", referencedColumnName="language_id")
     * })
     */
    private $language;



    /**
     * Get objectId
     *
     * @return integer
     */
    public function getObjectId()
    {
        return $this->objectId;
    }

    /**
     * Set objectScore
     *
     * @param integer $objectScore
     *
     * @return Object
     */
    public function setObjectScore($objectScore)
    {
        $this->objectScore = $objectScore;

        return $this;
    }

    /**
     * Get objectScore
     *
     * @return integer
     */
    public function getObjectScore()
    {
        return $this->objectScore;
    }

    /**
     * Set usertype
     *
     * @param \HomeBundle\Entity\Usertype $usertype
     *
     * @return Object
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
     * Set keyword
     *
     * @param \HomeBundle\Entity\Keyword $keyword
     *
     * @return Object
     */
    public function setKeyword(\HomeBundle\Entity\Keyword $keyword = null)
    {
        $this->keyword = $keyword;

        return $this;
    }

    /**
     * Get keyword
     *
     * @return \HomeBundle\Entity\Keyword
     */
    public function getKeyword()
    {
        return $this->keyword;
    }

    /**
     * Set language
     *
     * @param \HomeBundle\Entity\Language $language
     *
     * @return Object
     */
    public function setLanguage(\HomeBundle\Entity\Language $language = null)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return \HomeBundle\Entity\Language
     */
    public function getLanguage()
    {
        return $this->language;
    }
}
