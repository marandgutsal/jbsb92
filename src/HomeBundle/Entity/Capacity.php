<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Capacity
 *
 * @ORM\Table(name="capacity", uniqueConstraints={@ORM\UniqueConstraint(name="equivalence_id_3", columns={"productType_id", "capacity_amount"})}, indexes={@ORM\Index(name="productType_id", columns={"productType_id"})})
 * @ORM\Entity
 */
class Capacity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="capacity_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $capacityId;

    /**
     * @var integer
     *
     * @ORM\Column(name="capacity_amount", type="integer", nullable=false)
     */
    private $capacityAmount;

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
     * Get capacityId
     *
     * @return integer
     */
    public function getCapacityId()
    {
        return $this->capacityId;
    }

    /**
     * Set capacityAmount
     *
     * @param integer $capacityAmount
     *
     * @return Capacity
     */
    public function setCapacityAmount($capacityAmount)
    {
        $this->capacityAmount = $capacityAmount;

        return $this;
    }

    /**
     * Get capacityAmount
     *
     * @return integer
     */
    public function getCapacityAmount()
    {
        return $this->capacityAmount;
    }

    /**
     * Set producttype
     *
     * @param \HomeBundle\Entity\Producttype $producttype
     *
     * @return Capacity
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
