<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Saledetail
 *
 * @ORM\Table(name="saleDetail", indexes={@ORM\Index(name="sale_id", columns={"sale_id"}), @ORM\Index(name="store_id", columns={"store_id"}), @ORM\Index(name="selectedProduct_id", columns={"selectedProduct_id"})})
 * @ORM\Entity
 */
class Saledetail
{
    /**
     * @var integer
     *
     * @ORM\Column(name="saleDetail_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $saledetailId;

    /**
     * @var integer
     *
     * @ORM\Column(name="saleDetail_amount", type="integer", nullable=false)
     */
    private $saledetailAmount;

    /**
     * @var integer
     *
     * @ORM\Column(name="saleDetail_remaining", type="integer", nullable=false)
     */
    private $saledetailRemaining;

    /**
     * @var \Branch
     *
     * @ORM\ManyToOne(targetEntity="Branch")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="store_id", referencedColumnName="branch_id")
     * })
     */
    private $store;

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
     * @var \Selectedproduct
     *
     * @ORM\ManyToOne(targetEntity="Selectedproduct")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="selectedProduct_id", referencedColumnName="selectedProduct_id")
     * })
     */
    private $selectedproduct;



    /**
     * Get saledetailId
     *
     * @return integer
     */
    public function getSaledetailId()
    {
        return $this->saledetailId;
    }

    /**
     * Set saledetailAmount
     *
     * @param integer $saledetailAmount
     *
     * @return Saledetail
     */
    public function setSaledetailAmount($saledetailAmount)
    {
        $this->saledetailAmount = $saledetailAmount;

        return $this;
    }

    /**
     * Get saledetailAmount
     *
     * @return integer
     */
    public function getSaledetailAmount()
    {
        return $this->saledetailAmount;
    }

    /**
     * Set saledetailRemaining
     *
     * @param integer $saledetailRemaining
     *
     * @return Saledetail
     */
    public function setSaledetailRemaining($saledetailRemaining)
    {
        $this->saledetailRemaining = $saledetailRemaining;

        return $this;
    }

    /**
     * Get saledetailRemaining
     *
     * @return integer
     */
    public function getSaledetailRemaining()
    {
        return $this->saledetailRemaining;
    }

    /**
     * Set store
     *
     * @param \HomeBundle\Entity\Branch $store
     *
     * @return Saledetail
     */
    public function setStore(\HomeBundle\Entity\Branch $store = null)
    {
        $this->store = $store;

        return $this;
    }

    /**
     * Get store
     *
     * @return \HomeBundle\Entity\Branch
     */
    public function getStore()
    {
        return $this->store;
    }

    /**
     * Set sale
     *
     * @param \HomeBundle\Entity\Sale $sale
     *
     * @return Saledetail
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

    /**
     * Set selectedproduct
     *
     * @param \HomeBundle\Entity\Selectedproduct $selectedproduct
     *
     * @return Saledetail
     */
    public function setSelectedproduct(\HomeBundle\Entity\Selectedproduct $selectedproduct = null)
    {
        $this->selectedproduct = $selectedproduct;

        return $this;
    }

    /**
     * Get selectedproduct
     *
     * @return \HomeBundle\Entity\Selectedproduct
     */
    public function getSelectedproduct()
    {
        return $this->selectedproduct;
    }
}
