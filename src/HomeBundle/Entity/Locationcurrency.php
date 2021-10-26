<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Locationcurrency
 *
 * @ORM\Table(name="locationCurrency", indexes={@ORM\Index(name="location_id", columns={"location_id"}), @ORM\Index(name="currency_id", columns={"currency_id"})})
 * @ORM\Entity
 */
class Locationcurrency
{
    /**
     * @var integer
     *
     * @ORM\Column(name="locationCurrency_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $locationcurrencyId;

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
     * @var \Currency
     *
     * @ORM\ManyToOne(targetEntity="Currency")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="currency_id", referencedColumnName="currency_id")
     * })
     */
    private $currency;



    /**
     * Get locationcurrencyId
     *
     * @return integer
     */
    public function getLocationcurrencyId()
    {
        return $this->locationcurrencyId;
    }

    /**
     * Set location
     *
     * @param \HomeBundle\Entity\Location $location
     *
     * @return Locationcurrency
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
     * Set currency
     *
     * @param \HomeBundle\Entity\Currency $currency
     *
     * @return Locationcurrency
     */
    public function setCurrency(\HomeBundle\Entity\Currency $currency = null)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return \HomeBundle\Entity\Currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }
}
