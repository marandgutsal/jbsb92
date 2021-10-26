<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vehicle
 *
 * @ORM\Table(name="vehicle", uniqueConstraints={@ORM\UniqueConstraint(name="user_id_2", columns={"user_id", "vehicle_plate", "vehicleType_id"})}, indexes={@ORM\Index(name="user_id", columns={"user_id"}), @ORM\Index(name="vehicleType_id", columns={"vehicleType_id"})})
 * @ORM\Entity
 */
class Vehicle
{
    /**
     * @var integer
     *
     * @ORM\Column(name="vehicle_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $vehicleId;

    /**
     * @var string
     *
     * @ORM\Column(name="vehicle_plate", type="string", length=255, nullable=false)
     */
    private $vehiclePlate;

    /**
     * @var \Vehicletype
     *
     * @ORM\ManyToOne(targetEntity="Vehicletype")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="vehicleType_id", referencedColumnName="vehicleType_id")
     * })
     */
    private $vehicletype;

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
     * Get vehicleId
     *
     * @return integer
     */
    public function getVehicleId()
    {
        return $this->vehicleId;
    }

    /**
     * Set vehiclePlate
     *
     * @param string $vehiclePlate
     *
     * @return Vehicle
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
     * Set vehicletype
     *
     * @param \HomeBundle\Entity\Vehicletype $vehicletype
     *
     * @return Vehicle
     */
    public function setVehicletype(\HomeBundle\Entity\Vehicletype $vehicletype = null)
    {
        $this->vehicletype = $vehicletype;

        return $this;
    }

    /**
     * Get vehicletype
     *
     * @return \HomeBundle\Entity\Vehicletype
     */
    public function getVehicletype()
    {
        return $this->vehicletype;
    }

    /**
     * Set user
     *
     * @param \HomeBundle\Entity\Commercial $user
     *
     * @return Vehicle
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
}
