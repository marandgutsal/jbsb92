<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Packageprice
 *
 * @ORM\Table(name="packagePrice", indexes={@ORM\Index(name="package_id", columns={"package_id"}), @ORM\Index(name="price_id", columns={"price_id"})})
 * @ORM\Entity
 */
class Packageprice
{
    /**
     * @var integer
     *
     * @ORM\Column(name="packagePrice_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $packagepriceId;

    /**
     * @var \Package
     *
     * @ORM\ManyToOne(targetEntity="Package")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="package_id", referencedColumnName="package_id")
     * })
     */
    private $package;

    /**
     * @var \Price
     *
     * @ORM\ManyToOne(targetEntity="Price")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="price_id", referencedColumnName="price_id")
     * })
     */
    private $price;



    /**
     * Get packagepriceId
     *
     * @return integer
     */
    public function getPackagepriceId()
    {
        return $this->packagepriceId;
    }

    /**
     * Set package
     *
     * @param \HomeBundle\Entity\Package $package
     *
     * @return Packageprice
     */
    public function setPackage(\HomeBundle\Entity\Package $package = null)
    {
        $this->package = $package;

        return $this;
    }

    /**
     * Get package
     *
     * @return \HomeBundle\Entity\Package
     */
    public function getPackage()
    {
        return $this->package;
    }

    /**
     * Set price
     *
     * @param \HomeBundle\Entity\Price $price
     *
     * @return Packageprice
     */
    public function setPrice(\HomeBundle\Entity\Price $price = null)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return \HomeBundle\Entity\Price
     */
    public function getPrice()
    {
        return $this->price;
    }
}
