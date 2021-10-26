<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Selectedproduct
 *
 * @ORM\Table(name="selectedProduct", indexes={@ORM\Index(name="user_id", columns={"user_id"}), @ORM\Index(name="product_id", columns={"stock_id"}), @ORM\Index(name="selectedProduct_price", columns={"selectedProduct_price"}), @ORM\Index(name="sale_id", columns={"sale_id"})})
 * @ORM\Entity
 */
class Selectedproduct
{
    /**
     * @var integer
     *
     * @ORM\Column(name="selectedProduct_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $selectedproductId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="selectedProduct_date", type="datetime", nullable=false)
     */
    private $selectedproductDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="selectedProduct_amount", type="integer", nullable=false)
     */
    private $selectedproductAmount;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     * })
     */
    private $user;

    /**
     * @var \Stock
     *
     * @ORM\ManyToOne(targetEntity="Stock")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="stock_id", referencedColumnName="stock_id")
     * })
     */
    private $stock;

    /**
     * @var \Price
     *
     * @ORM\ManyToOne(targetEntity="Price")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="selectedProduct_price", referencedColumnName="price_id")
     * })
     */
    private $selectedproductPrice;

    /**
     * @var \Sale
     *
     * @ORM\ManyToOne(targetEntity="Sale")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sale_id", referencedColumnName="sale_id")
     * })
     */
    private $sale;



    /**
     * Get selectedproductId
     *
     * @return integer
     */
    public function getSelectedproductId()
    {
        return $this->selectedproductId;
    }

    /**
     * Set selectedproductDate
     *
     * @param \DateTime $selectedproductDate
     *
     * @return Selectedproduct
     */
    public function setSelectedproductDate($selectedproductDate)
    {
        $this->selectedproductDate = $selectedproductDate;

        return $this;
    }

    /**
     * Get selectedproductDate
     *
     * @return \DateTime
     */
    public function getSelectedproductDate()
    {
        return $this->selectedproductDate;
    }

    /**
     * Set selectedproductAmount
     *
     * @param integer $selectedproductAmount
     *
     * @return Selectedproduct
     */
    public function setSelectedproductAmount($selectedproductAmount)
    {
        $this->selectedproductAmount = $selectedproductAmount;

        return $this;
    }

    /**
     * Get selectedproductAmount
     *
     * @return integer
     */
    public function getSelectedproductAmount()
    {
        return $this->selectedproductAmount;
    }

    /**
     * Set user
     *
     * @param \HomeBundle\Entity\User $user
     *
     * @return Selectedproduct
     */
    public function setUser(\HomeBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \HomeBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set stock
     *
     * @param \HomeBundle\Entity\Stock $stock
     *
     * @return Selectedproduct
     */
    public function setStock(\HomeBundle\Entity\Stock $stock = null)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get stock
     *
     * @return \HomeBundle\Entity\Stock
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set selectedproductPrice
     *
     * @param \HomeBundle\Entity\Price $selectedproductPrice
     *
     * @return Selectedproduct
     */
    public function setSelectedproductPrice(\HomeBundle\Entity\Price $selectedproductPrice = null)
    {
        $this->selectedproductPrice = $selectedproductPrice;

        return $this;
    }

    /**
     * Get selectedproductPrice
     *
     * @return \HomeBundle\Entity\Price
     */
    public function getSelectedproductPrice()
    {
        return $this->selectedproductPrice;
    }

    /**
     * Set sale
     *
     * @param \HomeBundle\Entity\Sale $sale
     *
     * @return Selectedproduct
     */
    public function setSale(\HomeBundle\Entity\Sale $sale = null)
    {
        $this->sale = $sale;

        return $this;
    }

    /**
     * Get sale
     *
     * @return \HomeBundle\Entity\Sale
     */
    public function getSale()
    {
        return $this->sale;
    }
}
