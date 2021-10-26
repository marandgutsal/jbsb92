<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Target
 *
 * @ORM\Table(name="target", indexes={@ORM\Index(name="location_id", columns={"location_id"}), @ORM\Index(name="reach_id", columns={"reach_id"})})
 * @ORM\Entity
 */
class Target
{
    /**
     * @var integer
     *
     * @ORM\Column(name="target_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $targetId;

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
     * @var \Reach
     *
     * @ORM\ManyToOne(targetEntity="Reach")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="reach_id", referencedColumnName="reach_id")
     * })
     */
    private $reach;



    /**
     * Get targetId
     *
     * @return integer
     */
    public function getTargetId()
    {
        return $this->targetId;
    }

    /**
     * Set location
     *
     * @param \HomeBundle\Entity\Location $location
     *
     * @return Target
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

    /**
     * Set reach
     *
     * @param \HomeBundle\Entity\Reach $reach
     *
     * @return Target
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
}
