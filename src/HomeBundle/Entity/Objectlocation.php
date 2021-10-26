<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Objectlocation
 *
 * @ORM\Table(name="objectLocation", indexes={@ORM\Index(name="object_id", columns={"object_id"}), @ORM\Index(name="location_id", columns={"location_id"})})
 * @ORM\Entity
 */
class Objectlocation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="objectLocation_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $objectlocationId;

    /**
     * @var integer
     *
     * @ORM\Column(name="objectLocation_score", type="integer", nullable=false)
     */
    private $objectlocationScore;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="objectLocation_lastUpdate", type="datetime", nullable=false)
     */
    private $objectlocationLastupdate;

    /**
     * @var integer
     *
     * @ORM\Column(name="objectLocation_scoreTendency", type="integer", nullable=false)
     */
    private $objectlocationScoretendency;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="objectLocation_dateTendency", type="datetime", nullable=false)
     */
    private $objectlocationDatetendency;

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
     * @var \Location
     *
     * @ORM\ManyToOne(targetEntity="Location")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="location_id", referencedColumnName="location_id")
     * })
     */
    private $location;



    /**
     * Get objectlocationId
     *
     * @return integer
     */
    public function getObjectlocationId()
    {
        return $this->objectlocationId;
    }

    /**
     * Set objectlocationScore
     *
     * @param integer $objectlocationScore
     *
     * @return Objectlocation
     */
    public function setObjectlocationScore($objectlocationScore)
    {
        $this->objectlocationScore = $objectlocationScore;

        return $this;
    }

    /**
     * Get objectlocationScore
     *
     * @return integer
     */
    public function getObjectlocationScore()
    {
        return $this->objectlocationScore;
    }

    /**
     * Set objectlocationLastupdate
     *
     * @param \DateTime $objectlocationLastupdate
     *
     * @return Objectlocation
     */
    public function setObjectlocationLastupdate($objectlocationLastupdate)
    {
        $this->objectlocationLastupdate = $objectlocationLastupdate;

        return $this;
    }

    /**
     * Get objectlocationLastupdate
     *
     * @return \DateTime
     */
    public function getObjectlocationLastupdate()
    {
        return $this->objectlocationLastupdate;
    }

    /**
     * Set objectlocationScoretendency
     *
     * @param integer $objectlocationScoretendency
     *
     * @return Objectlocation
     */
    public function setObjectlocationScoretendency($objectlocationScoretendency)
    {
        $this->objectlocationScoretendency = $objectlocationScoretendency;

        return $this;
    }

    /**
     * Get objectlocationScoretendency
     *
     * @return integer
     */
    public function getObjectlocationScoretendency()
    {
        return $this->objectlocationScoretendency;
    }

    /**
     * Set objectlocationDatetendency
     *
     * @param \DateTime $objectlocationDatetendency
     *
     * @return Objectlocation
     */
    public function setObjectlocationDatetendency($objectlocationDatetendency)
    {
        $this->objectlocationDatetendency = $objectlocationDatetendency;

        return $this;
    }

    /**
     * Get objectlocationDatetendency
     *
     * @return \DateTime
     */
    public function getObjectlocationDatetendency()
    {
        return $this->objectlocationDatetendency;
    }

    /**
     * Set object
     *
     * @param \HomeBundle\Entity\Object $object
     *
     * @return Objectlocation
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

    /**
     * Set location
     *
     * @param \HomeBundle\Entity\Location $location
     *
     * @return Objectlocation
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
