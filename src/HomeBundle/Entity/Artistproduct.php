<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Artistproduct
 *
 * @ORM\Table(name="artistProduct", indexes={@ORM\Index(name="artist_id", columns={"artist_id"}), @ORM\Index(name="product_id", columns={"product_id"})})
 * @ORM\Entity
 */
class Artistproduct
{
    /**
     * @var integer
     *
     * @ORM\Column(name="artistProduct_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $artistproductId;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="artist_id", referencedColumnName="user_id")
     * })
     */
    private $artist;

    /**
     * @var \Product
     *
     * @ORM\ManyToOne(targetEntity="Product")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", referencedColumnName="product_id")
     * })
     */
    private $product;



    /**
     * Get artistproductId
     *
     * @return integer
     */
    public function getArtistproductId()
    {
        return $this->artistproductId;
    }

    /**
     * Set artist
     *
     * @param \HomeBundle\Entity\User $artist
     *
     * @return Artistproduct
     */
    public function setArtist(\HomeBundle\Entity\User $artist = null)
    {
        $this->artist = $artist;

        return $this;
    }

    /**
     * Get artist
     *
     * @return \HomeBundle\Entity\User
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * Set product
     *
     * @param \HomeBundle\Entity\Product $product
     *
     * @return Artistproduct
     */
    public function setProduct(\HomeBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \HomeBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }
}
