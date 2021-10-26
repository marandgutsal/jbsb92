<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Shipping
 *
 * @ORM\Table(name="shipping", indexes={@ORM\Index(name="reach_id", columns={"reach_id"}), @ORM\Index(name="shipping_ibfk_3", columns={"vehicle_id"}), @ORM\Index(name="shipping_ibfk_5", columns={"driver_id"}), @ORM\Index(name="shipping_capacity", columns={"shipping_capacity"})})
 * @ORM\Entity
 */
class Shipping
{
    /**
     * @var integer
     *
     * @ORM\Column(name="shipping_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $shippingId;

    /**
     * @var \Vehicleuser
     *
     * @ORM\ManyToOne(targetEntity="Vehicleuser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="vehicle_id", referencedColumnName="vehicleUser_id")
     * })
     */
    private $vehicle;

    /**
     * @var \Driveruser
     *
     * @ORM\ManyToOne(targetEntity="Driveruser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="driver_id", referencedColumnName="driverUser_id")
     * })
     */
    private $driver;

    /**
     * @var \Reach
     *
     * @ORM\ManyToOne(targetEntity="Reach")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="reach_id", referencedColumnName="reach_id")
     * })
     */
    private $reach;

    /**
     * @var \Maximumload
     *
     * @ORM\ManyToOne(targetEntity="Maximumload")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="shipping_capacity", referencedColumnName="maximumLoad_id")
     * })
     */
    private $shippingCapacity;



    /**
     * Get shippingId
     *
     * @return integer
     */
    public function getShippingId()
    {
        return $this->shippingId;
    }

    /**
     * Set vehicle
     *
     * @param \HomeBundle\Entity\Vehicleuser $vehicle
     *
     * @return Shipping
     */
    public function setVehicle(\HomeBundle\Entity\Vehicleuser $vehicle = null)
    {
        $this->vehicle = $vehicle;

        return $this;
    }

    /**
     * Get vehicle
     *
     * @return \HomeBundle\Entity\Vehicleuser
     */
    public function getVehicle()
    {
        return $this->vehicle;
    }

    /**
     * Set driver
     *
     * @param \HomeBundle\Entity\Driveruser $driver
     *
     * @return Shipping
     */
    public function setDriver(\HomeBundle\Entity\Driveruser $driver = null)
    {
        $this->driver = $driver;

        return $this;
    }

    /**
     * Get driver
     *
     * @return \HomeBundle\Entity\Driveruser
     */
    public function getDriver()
    {
        return $this->driver;
    }

    /**
     * Set reach
     *
     * @param \HomeBundle\Entity\Reach $reach
     *
     * @return Shipping
     */
    public function setReach(\HomeBundle\Entity\Reach $reach = null)
    {
        $this->reach = $reach;

        return $this;
    }

    /**
     * Get reach
     *
     * @return \HomeBundle\Entity\Reach
     */
    public function getReach()
    {
        return $this->reach;
    }

    /**
     * Set shippingCapacity
     *
     * @param \HomeBundle\Entity\Maximumload $shippingCapacity
     *
     * @return Shipping
     */
    public function setShippingCapacity(\HomeBundle\Entity\Maximumload $shippingCapacity = null)
    {
        $this->shippingCapacity = $shippingCapacity;

        return $this;
    }

    /**
     * Get shippingCapacity
     *
     * @return \HomeBundle\Entity\Maximumload
     */
    public function getShippingCapacity()
    {
        return $this->shippingCapacity;
    }
}
