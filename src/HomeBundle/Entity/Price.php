<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Price
 *
 * @ORM\Table(name="price", uniqueConstraints={@ORM\UniqueConstraint(name="amount", columns={"amount", "currency"})}, indexes={@ORM\Index(name="currency", columns={"currency"})})
 * @ORM\Entity
 */
class Price
{
    /**
     * @var integer
     *
     * @ORM\Column(name="price_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $priceId;

    /**
     * @var integer
     *
     * @ORM\Column(name="amount", type="integer", nullable=false)
     */
    private $amount;

    /**
     * @var \Currency
     *
     * @ORM\ManyToOne(targetEntity="Currency")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="currency", referencedColumnName="currency_id")
     * })
     */
    private $currency;



    /**
     * Get priceId
     *
     * @return integer
     */
    public function getPriceId()
    {
        return $this->priceId;
    }

    /**
     * Set amount
     *
     * @param integer $amount
     *
     * @return Price
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return integer
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set currency
     *
     * @param \HomeBundle\Entity\Currency $currency
     *
     * @return Price
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
