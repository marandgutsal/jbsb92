<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Currency
 *
 * @ORM\Table(name="currency", uniqueConstraints={@ORM\UniqueConstraint(name="currency_name", columns={"currency_name"}), @ORM\UniqueConstraint(name="currency_name_2", columns={"currency_name", "currency_value"})})
 * @ORM\Entity
 */
class Currency
{
    /**
     * @var integer
     *
     * @ORM\Column(name="currency_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $currencyId;

    /**
     * @var string
     *
     * @ORM\Column(name="currency_name", type="string", length=255, nullable=false)
     */
    private $currencyName;

    /**
     * @var integer
     *
     * @ORM\Column(name="currency_value", type="integer", nullable=false)
     */
    private $currencyValue;



    /**
     * Get currencyId
     *
     * @return integer
     */
    public function getCurrencyId()
    {
        return $this->currencyId;
    }

    /**
     * Set currencyName
     *
     * @param string $currencyName
     *
     * @return Currency
     */
    public function setCurrencyName($currencyName)
    {
        $this->currencyName = $currencyName;

        return $this;
    }

    /**
     * Get currencyName
     *
     * @return string
     */
    public function getCurrencyName()
    {
        return $this->currencyName;
    }

    /**
     * Set currencyValue
     *
     * @param integer $currencyValue
     *
     * @return Currency
     */
    public function setCurrencyValue($currencyValue)
    {
        $this->currencyValue = $currencyValue;

        return $this;
    }

    /**
     * Get currencyValue
     *
     * @return integer
     */
    public function getCurrencyValue()
    {
        return $this->currencyValue;
    }
}
