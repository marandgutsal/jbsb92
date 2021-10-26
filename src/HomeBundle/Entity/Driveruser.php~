<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Driveruser
 *
 * @ORM\Table(name="driverUser", uniqueConstraints={@ORM\UniqueConstraint(name="driver_id", columns={"driver_id", "user_id"})}, indexes={@ORM\Index(name="driveruser_ibfk_2", columns={"user_id"}), @ORM\Index(name="IDX_7201F283C3423909", columns={"driver_id"})})
 * @ORM\Entity
 */
class Driveruser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="driverUser_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $driveruserId;

    /**
     * @var \Commercial
     *
     * @ORM\ManyToOne(targetEntity="Commercial")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="driver_id", referencedColumnName="commercial_id")
     * })
     */
    private $driver;

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
     * Get driveruserId
     *
     * @return integer
     */
    public function getDriveruserId()
    {
        return $this->driveruserId;
    }

    /**
     * Set driver
     *
     * @param \HomeBundle\Entity\Commercial $driver
     *
     * @return Driveruser
     */
    public function setDriver(\HomeBundle\Entity\Commercial $driver = null)
    {
        $this->driver = $driver;

        return $this;
    }

    /**
     * Get driver
     *
     * @return \HomeBundle\Entity\Commercial
     */
    public function getDriver()
    {
        return $this->driver;
    }

    /**
     * Set user
     *
     * @param \HomeBundle\Entity\Commercial $user
     *
     * @return Driveruser
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
