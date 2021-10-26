<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Equivalence
 *
 * @ORM\Table(name="equivalence", indexes={@ORM\Index(name="capacity_id", columns={"capacity_id"}), @ORM\Index(name="maximumLoad_id", columns={"maximumLoad_id"})})
 * @ORM\Entity
 */
class Equivalence
{
    /**
     * @var integer
     *
     * @ORM\Column(name="equivalence_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $equivalenceId;

    /**
     * @var \Capacity
     *
     * @ORM\ManyToOne(targetEntity="Capacity")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="capacity_id", referencedColumnName="capacity_id")
     * })
     */
    private $capacity;

    /**
     * @var \Maximumload
     *
     * @ORM\ManyToOne(targetEntity="Maximumload")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="maximumLoad_id", referencedColumnName="maximumLoad_id")
     * })
     */
    private $maximumload;



    /**
     * Get equivalenceId
     *
     * @return integer
     */
    public function getEquivalenceId()
    {
        return $this->equivalenceId;
    }

    /**
     * Set capacity
     *
     * @param \HomeBundle\Entity\Capacity $capacity
     *
     * @return Equivalence
     */
    public function setCapacity(\HomeBundle\Entity\Capacity $capacity = null)
    {
        $this->capacity = $capacity;

        return $this;
    }

    /**
     * Get capacity
     *
     * @return \HomeBundle\Entity\Capacity
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * Set maximumload
     *
     * @param \HomeBundle\Entity\Maximumload $maximumload
     *
     * @return Equivalence
     */
    public function setMaximumload(\HomeBundle\Entity\Maximumload $maximumload = null)
    {
        $this->maximumload = $maximumload;

        return $this;
    }

    /**
     * Get maximumload
     *
     * @return \HomeBundle\Entity\Maximumload
     */
    public function getMaximumload()
    {
        return $this->maximumload;
    }
}
