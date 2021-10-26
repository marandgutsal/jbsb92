<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Packagedestiny
 *
 * @ORM\Table(name="packageDestiny", indexes={@ORM\Index(name="package_id", columns={"package_id"}), @ORM\Index(name="location_id", columns={"location_id"})})
 * @ORM\Entity
 */
class Packagedestiny
{
    /**
     * @var integer
     *
     * @ORM\Column(name="packageDestiny_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $packagedestinyId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="packageDestiny_date", type="datetime", nullable=false)
     */
    private $packagedestinyDate;

    /**
     * @var \Package
     *
     * @ORM\ManyToOne(targetEntity="Package")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="package_id", referencedColumnName="package_id")
     * })
     */
    private $package;

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
     * Get packagedestinyId
     *
     * @return integer
     */
    public function getPackagedestinyId()
    {
        return $this->packagedestinyId;
    }

    /**
     * Set packagedestinyDate
     *
     * @param \DateTime $packagedestinyDate
     *
     * @return Packagedestiny
     */
    public function setPackagedestinyDate($packagedestinyDate)
    {
        $this->packagedestinyDate = $packagedestinyDate;

        return $this;
    }

    /**
     * Get packagedestinyDate
     *
     * @return \DateTime
     */
    public function getPackagedestinyDate()
    {
        return $this->packagedestinyDate;
    }

    /**
     * Set package
     *
     * @param \HomeBundle\Entity\Package $package
     *
     * @return Packagedestiny
     */
    public function setPackage(\HomeBundle\Entity\Package $package = null)
    {
        $this->package = $package;

        return $this;
    }

    /**
     * Get package
     *
     * @return \HomeBundle\Entity\Package
     */
    public function getPackage()
    {
        return $this->package;
    }

    /**
     * Set location
     *
     * @param \HomeBundle\Entity\Location $location
     *
     * @return Packagedestiny
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
