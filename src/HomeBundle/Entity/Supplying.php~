<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Supplying
 *
 * @ORM\Table(name="supplying", indexes={@ORM\Index(name="branch_id", columns={"branch_id"}), @ORM\Index(name="shipment_id", columns={"shipment_id"}), @ORM\Index(name="node_id", columns={"node_id"})})
 * @ORM\Entity
 */
class Supplying
{
    /**
     * @var integer
     *
     * @ORM\Column(name="supplying_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $supplyingId;

    /**
     * @var \Branch
     *
     * @ORM\ManyToOne(targetEntity="Branch")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="branch_id", referencedColumnName="branch_id")
     * })
     */
    private $branch;

    /**
     * @var \Shipment
     *
     * @ORM\ManyToOne(targetEntity="Shipment")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="shipment_id", referencedColumnName="shipment_id")
     * })
     */
    private $shipment;

    /**
     * @var \Node
     *
     * @ORM\ManyToOne(targetEntity="Node")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="node_id", referencedColumnName="node_id")
     * })
     */
    private $node;



    /**
     * Get supplyingId
     *
     * @return integer
     */
    public function getSupplyingId()
    {
        return $this->supplyingId;
    }

    /**
     * Set branch
     *
     * @param \HomeBundle\Entity\Branch $branch
     *
     * @return Supplying
     */
    public function setBranch(\HomeBundle\Entity\Branch $branch = null)
    {
        $this->branch = $branch;

        return $this;
    }

    /**
     * Get branch
     *
     * @return \HomeBundle\Entity\Branch
     */
    public function getBranch()
    {
        return $this->branch;
    }

    /**
     * Set shipment
     *
     * @param \HomeBundle\Entity\Shipment $shipment
     *
     * @return Supplying
     */
    public function setShipment(\HomeBundle\Entity\Shipment $shipment = null)
    {
        $this->shipment = $shipment;

        return $this;
    }

    /**
     * Get shipment
     *
     * @return \HomeBundle\Entity\Shipment
     */
    public function getShipment()
    {
        return $this->shipment;
    }

    /**
     * Set node
     *
     * @param \HomeBundle\Entity\Node $node
     *
     * @return Supplying
     */
    public function setNode(\HomeBundle\Entity\Node $node = null)
    {
        $this->node = $node;

        return $this;
    }

    /**
     * Get node
     *
     * @return \HomeBundle\Entity\Node
     */
    public function getNode()
    {
        return $this->node;
    }
}
