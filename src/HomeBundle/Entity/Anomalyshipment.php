<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Anomalyshipment
 *
 * @ORM\Table(name="anomalyShipment", indexes={@ORM\Index(name="shipment_id", columns={"shipment_id"}), @ORM\Index(name="reporter", columns={"reporter"}), @ORM\Index(name="new_shipping", columns={"new_shipping"}), @ORM\Index(name="old_shipping", columns={"old_shipping"})})
 * @ORM\Entity
 */
class Anomalyshipment
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

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
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="reporter", referencedColumnName="user_id")
     * })
     */
    private $reporter;

    /**
     * @var \Shipping
     *
     * @ORM\ManyToOne(targetEntity="Shipping")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="new_shipping", referencedColumnName="shipping_id")
     * })
     */
    private $newShipping;

    /**
     * @var \Shipping
     *
     * @ORM\ManyToOne(targetEntity="Shipping")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="old_shipping", referencedColumnName="shipping_id")
     * })
     */
    private $oldShipping;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Anomalyshipment
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set shipment
     *
     * @param \HomeBundle\Entity\Shipment $shipment
     *
     * @return Anomalyshipment
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
     * Set reporter
     *
     * @param \HomeBundle\Entity\User $reporter
     *
     * @return Anomalyshipment
     */
    public function setReporter(\HomeBundle\Entity\User $reporter = null)
    {
        $this->reporter = $reporter;

        return $this;
    }

    /**
     * Get reporter
     *
     * @return \HomeBundle\Entity\User
     */
    public function getReporter()
    {
        return $this->reporter;
    }

    /**
     * Set newShipping
     *
     * @param \HomeBundle\Entity\Shipping $newShipping
     *
     * @return Anomalyshipment
     */
    public function setNewShipping(\HomeBundle\Entity\Shipping $newShipping = null)
    {
        $this->newShipping = $newShipping;

        return $this;
    }

    /**
     * Get newShipping
     *
     * @return \HomeBundle\Entity\Shipping
     */
    public function getNewShipping()
    {
        return $this->newShipping;
    }

    /**
     * Set oldShipping
     *
     * @param \HomeBundle\Entity\Shipping $oldShipping
     *
     * @return Anomalyshipment
     */
    public function setOldShipping(\HomeBundle\Entity\Shipping $oldShipping = null)
    {
        $this->oldShipping = $oldShipping;

        return $this;
    }

    /**
     * Get oldShipping
     *
     * @return \HomeBundle\Entity\Shipping
     */
    public function getOldShipping()
    {
        return $this->oldShipping;
    }
}
