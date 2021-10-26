<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Keywordcurrency
 *
 * @ORM\Table(name="keywordCurrency", indexes={@ORM\Index(name="keyword_id", columns={"keyword_id"}), @ORM\Index(name="currency_id", columns={"currency_id"})})
 * @ORM\Entity
 */
class Keywordcurrency
{
    /**
     * @var integer
     *
     * @ORM\Column(name="keywordCurrency_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $keywordcurrencyId;

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
     * @var \Keyword
     *
     * @ORM\ManyToOne(targetEntity="Keyword")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="keyword_id", referencedColumnName="keyword_id")
     * })
     */
    private $keyword;



    /**
     * Get keywordcurrencyId
     *
     * @return integer
     */
    public function getKeywordcurrencyId()
    {
        return $this->keywordcurrencyId;
    }

    /**
     * Set currency
     *
     * @param \HomeBundle\Entity\Currency $currency
     *
     * @return Keywordcurrency
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

    /**
     * Set keyword
     *
     * @param \HomeBundle\Entity\Keyword $keyword
     *
     * @return Keywordcurrency
     */
    public function setKeyword(\HomeBundle\Entity\Keyword $keyword = null)
    {
        $this->keyword = $keyword;

        return $this;
    }

    /**
     * Get keyword
     *
     * @return \HomeBundle\Entity\Keyword
     */
    public function getKeyword()
    {
        return $this->keyword;
    }
}
