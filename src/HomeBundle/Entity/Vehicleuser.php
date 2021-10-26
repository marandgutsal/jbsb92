<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vehicleuser
 *
 * @ORM\Table(name="vehicleUser", uniqueConstraints={@ORM\UniqueConstraint(name="vehicle_id", columns={"vehicle_id", "user_id"})}, indexes={@ORM\Index(name="vehicleuser_ibfk_1", columns={"user_id"}), @ORM\Index(name="IDX_FA9EB94B545317D1", columns={"vehicle_id"})})
 * @ORM\Entity
 */
class Vehicleuser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="vehicleUser_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $vehicleuserId;

    /**
     * @var \Commercial
     *
     * @ORM\ManyToOne(targetEntity="Commercial")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="commercial_id")
     * })
     */
    private $user;

    /**
     * @var \Vehicle
     *
     * @ORM\ManyToOne(targetEntity="Vehicle")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="vehicle_id", referencedColumnName="vehicle_id")
     * })
     */
    private $vehicle;



    /**
     * Get vehicleuserId
     *
     * @return integer
     */
    public function getVehicleuserId()
    {
        return $this->vehicleuserId;
    }

    /**
     * Set user
     *
     * @param \HomeBundle\Entity\Commercial $user
     *
     * @return Vehicleuser
     */
    public function setUser(\HomeBundle\Entity\Commercial $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \HomeBundle\Entity\Commercial
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set vehicle
     *
     * @param \HomeBundle\Entity\Vehicle $vehicle
     *
     * @return Vehicleuser
     */
    public function setVehicle(\HomeBundle\Entity\Vehicle $vehicle = null)
    {
        $this->vehicle = $vehicle;

        return $this;
    }

    /**
     * Get vehicle
     *
     * @return \HomeBundle\Entity\Vehicle
     */
    public function getVehicle()
    {
        return $this->vehicle;
    }
}
