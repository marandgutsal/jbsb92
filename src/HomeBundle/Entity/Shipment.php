<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Shipment
 *
 * @ORM\Table(name="shipment", indexes={@ORM\Index(name="saleDetail_id", columns={"selectedProduct_id"}), @ORM\Index(name="node_id", columns={"node_id"}), @ORM\Index(name="shipment_parent", columns={"shipment_parent"}), @ORM\Index(name="shippingUser_id", columns={"shippingUser_id"})})
 * @ORM\Entity
 */
class Shipment
{
    /**
     * @var integer
     *
     * @ORM\Column(name="shipment_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $shipmentId;

    /**
     * @var integer
     *
     * @ORM\Column(name="shipment_amount", type="integer", nullable=false)
     */
    private $shipmentAmount;

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
     * @var \Shipment
     *
     * @ORM\ManyToOne(targetEntity="Shipment")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="shipment_parent", referencedColumnName="shipment_id")
     * })
     */
    private $shipmentParent;

    /**
     * @var \Selectedproduct
     *
     * @ORM\ManyToOne(targetEntity="Selectedproduct")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="selectedProduct_id", referencedColumnName="selectedProduct_id")
     * })
     */
    private $selectedproduct;

    /**
     * @var \Shippinguser
     *
     * @ORM\ManyToOne(targetEntity="Shippinguser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="shippingUser_id", referencedColumnName="shippingUser_id")
     * })
     */
    private $shippinguser;



    /**
     * Get shipmentId
     *
     * @return integer
     */
    public function getShipmentId()
    {
        return $this->shipmentId;
    }

    /**
     * Set shipmentAmount
     *
     * @param integer $shipmentAmount
     *
     * @return Shipment
     */
    public function setShipmentAmount($shipmentAmount)
    {
        $this->shipmentAmount = $shipmentAmount;

        return $this;
    }

    /**
     * Get shipmentAmount
     *
     * @return integer
     */
    public function getShipmentAmount()
    {
        return $this->shipmentAmount;
    }

    /**
     * Set node
     *
     * @param \HomeBundle\Entity\Node $node
     *
     * @return Shipment
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
     * Set shipmentParent
     *
     * @param \HomeBundle\Entity\Shipment $shipmentParent
     *
     * @return Shipment
     */
    public function setShipmentParent(\HomeBundle\Entity\Shipment $shipmentParent = null)
    {
        $this->shipmentParent = $shipmentParent;

        return $this;
    }

    /**
     * Get shipmentParent
     *
     * @return \HomeBundle\Entity\Shipment
     */
    public function getShipmentParent()
    {
        return $this->shipmentParent;
    }

    /**
     * Set selectedproduct
     *
     * @param \HomeBundle\Entity\Selectedproduct $selectedproduct
     *
     * @return Shipment
     */
    public function setSelectedproduct(\HomeBundle\Entity\Selectedproduct $selectedproduct = null)
    {
        $this->selectedproduct = $selectedproduct;

        return $this;
    }

    /**
     * Get selectedproduct
     *
     * @return \HomeBundle\Entity\Selectedproduct
     */
    public function getSelectedproduct()
    {
        return $this->selectedproduct;
    }

    /**
     * Set shippinguser
     *
     * @param \HomeBundle\Entity\Shippinguser $shippinguser
     *
     * @return Shipment
     */
    public function setShippinguser(\HomeBundle\Entity\Shippinguser $shippinguser = null)
    {
        $this->shippinguser = $shippinguser;

        return $this;
    }

    /**
     * Get shippinguser
     *
     * @return \HomeBundle\Entity\Shippinguser
     */
    public function getShippinguser()
    {
        return $this->shippinguser;
    }
}
