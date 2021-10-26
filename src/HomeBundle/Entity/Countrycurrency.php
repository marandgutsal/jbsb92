<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Countrycurrency
 *
 * @ORM\Table(name="countryCurrency", indexes={@ORM\Index(name="country_id", columns={"country_id"}), @ORM\Index(name="currency_id", columns={"currency_id"})})
 * @ORM\Entity
 */
class Countrycurrency
{
    /**
     * @var integer
     *
     * @ORM\Column(name="countryCurrency_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $countrycurrencyId;

    /**
     * @var \Country
     *
     * @ORM\ManyToOne(targetEntity="Country")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="country_id", referencedColumnName="country_id")
     * })
     */
    private $country;

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
     * Get countrycurrencyId
     *
     * @return integer
     */
    public function getCountrycurrencyId()
    {
        return $this->countrycurrencyId;
    }

    /**
     * Set country
     *
     * @param \HomeBundle\Entity\Country $country
     *
     * @return Countrycurrency
     */
    public function setCountry(\HomeBundle\Entity\Country $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \HomeBundle\Entity\Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set currency
     *
     * @param \HomeBundle\Entity\Currency $currency
     *
     * @return Countrycurrency
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
