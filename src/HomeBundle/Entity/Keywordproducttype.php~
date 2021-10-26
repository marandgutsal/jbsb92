<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Keywordproducttype
 *
 * @ORM\Table(name="keywordProductType", uniqueConstraints={@ORM\UniqueConstraint(name="keywordLanguage_id", columns={"keywordLanguage_id", "productType_id"})}, indexes={@ORM\Index(name="keyword_id", columns={"keywordLanguage_id"}), @ORM\Index(name="productType_id", columns={"productType_id"})})
 * @ORM\Entity
 */
class Keywordproducttype
{
    /**
     * @var integer
     *
     * @ORM\Column(name="keywordProductType_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $keywordproducttypeId;

    /**
     * @var \Keywordlanguage
     *
     * @ORM\ManyToOne(targetEntity="Keywordlanguage")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="keywordLanguage_id", referencedColumnName="keywordLanguage_id")
     * })
     */
    private $keywordlanguage;

    /**
     * @var \Producttype
     *
     * @ORM\ManyToOne(targetEntity="Producttype")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="productType_id", referencedColumnName="productType_id")
     * })
     */
    private $producttype;



    /**
     * Get keywordproducttypeId
     *
     * @return integer
     */
    public function getKeywordproducttypeId()
    {
        return $this->keywordproducttypeId;
    }

    /**
     * Set keywordlanguage
     *
     * @param \HomeBundle\Entity\Keywordlanguage $keywordlanguage
     *
     * @return Keywordproducttype
     */
    public function setKeywordlanguage(\HomeBundle\Entity\Keywordlanguage $keywordlanguage = null)
    {
        $this->keywordlanguage = $keywordlanguage;

        return $this;
    }

    /**
     * Get keywordlanguage
     *
     * @return \HomeBundle\Entity\Keywordlanguage
     */
    public function getKeywordlanguage()
    {
        return $this->keywordlanguage;
    }

    /**
     * Set producttype
     *
     * @param \HomeBundle\Entity\Producttype $producttype
     *
     * @return Keywordproducttype
     */
    public function setProducttype(\HomeBundle\Entity\Producttype $producttype = null)
    {
        $this->producttype = $producttype;

        return $this;
    }

    /**
     * Get producttype
     *
     * @return \HomeBundle\Entity\Producttype
     */
    public function getProducttype()
    {
        return $this->producttype;
    }
}
