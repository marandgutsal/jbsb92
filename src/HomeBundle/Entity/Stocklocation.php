<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Stocklocation
 *
 * @ORM\Table(name="stockLocation", indexes={@ORM\Index(name="commercial_id", columns={"commercial_id"}), @ORM\Index(name="location_id", columns={"location_id"})})
 * @ORM\Entity
 */
class Stocklocation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="stockLocation_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $stocklocationId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="stockLocation_openened", type="time", nullable=false)
     */
    private $stocklocationOpenened;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="stockLocation_closed", type="time", nullable=false)
     */
    private $stocklocationClosed;

    /**
     * @var string
     *
     * @ORM\Column(name="stockLocation_status", type="string", length=255, nullable=false)
     */
    private $stocklocationStatus;

    /**
     * @var \Commercial
     *
     * @ORM\ManyToOne(targetEntity="Commercial")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="commercial_id", referencedColumnName="commercial_id")
     * })
     */
    private $commercial;

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
     * Get stocklocationId
     *
     * @return integer
     */
    public function getStocklocationId()
    {
        return $this->stocklocationId;
    }

    /**
     * Set stocklocationOpenened
     *
     * @param \DateTime $stocklocationOpenened
     *
     * @return Stocklocation
     */
    public function setStocklocationOpenened($stocklocationOpenened)
    {
        $this->stocklocationOpenened = $stocklocationOpenened;

        return $this;
    }

    /**
     * Get stocklocationOpenened
     *
     * @return \DateTime
     */
    public function getStocklocationOpenened()
    {
        return $this->stocklocationOpenened;
    }

    /**
     * Set stocklocationClosed
     *
     * @param \DateTime $stocklocationClosed
     *
     * @return Stocklocation
     */
    public function setStocklocationClosed($stocklocationClosed)
    {
        $this->stocklocationClosed = $stocklocationClosed;

        return $this;
    }

    /**
     * Get stocklocationClosed
     *
     * @return \DateTime
     */
    public function getStocklocationClosed()
    {
        return $this->stocklocationClosed;
    }

    /**
     * Set stocklocationStatus
     *
     * @param string $stocklocationStatus
     *
     * @return Stocklocation
     */
    public function setStocklocationStatus($stocklocationStatus)
    {
        $this->stocklocationStatus = $stocklocationStatus;

        return $this;
    }

    /**
     * Get stocklocationStatus
     *
     * @return string
     */
    public function getStocklocationStatus()
    {
        return $this->stocklocationStatus;
    }

    /**
     * Set commercial
     *
     * @param \HomeBundle\Entity\Commercial $commercial
     *
     * @return Stocklocation
     */
    public function setCommercial(\HomeBundle\Entity\Commercial $commercial = null)
    {
        $this->commercial = $commercial;

        return $this;
    }

    /**
     * Get commercial
     *
     * @return \HomeBundle\Entity\Commercial
     */
    public function getCommercial()
    {
        return $this->commercial;
    }

    /**
     * Set location
     *
     * @param \HomeBundle\Entity\Location $location
     *
     * @return Stocklocation
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
