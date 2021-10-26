<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Branch
 *
 * @ORM\Table(name="branch", indexes={@ORM\Index(name="city_id", columns={"location_id"}), @ORM\Index(name="commercial_id", columns={"commercial_id"}), @ORM\Index(name="branch_capacity", columns={"branch_capacity"})})
 * @ORM\Entity
 */
class Branch
{
    /**
     * @var integer
     *
     * @ORM\Column(name="branch_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $branchId;

    /**
     * @var string
     *
     * @ORM\Column(name="branch_name", type="string", length=255, nullable=false)
     */
    private $branchName;

    /**
     * @var integer
     *
     * @ORM\Column(name="branch_telephone", type="integer", nullable=false)
     */
    private $branchTelephone;

    /**
     * @var integer
     *
     * @ORM\Column(name="branch_cellphone", type="integer", nullable=false)
     */
    private $branchCellphone;

    /**
     * @var string
     *
     * @ORM\Column(name="branch_aditional_information", type="text", length=65535, nullable=false)
     */
    private $branchAditionalInformation;

    /**
     * @var \Commercial
     *
     * @ORM\ManyToOne(targetEntity="Commercial")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="commercial_id", referencedColumnName="commercial_id")
     * })
     */
    private $commercial;

    /**
     * @var \Location
     *
     * @ORM\ManyToOne(targetEntity="Location")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="location_id", referencedColumnName="location_id")
     * })
     */
    private $location;

    /**
     * @var \Maximumload
     *
     * @ORM\ManyToOne(targetEntity="Maximumload")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="branch_capacity", referencedColumnName="maximumLoad_id")
     * })
     */
    private $branchCapacity;



    /**
     * Get branchId
     *
     * @return integer
     */
    public function getBranchId()
    {
        return $this->branchId;
    }

    /**
     * Set branchName
     *
     * @param string $branchName
     *
     * @return Branch
     */
    public function setBranchName($branchName)
    {
        $this->branchName = $branchName;

        return $this;
    }

    /**
     * Get branchName
     *
     * @return string
     */
    public function getBranchName()
    {
        return $this->branchName;
    }

    /**
     * Set branchTelephone
     *
     * @param integer $branchTelephone
     *
     * @return Branch
     */
    public function setBranchTelephone($branchTelephone)
    {
        $this->branchTelephone = $branchTelephone;

        return $this;
    }

    /**
     * Get branchTelephone
     *
     * @return integer
     */
    public function getBranchTelephone()
    {
        return $this->branchTelephone;
    }

    /**
     * Set branchCellphone
     *
     * @param integer $branchCellphone
     *
     * @return Branch
     */
    public function setBranchCellphone($branchCellphone)
    {
        $this->branchCellphone = $branchCellphone;

        return $this;
    }

    /**
     * Get branchCellphone
     *
     * @return integer
     */
    public function getBranchCellphone()
    {
        return $this->branchCellphone;
    }

    /**
     * Set branchAditionalInformation
     *
     * @param string $branchAditionalInformation
     *
     * @return Branch
     */
    public function setBranchAditionalInformation($branchAditionalInformation)
    {
        $this->branchAditionalInformation = $branchAditionalInformation;

        return $this;
    }

    /**
     * Get branchAditionalInformation
     *
     * @return string
     */
    public function getBranchAditionalInformation()
    {
        return $this->branchAditionalInformation;
    }

    /**
     * Set commercial
     *
     * @param \HomeBundle\Entity\Commercial $commercial
     *
     * @return Branch
     */
    public function setCommercial(\HomeBundle\Entity\Commercial $commercial = null)
    {
        $this->commercial = $commercial;

        return $this;
    }

    /**
     * Get commercial
     *
     * @return \HomeBundle\Entity\Commercial
     */
    public function getCommercial()
    {
        return $this->commercial;
    }

    /**
     * Set location
     *
     * @param \HomeBundle\Entity\Location $location
     *
     * @return Branch
     */
    public function setLocation(\HomeBundle\Entity\Location $location = null)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return \HomeBundle\Entity\Location
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set branchCapacity
     *
     * @param \HomeBundle\Entity\Maximumload $branchCapacity
     *
     * @return Branch
     */
    public function setBranchCapacity(\HomeBundle\Entity\Maximumload $branchCapacity = null)
    {
        $this->branchCapacity = $branchCapacity;

        return $this;
    }

    /**
     * Get branchCapacity
     *
     * @return \HomeBundle\Entity\Maximumload
     */
    public function getBranchCapacity()
    {
        return $this->branchCapacity;
    }
}
