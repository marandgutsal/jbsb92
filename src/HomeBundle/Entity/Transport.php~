<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Transport
 *
 * @ORM\Table(name="transport", indexes={@ORM\Index(name="origin_id", columns={"origin_id"}), @ORM\Index(name="destiny_id", columns={"destiny_id"}), @ORM\Index(name="package_id", columns={"package_id"})})
 * @ORM\Entity
 */
class Transport
{
    /**
     * @var integer
     *
     * @ORM\Column(name="transport_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $transportId;

    /**
     * @var string
     *
     * @ORM\Column(name="vehicle_plate", type="string", length=255, nullable=false)
     */
    private $vehiclePlate;

    /**
     * @var integer
     *
     * @ORM\Column(name="vehicle_maximumWeight", type="integer", nullable=false)
     */
    private $vehicleMaximumweight;

    /**
     * @var integer
     *
     * @ORM\Column(name="vehicle_maximumDistance", type="integer", nullable=false)
     */
    private $vehicleMaximumdistance;

    /**
     * @var \Commercial
     *
     * @ORM\ManyToOne(targetEntity="Commercial")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="origin_id", referencedColumnName="commercial_id")
     * })
     */
    private $origin;

    /**
     * @var \Commercial
     *
     * @ORM\ManyToOne(targetEntity="Commercial")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="destiny_id", referencedColumnName="commercial_id")
     * })
     */
    private $destiny;

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
     * Get transportId
     *
     * @return integer
     */
    public function getTransportId()
    {
        return $this->transportId;
    }

    /**
     * Set vehiclePlate
     *
     * @param string $vehiclePlate
     *
     * @return Transport
     */
    public function setVehiclePlate($vehiclePlate)
    {
        $this->vehiclePlate = $vehiclePlate;

        return $this;
    }

    /**
     * Get vehiclePlate
     *
     * @return string
     */
    public function getVehiclePlate()
    {
        return $this->vehiclePlate;
    }

    /**
     * Set vehicleMaximumweight
     *
     * @param integer $vehicleMaximumweight
     *
     * @return Transport
     */
    public function setVehicleMaximumweight($vehicleMaximumweight)
    {
        $this->vehicleMaximumweight = $vehicleMaximumweight;

        return $this;
    }

    /**
     * Get vehicleMaximumweight
     *
     * @return integer
     */
    public function getVehicleMaximumweight()
    {
        return $this->vehicleMaximumweight;
    }

    /**
     * Set vehicleMaximumdistance
     *
     * @param integer $vehicleMaximumdistance
     *
     * @return Transport
     */
    public function setVehicleMaximumdistance($vehicleMaximumdistance)
    {
        $this->vehicleMaximumdistance = $vehicleMaximumdistance;

        return $this;
    }

    /**
     * Get vehicleMaximumdistance
     *
     * @return integer
     */
    public function getVehicleMaximumdistance()
    {
        return $this->vehicleMaximumdistance;
    }

    /**
     * Set origin
     *
     * @param \HomeBundle\Entity\Commercial $origin
     *
     * @return Transport
     */
    public function setOrigin(\HomeBundle\Entity\Commercial $origin = null)
    {
        $this->origin = $origin;

        return $this;
    }

    /**
     * Get origin
     *
     * @return \HomeBundle\Entity\Commercial
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * Set destiny
     *
     * @param \HomeBundle\Entity\Commercial $destiny
     *
     * @return Transport
     */
    public function setDestiny(\HomeBundle\Entity\Commercial $destiny = null)
    {
        $this->destiny = $destiny;

        return $this;
    }

    /**
     * Get destiny
     *
     * @return \HomeBundle\Entity\Commercial
     */
    public function getDestiny()
    {
        return $this->destiny;
    }

    /**
     * Set package
     *
     * @param \HomeBundle\Entity\Package $package
     *
     * @return Transport
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
}
