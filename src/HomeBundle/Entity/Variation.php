<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Variation
 *
 * @ORM\Table(name="variation", indexes={@ORM\Index(name="countryCurrency_id", columns={"countryCurrency_id"})})
 * @ORM\Entity
 */
class Variation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="variation_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $variationId;

    /**
     * @var integer
     *
     * @ORM\Column(name="countryCurrency_id", type="integer", nullable=false)
     */
    private $countrycurrencyId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="countryCurrency_date", type="datetime", nullable=false)
     */
    private $countrycurrencyDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="variation_amount", type="integer", nullable=false)
     */
    private $variationAmount;



    /**
     * Get variationId
     *
     * @return integer
     */
    public function getVariationId()
    {
        return $this->variationId;
    }

    /**
     * Set countrycurrencyId
     *
     * @param integer $countrycurrencyId
     *
     * @return Variation
     */
    public function setCountrycurrencyId($countrycurrencyId)
    {
        $this->countrycurrencyId = $countrycurrencyId;

        return $this;
    }

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
     * Set countrycurrencyDate
     *
     * @param \DateTime $countrycurrencyDate
     *
     * @return Variation
     */
    public function setCountrycurrencyDate($countrycurrencyDate)
    {
        $this->countrycurrencyDate = $countrycurrencyDate;

        return $this;
    }

    /**
     * Get countrycurrencyDate
     *
     * @return \DateTime
     */
    public function getCountrycurrencyDate()
    {
        return $this->countrycurrencyDate;
    }

    /**
     * Set variationAmount
     *
     * @param integer $variationAmount
     *
     * @return Variation
     */
    public function setVariationAmount($variationAmount)
    {
        $this->variationAmount = $variationAmount;

        return $this;
    }

    /**
     * Get variationAmount
     *
     * @return integer
     */
    public function getVariationAmount()
    {
        return $this->variationAmount;
    }
}
