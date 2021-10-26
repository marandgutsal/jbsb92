<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Datamininglocation
 *
 * @ORM\Table(name="dataminingLocation", uniqueConstraints={@ORM\UniqueConstraint(name="location_id", columns={"location_id", "keywordLanguage_id"})}, indexes={@ORM\Index(name="datamininglocation_ibfk_1", columns={"keywordLanguage_id"}), @ORM\Index(name="IDX_E2F4F9F664D218E", columns={"location_id"})})
 * @ORM\Entity
 */
class Datamininglocation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="dataminingLocation_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $datamininglocationId;

    /**
     * @var \Keywordlanguage
     *
     * @ORM\ManyToOne(targetEntity="Keywordlanguage")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="keywordLanguage_id", referencedColumnName="keywordLanguage_id")
     * })
     */
    private $keywordlanguage;

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
     * Get datamininglocationId
     *
     * @return integer
     */
    public function getDatamininglocationId()
    {
        return $this->datamininglocationId;
    }

    /**
     * Set keywordlanguage
     *
     * @param \HomeBundle\Entity\Keywordlanguage $keywordlanguage
     *
     * @return Datamininglocation
     */
    public function setKeywordlanguage(\HomeBundle\Entity\Keywordlanguage $keywordlanguage = null)
    {
        $this->keywordlanguage = $keywordlanguage;

        return $this;
    }

    /**
     * Get keywordlanguage
     *
     * @return \HomeBundle\Entity\Keywordlanguage
     */
    public function getKeywordlanguage()
    {
        return $this->keywordlanguage;
    }

    /**
     * Set location
     *
     * @param \HomeBundle\Entity\Location $location
     *
     * @return Datamininglocation
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
