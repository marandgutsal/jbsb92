<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Indicator
 *
 * @ORM\Table(name="indicator", indexes={@ORM\Index(name="packageMessenger_id", columns={"packageMessenger_id"})})
 * @ORM\Entity
 */
class Indicator
{
    /**
     * @var integer
     *
     * @ORM\Column(name="indicator_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $indicatorId;

    /**
     * @var integer
     *
     * @ORM\Column(name="indicator_maxAmount", type="integer", nullable=false)
     */
    private $indicatorMaxamount;

    /**
     * @var integer
     *
     * @ORM\Column(name="indicator_currentAmount", type="integer", nullable=false)
     */
    private $indicatorCurrentamount;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="indicator_dateAdded", type="datetime", nullable=false)
     */
    private $indicatorDateadded;

    /**
     * @var integer
     *
     * @ORM\Column(name="indicator_unitPrice", type="integer", nullable=false)
     */
    private $indicatorUnitprice;

    /**
     * @var integer
     *
     * @ORM\Column(name="productType_id", type="integer", nullable=false)
     */
    private $producttypeId;

    /**
     * @var \Packagemessenger
     *
     * @ORM\ManyToOne(targetEntity="Packagemessenger")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="packageMessenger_id", referencedColumnName="reach_id")
     * })
     */
    private $packagemessenger;



    /**
     * Get indicatorId
     *
     * @return integer
     */
    public function getIndicatorId()
    {
        return $this->indicatorId;
    }

    /**
     * Set indicatorMaxamount
     *
     * @param integer $indicatorMaxamount
     *
     * @return Indicator
     */
    public function setIndicatorMaxamount($indicatorMaxamount)
    {
        $this->indicatorMaxamount = $indicatorMaxamount;

        return $this;
    }

    /**
     * Get indicatorMaxamount
     *
     * @return integer
     */
    public function getIndicatorMaxamount()
    {
        return $this->indicatorMaxamount;
    }

    /**
     * Set indicatorCurrentamount
     *
     * @param integer $indicatorCurrentamount
     *
     * @return Indicator
     */
    public function setIndicatorCurrentamount($indicatorCurrentamount)
    {
        $this->indicatorCurrentamount = $indicatorCurrentamount;

        return $this;
    }

    /**
     * Get indicatorCurrentamount
     *
     * @return integer
     */
    public function getIndicatorCurrentamount()
    {
        return $this->indicatorCurrentamount;
    }

    /**
     * Set indicatorDateadded
     *
     * @param \DateTime $indicatorDateadded
     *
     * @return Indicator
     */
    public function setIndicatorDateadded($indicatorDateadded)
    {
        $this->indicatorDateadded = $indicatorDateadded;

        return $this;
    }

    /**
     * Get indicatorDateadded
     *
     * @return \DateTime
     */
    public function getIndicatorDateadded()
    {
        return $this->indicatorDateadded;
    }

    /**
     * Set indicatorUnitprice
     *
     * @param integer $indicatorUnitprice
     *
     * @return Indicator
     */
    public function setIndicatorUnitprice($indicatorUnitprice)
    {
        $this->indicatorUnitprice = $indicatorUnitprice;

        return $this;
    }

    /**
     * Get indicatorUnitprice
     *
     * @return integer
     */
    public function getIndicatorUnitprice()
    {
        return $this->indicatorUnitprice;
    }

    /**
     * Set producttypeId
     *
     * @param integer $producttypeId
     *
     * @return Indicator
     */
    public function setProducttypeId($producttypeId)
    {
        $this->producttypeId = $producttypeId;

        return $this;
    }

    /**
     * Get producttypeId
     *
     * @return integer
     */
    public function getProducttypeId()
    {
        return $this->producttypeId;
    }

    /**
     * Set packagemessenger
     *
     * @param \HomeBundle\Entity\Packagemessenger $packagemessenger
     *
     * @return Indicator
     */
    public function setPackagemessenger(\HomeBundle\Entity\Packagemessenger $packagemessenger = null)
    {
        $this->packagemessenger = $packagemessenger;

        return $this;
    }

    /**
     * Get packagemessenger
     *
     * @return \HomeBundle\Entity\Packagemessenger
     */
    public function getPackagemessenger()
    {
        return $this->packagemessenger;
    }
}
