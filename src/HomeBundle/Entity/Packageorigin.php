<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Packageorigin
 *
 * @ORM\Table(name="packageOrigin", indexes={@ORM\Index(name="package_id", columns={"package_id"}), @ORM\Index(name="location_id", columns={"location_id"})})
 * @ORM\Entity
 */
class Packageorigin
{
    /**
     * @var integer
     *
     * @ORM\Column(name="packageOrigin_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $packageoriginId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="packageOrigin_date", type="datetime", nullable=false)
     */
    private $packageoriginDate;

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
     * Get packageoriginId
     *
     * @return integer
     */
    public function getPackageoriginId()
    {
        return $this->packageoriginId;
    }

    /**
     * Set packageoriginDate
     *
     * @param \DateTime $packageoriginDate
     *
     * @return Packageorigin
     */
    public function setPackageoriginDate($packageoriginDate)
    {
        $this->packageoriginDate = $packageoriginDate;

        return $this;
    }

    /**
     * Get packageoriginDate
     *
     * @return \DateTime
     */
    public function getPackageoriginDate()
    {
        return $this->packageoriginDate;
    }

    /**
     * Set package
     *
     * @param \HomeBundle\Entity\Package $package
     *
     * @return Packageorigin
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
     * @return Packageorigin
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
