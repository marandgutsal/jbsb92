<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Keywordvehicletype
 *
 * @ORM\Table(name="keywordVehicleType", indexes={@ORM\Index(name="keyword_id", columns={"keyword_id"}), @ORM\Index(name="language_id", columns={"language_id"}), @ORM\Index(name="keywordvehicletype_ibfk_3", columns={"vehicleType_id"})})
 * @ORM\Entity
 */
class Keywordvehicletype
{
    /**
     * @var integer
     *
     * @ORM\Column(name="keywordVehicleType_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $keywordvehicletypeId;

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
     * @var \Vehicletype
     *
     * @ORM\ManyToOne(targetEntity="Vehicletype")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="vehicleType_id", referencedColumnName="vehicleType_id")
     * })
     */
    private $vehicletype;



    /**
     * Get keywordvehicletypeId
     *
     * @return integer
     */
    public function getKeywordvehicletypeId()
    {
        return $this->keywordvehicletypeId;
    }

    /**
     * Set keyword
     *
     * @param \HomeBundle\Entity\Keyword $keyword
     *
     * @return Keywordvehicletype
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
     * @return Keywordvehicletype
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

    /**
     * Set vehicletype
     *
     * @param \HomeBundle\Entity\Vehicletype $vehicletype
     *
     * @return Keywordvehicletype
     */
    public function setVehicletype(\HomeBundle\Entity\Vehicletype $vehicletype = null)
    {
        $this->vehicletype = $vehicletype;

        return $this;
    }

    /**
     * Get vehicletype
     *
     * @return \HomeBundle\Entity\Vehicletype
     */
    public function getVehicletype()
    {
        return $this->vehicletype;
    }
}
