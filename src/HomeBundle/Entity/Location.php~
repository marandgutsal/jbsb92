<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Location
 *
 * @ORM\Table(name="location", indexes={@ORM\Index(name="location_parent", columns={"location_parent"}), @ORM\Index(name="territoriality", columns={"territoriality"})})
 * @ORM\Entity
 */
class Location
{
    /**
     * @var integer
     *
     * @ORM\Column(name="location_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $locationId;

    /**
     * @var string
     *
     * @ORM\Column(name="location_name", type="string", length=255, nullable=false)
     */
    private $locationName;

    /**
     * @var \Location
     *
     * @ORM\ManyToOne(targetEntity="Location")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="location_parent", referencedColumnName="location_id")
     * })
     */
    private $locationParent;

    /**
     * @var \Territoriality
     *
     * @ORM\ManyToOne(targetEntity="Territoriality")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="territoriality", referencedColumnName="territoriality_id")
     * })
     */
    private $territoriality;



    /**
     * Get locationId
     *
     * @return integer
     */
    public function getLocationId()
    {
        return $this->locationId;
    }

    /**
     * Set locationName
     *
     * @param string $locationName
     *
     * @return Location
     */
    public function setLocationName($locationName)
    {
        $this->locationName = $locationName;

        return $this;
    }

    /**
     * Get locationName
     *
     * @return string
     */
    public function getLocationName()
    {
        return $this->locationName;
    }

    /**
     * Set locationParent
     *
     * @param \HomeBundle\Entity\Location $locationParent
     *
     * @return Location
     */
    public function setLocationParent(\HomeBundle\Entity\Location $locationParent = null)
    {
        $this->locationParent = $locationParent;

        return $this;
    }

    /**
     * Get locationParent
     *
     * @return \HomeBundle\Entity\Location
     */
    public function getLocationParent()
    {
        return $this->locationParent;
    }

    /**
     * Set territoriality
     *
     * @param \HomeBundle\Entity\Territoriality $territoriality
     *
     * @return Location
     */
    public function setTerritoriality(\HomeBundle\Entity\Territoriality $territoriality = null)
    {
        $this->territoriality = $territoriality;

        return $this;
    }

    /**
     * Get territoriality
     *
     * @return \HomeBundle\Entity\Territoriality
     */
    public function getTerritoriality()
    {
        return $this->territoriality;
    }
}
