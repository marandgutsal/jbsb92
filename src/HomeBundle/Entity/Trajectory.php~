<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trajectory
 *
 * @ORM\Table(name="trajectory", indexes={@ORM\Index(name="shipping_id", columns={"shipping_id"}), @ORM\Index(name="shipment_id", columns={"shipment_id"}), @ORM\Index(name="origin_id", columns={"origin_id"}), @ORM\Index(name="destiny_id", columns={"destiny_id"}), @ORM\Index(name="availableRoute_id", columns={"backordersRate_id"})})
 * @ORM\Entity
 */
class Trajectory
{
    /**
     * @var integer
     *
     * @ORM\Column(name="trajectory_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $trajectoryId;

    /**
     * @var integer
     *
     * @ORM\Column(name="shipping_id", type="integer", nullable=false)
     */
    private $shippingId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="send_date", type="datetime", nullable=true)
     */
    private $sendDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deliverate_date", type="datetime", nullable=true)
     */
    private $deliverateDate;

    /**
     * @var \Commercial
     *
     * @ORM\ManyToOne(targetEntity="Commercial")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="destiny_id", referencedColumnName="commercial_id")
     * })
     */
    private $destiny;

    /**
     * @var \Commercial
     *
     * @ORM\ManyToOne(targetEntity="Commercial")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="origin_id", referencedColumnName="commercial_id")
     * })
     */
    private $origin;

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
     * @var \Backordersrate
     *
     * @ORM\ManyToOne(targetEntity="Backordersrate")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="backordersRate_id", referencedColumnName="backordersRate_id")
     * })
     */
    private $backordersrate;



    /**
     * Get trajectoryId
     *
     * @return integer
     */
    public function getTrajectoryId()
    {
        return $this->trajectoryId;
    }

    /**
     * Set shippingId
     *
     * @param integer $shippingId
     *
     * @return Trajectory
     */
    public function setShippingId($shippingId)
    {
        $this->shippingId = $shippingId;

        return $this;
    }

    /**
     * Get shippingId
     *
     * @return integer
     */
    public function getShippingId()
    {
        return $this->shippingId;
    }

    /**
     * Set sendDate
     *
     * @param \DateTime $sendDate
     *
     * @return Trajectory
     */
    public function setSendDate($sendDate)
    {
        $this->sendDate = $sendDate;

        return $this;
    }

    /**
     * Get sendDate
     *
     * @return \DateTime
     */
    public function getSendDate()
    {
        return $this->sendDate;
    }

    /**
     * Set deliverateDate
     *
     * @param \DateTime $deliverateDate
     *
     * @return Trajectory
     */
    public function setDeliverateDate($deliverateDate)
    {
        $this->deliverateDate = $deliverateDate;

        return $this;
    }

    /**
     * Get deliverateDate
     *
     * @return \DateTime
     */
    public function getDeliverateDate()
    {
        return $this->deliverateDate;
    }

    /**
     * Set destiny
     *
     * @param \HomeBundle\Entity\Commercial $destiny
     *
     * @return Trajectory
     */
    public function setDestiny(\HomeBundle\Entity\Commercial $destiny = null)
    {
        $this->destiny = $destiny;

        return $this;
    }

    /**
     * Get destiny
     *
     * @return \HomeBundle\Entity\Commercial
     */
    public function getDestiny()
    {
        return $this->destiny;
    }

    /**
     * Set origin
     *
     * @param \HomeBundle\Entity\Commercial $origin
     *
     * @return Trajectory
     */
    public function setOrigin(\HomeBundle\Entity\Commercial $origin = null)
    {
        $this->origin = $origin;

        return $this;
    }

    /**
     * Get origin
     *
     * @return \HomeBundle\Entity\Commercial
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * Set shipment
     *
     * @param \HomeBundle\Entity\Shipment $shipment
     *
     * @return Trajectory
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
     * Set backordersrate
     *
     * @param \HomeBundle\Entity\Backordersrate $backordersrate
     *
     * @return Trajectory
     */
    public function setBackordersrate(\HomeBundle\Entity\Backordersrate $backordersrate = null)
    {
        $this->backordersrate = $backordersrate;

        return $this;
    }

    /**
     * Get backordersrate
     *
     * @return \HomeBundle\Entity\Backordersrate
     */
    public function getBackordersrate()
    {
        return $this->backordersrate;
    }
}
