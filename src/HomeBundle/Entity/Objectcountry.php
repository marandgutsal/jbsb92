<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Objectcountry
 *
 * @ORM\Table(name="objectCountry", indexes={@ORM\Index(name="country_id", columns={"country_id"}), @ORM\Index(name="object_id", columns={"object_id"})})
 * @ORM\Entity
 */
class Objectcountry
{
    /**
     * @var integer
     *
     * @ORM\Column(name="objectCountry_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $objectcountryId;

    /**
     * @var integer
     *
     * @ORM\Column(name="objectCountry_score", type="integer", nullable=false)
     */
    private $objectcountryScore;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="objectCountry_lastUpdate", type="datetime", nullable=false)
     */
    private $objectcountryLastupdate;

    /**
     * @var integer
     *
     * @ORM\Column(name="objectCountry_scoreTendency", type="integer", nullable=false)
     */
    private $objectcountryScoretendency;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="objectCountry_dateTendency", type="datetime", nullable=false)
     */
    private $objectcountryDatetendency;

    /**
     * @var \Country
     *
     * @ORM\ManyToOne(targetEntity="Country")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="country_id", referencedColumnName="country_id")
     * })
     */
    private $country;

    /**
     * @var \Object
     *
     * @ORM\ManyToOne(targetEntity="Object")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="object_id", referencedColumnName="object_id")
     * })
     */
    private $object;



    /**
     * Get objectcountryId
     *
     * @return integer
     */
    public function getObjectcountryId()
    {
        return $this->objectcountryId;
    }

    /**
     * Set objectcountryScore
     *
     * @param integer $objectcountryScore
     *
     * @return Objectcountry
     */
    public function setObjectcountryScore($objectcountryScore)
    {
        $this->objectcountryScore = $objectcountryScore;

        return $this;
    }

    /**
     * Get objectcountryScore
     *
     * @return integer
     */
    public function getObjectcountryScore()
    {
        return $this->objectcountryScore;
    }

    /**
     * Set objectcountryLastupdate
     *
     * @param \DateTime $objectcountryLastupdate
     *
     * @return Objectcountry
     */
    public function setObjectcountryLastupdate($objectcountryLastupdate)
    {
        $this->objectcountryLastupdate = $objectcountryLastupdate;

        return $this;
    }

    /**
     * Get objectcountryLastupdate
     *
     * @return \DateTime
     */
    public function getObjectcountryLastupdate()
    {
        return $this->objectcountryLastupdate;
    }

    /**
     * Set objectcountryScoretendency
     *
     * @param integer $objectcountryScoretendency
     *
     * @return Objectcountry
     */
    public function setObjectcountryScoretendency($objectcountryScoretendency)
    {
        $this->objectcountryScoretendency = $objectcountryScoretendency;

        return $this;
    }

    /**
     * Get objectcountryScoretendency
     *
     * @return integer
     */
    public function getObjectcountryScoretendency()
    {
        return $this->objectcountryScoretendency;
    }

    /**
     * Set objectcountryDatetendency
     *
     * @param \DateTime $objectcountryDatetendency
     *
     * @return Objectcountry
     */
    public function setObjectcountryDatetendency($objectcountryDatetendency)
    {
        $this->objectcountryDatetendency = $objectcountryDatetendency;

        return $this;
    }

    /**
     * Get objectcountryDatetendency
     *
     * @return \DateTime
     */
    public function getObjectcountryDatetendency()
    {
        return $this->objectcountryDatetendency;
    }

    /**
     * Set country
     *
     * @param \HomeBundle\Entity\Country $country
     *
     * @return Objectcountry
     */
    public function setCountry(\HomeBundle\Entity\Country $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \HomeBundle\Entity\Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set object
     *
     * @param \HomeBundle\Entity\Object $object
     *
     * @return Objectcountry
     */
    public function setObject(\HomeBundle\Entity\Object $object = null)
    {
        $this->object = $object;

        return $this;
    }

    /**
     * Get object
     *
     * @return \HomeBundle\Entity\Object
     */
    public function getObject()
    {
        return $this->object;
    }
}
