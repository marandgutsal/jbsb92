<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vehicletype
 *
 * @ORM\Table(name="vehicleType")
 * @ORM\Entity
 */
class Vehicletype
{
    /**
     * @var integer
     *
     * @ORM\Column(name="vehicleType_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $vehicletypeId;

    /**
     * @var string
     *
     * @ORM\Column(name="vehicleType_name", type="string", length=255, nullable=false)
     */
    private $vehicletypeName;



    /**
     * Get vehicletypeId
     *
     * @return integer
     */
    public function getVehicletypeId()
    {
        return $this->vehicletypeId;
    }

    /**
     * Set vehicletypeName
     *
     * @param string $vehicletypeName
     *
     * @return Vehicletype
     */
    public function setVehicletypeName($vehicletypeName)
    {
        $this->vehicletypeName = $vehicletypeName;

        return $this;
    }

    /**
     * Get vehicletypeName
     *
     * @return string
     */
    public function getVehicletypeName()
    {
        return $this->vehicletypeName;
    }
}
