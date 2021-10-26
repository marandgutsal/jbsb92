<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Objectcity
 *
 * @ORM\Table(name="objectCity", indexes={@ORM\Index(name="object_id", columns={"object_id"}), @ORM\Index(name="city_id", columns={"city_id"})})
 * @ORM\Entity
 */
class Objectcity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="objectCity_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $objectcityId;

    /**
     * @var integer
     *
     * @ORM\Column(name="objectCity_score", type="integer", nullable=false)
     */
    private $objectcityScore;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="objectCity_lastUpdate", type="datetime", nullable=false)
     */
    private $objectcityLastupdate;

    /**
     * @var integer
     *
     * @ORM\Column(name="objectCity_scoreTendency", type="integer", nullable=false)
     */
    private $objectcityScoretendency;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="objectCity_dateTendency", type="datetime", nullable=false)
     */
    private $objectcityDatetendency;

    /**
     * @var \City
     *
     * @ORM\ManyToOne(targetEntity="City")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="city_id", referencedColumnName="city_id")
     * })
     */
    private $city;

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
     * Get objectcityId
     *
     * @return integer
     */
    public function getObjectcityId()
    {
        return $this->objectcityId;
    }

    /**
     * Set objectcityScore
     *
     * @param integer $objectcityScore
     *
     * @return Objectcity
     */
    public function setObjectcityScore($objectcityScore)
    {
        $this->objectcityScore = $objectcityScore;

        return $this;
    }

    /**
     * Get objectcityScore
     *
     * @return integer
     */
    public function getObjectcityScore()
    {
        return $this->objectcityScore;
    }

    /**
     * Set objectcityLastupdate
     *
     * @param \DateTime $objectcityLastupdate
     *
     * @return Objectcity
     */
    public function setObjectcityLastupdate($objectcityLastupdate)
    {
        $this->objectcityLastupdate = $objectcityLastupdate;

        return $this;
    }

    /**
     * Get objectcityLastupdate
     *
     * @return \DateTime
     */
    public function getObjectcityLastupdate()
    {
        return $this->objectcityLastupdate;
    }

    /**
     * Set objectcityScoretendency
     *
     * @param integer $objectcityScoretendency
     *
     * @return Objectcity
     */
    public function setObjectcityScoretendency($objectcityScoretendency)
    {
        $this->objectcityScoretendency = $objectcityScoretendency;

        return $this;
    }

    /**
     * Get objectcityScoretendency
     *
     * @return integer
     */
    public function getObjectcityScoretendency()
    {
        return $this->objectcityScoretendency;
    }

    /**
     * Set objectcityDatetendency
     *
     * @param \DateTime $objectcityDatetendency
     *
     * @return Objectcity
     */
    public function setObjectcityDatetendency($objectcityDatetendency)
    {
        $this->objectcityDatetendency = $objectcityDatetendency;

        return $this;
    }

    /**
     * Get objectcityDatetendency
     *
     * @return \DateTime
     */
    public function getObjectcityDatetendency()
    {
        return $this->objectcityDatetendency;
    }

    /**
     * Set city
     *
     * @param \HomeBundle\Entity\City $city
     *
     * @return Objectcity
     */
    public function setCity(\HomeBundle\Entity\City $city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return \HomeBundle\Entity\City
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set object
     *
     * @param \HomeBundle\Entity\Object $object
     *
     * @return Objectcity
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
