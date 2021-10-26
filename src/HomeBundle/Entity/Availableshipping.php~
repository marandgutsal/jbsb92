<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Availableshipping
 *
 * @ORM\Table(name="availableShipping", indexes={@ORM\Index(name="shipping_id", columns={"shipping_id"})})
 * @ORM\Entity
 */
class Availableshipping
{
    /**
     * @var integer
     *
     * @ORM\Column(name="availableShipping_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $availableshippingId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="availableShipping_opening", type="datetime", nullable=false)
     */
    private $availableshippingOpening = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="availableShipping_closing", type="datetime", nullable=false)
     */
    private $availableshippingClosing = 'CURRENT_TIMESTAMP';

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
     * Get availableshippingId
     *
     * @return integer
     */
    public function getAvailableshippingId()
    {
        return $this->availableshippingId;
    }

    /**
     * Set availableshippingOpening
     *
     * @param \DateTime $availableshippingOpening
     *
     * @return Availableshipping
     */
    public function setAvailableshippingOpening($availableshippingOpening)
    {
        $this->availableshippingOpening = $availableshippingOpening;

        return $this;
    }

    /**
     * Get availableshippingOpening
     *
     * @return \DateTime
     */
    public function getAvailableshippingOpening()
    {
        return $this->availableshippingOpening;
    }

    /**
     * Set availableshippingClosing
     *
     * @param \DateTime $availableshippingClosing
     *
     * @return Availableshipping
     */
    public function setAvailableshippingClosing($availableshippingClosing)
    {
        $this->availableshippingClosing = $availableshippingClosing;

        return $this;
    }

    /**
     * Get availableshippingClosing
     *
     * @return \DateTime
     */
    public function getAvailableshippingClosing()
    {
        return $this->availableshippingClosing;
    }

    /**
     * Set shipping
     *
     * @param \HomeBundle\Entity\Shipping $shipping
     *
     * @return Availableshipping
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
}
