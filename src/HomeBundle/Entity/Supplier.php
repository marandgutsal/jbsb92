<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Supplier
 *
 * @ORM\Table(name="supplier", indexes={@ORM\Index(name="shipping_id", columns={"shipping_id"}), @ORM\Index(name="shipment_id", columns={"shipment_id"}), @ORM\Index(name="node_id", columns={"node_id"}), @ORM\Index(name="origin_id", columns={"branch_origin_id"}), @ORM\Index(name="destiny_id", columns={"branch_destiny_id"})})
 * @ORM\Entity
 */
class Supplier
{
    /**
     * @var integer
     *
     * @ORM\Column(name="supplier_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $supplierId;

    /**
     * @var \Shipping
     *
     * @ORM\ManyToOne(targetEntity="Shipping")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="shipping_id", referencedColumnName="shipping_id")
     * })
     */
    private $shipping;

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
     * @var \Branch
     *
     * @ORM\ManyToOne(targetEntity="Branch")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="branch_origin_id", referencedColumnName="branch_id")
     * })
     */
    private $branchOrigin;

    /**
     * @var \Branch
     *
     * @ORM\ManyToOne(targetEntity="Branch")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="branch_destiny_id", referencedColumnName="branch_id")
     * })
     */
    private $branchDestiny;



    /**
     * Get supplierId
     *
     * @return integer
     */
    public function getSupplierId()
    {
        return $this->supplierId;
    }

    /**
     * Set shipping
     *
     * @param \HomeBundle\Entity\Shipping $shipping
     *
     * @return Supplier
     */
    public function setShipping(\HomeBundle\Entity\Shipping $shipping = null)
    {
        $this->shipping = $shipping;

        return $this;
    }

    /**
     * Get shipping
     *
     * @return \HomeBundle\Entity\Shipping
     */
    public function getShipping()
    {
        return $this->shipping;
    }

    /**
     * Set shipment
     *
     * @param \HomeBundle\Entity\Shipment $shipment
     *
     * @return Supplier
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
     * @return Supplier
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

    /**
     * Set branchOrigin
     *
     * @param \HomeBundle\Entity\Branch $branchOrigin
     *
     * @return Supplier
     */
    public function setBranchOrigin(\HomeBundle\Entity\Branch $branchOrigin = null)
    {
        $this->branchOrigin = $branchOrigin;

        return $this;
    }

    /**
     * Get branchOrigin
     *
     * @return \HomeBundle\Entity\Branch
     */
    public function getBranchOrigin()
    {
        return $this->branchOrigin;
    }

    /**
     * Set branchDestiny
     *
     * @param \HomeBundle\Entity\Branch $branchDestiny
     *
     * @return Supplier
     */
    public function setBranchDestiny(\HomeBundle\Entity\Branch $branchDestiny = null)
    {
        $this->branchDestiny = $branchDestiny;

        return $this;
    }

    /**
     * Get branchDestiny
     *
     * @return \HomeBundle\Entity\Branch
     */
    public function getBranchDestiny()
    {
        return $this->branchDestiny;
    }
}
