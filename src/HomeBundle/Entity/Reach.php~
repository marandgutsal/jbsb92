<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reach
 *
 * @ORM\Table(name="reach", uniqueConstraints={@ORM\UniqueConstraint(name="departure_id", columns={"departure_id", "delivery_id"})}, indexes={@ORM\Index(name="delivery_id", columns={"delivery_id"}), @ORM\Index(name="IDX_D64339A7704ED06", columns={"departure_id"})})
 * @ORM\Entity
 */
class Reach
{
    /**
     * @var integer
     *
     * @ORM\Column(name="reach_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $reachId;

    /**
     * @var \Branch
     *
     * @ORM\ManyToOne(targetEntity="Branch")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="departure_id", referencedColumnName="branch_id")
     * })
     */
    private $departure;

    /**
     * @var \Branch
     *
     * @ORM\ManyToOne(targetEntity="Branch")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="delivery_id", referencedColumnName="branch_id")
     * })
     */
    private $delivery;



    /**
     * Get reachId
     *
     * @return integer
     */
    public function getReachId()
    {
        return $this->reachId;
    }

    /**
     * Set departure
     *
     * @param \HomeBundle\Entity\Branch $departure
     *
     * @return Reach
     */
    public function setDeparture(\HomeBundle\Entity\Branch $departure = null)
    {
        $this->departure = $departure;

        return $this;
    }

    /**
     * Get departure
     *
     * @return \HomeBundle\Entity\Branch
     */
    public function getDeparture()
    {
        return $this->departure;
    }

    /**
     * Set delivery
     *
     * @param \HomeBundle\Entity\Branch $delivery
     *
     * @return Reach
     */
    public function setDelivery(\HomeBundle\Entity\Branch $delivery = null)
    {
        $this->delivery = $delivery;

        return $this;
    }

    /**
     * Get delivery
     *
     * @return \HomeBundle\Entity\Branch
     */
    public function getDelivery()
    {
        return $this->delivery;
    }
}
