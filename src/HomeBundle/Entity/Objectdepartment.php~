<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Objectdepartment
 *
 * @ORM\Table(name="objectDepartment", indexes={@ORM\Index(name="object_id", columns={"object_id"}), @ORM\Index(name="department_id", columns={"department_id"})})
 * @ORM\Entity
 */
class Objectdepartment
{
    /**
     * @var integer
     *
     * @ORM\Column(name="objectDepartment_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $objectdepartmentId;

    /**
     * @var integer
     *
     * @ORM\Column(name="objectDepartment_score", type="integer", nullable=false)
     */
    private $objectdepartmentScore;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="objectDepartment_lastUpdate", type="datetime", nullable=false)
     */
    private $objectdepartmentLastupdate;

    /**
     * @var integer
     *
     * @ORM\Column(name="objectDepartment_scoreTendency", type="integer", nullable=false)
     */
    private $objectdepartmentScoretendency;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="objectDepartment_dateTendency", type="datetime", nullable=false)
     */
    private $objectdepartmentDatetendency;

    /**
     * @var \Object
     *
     * @ORM\ManyToOne(targetEntity="Object")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="object_id", referencedColumnName="object_id")
     * })
     */
    private $object;

    /**
     * @var \Department
     *
     * @ORM\ManyToOne(targetEntity="Department")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="department_id", referencedColumnName="department_id")
     * })
     */
    private $department;



    /**
     * Get objectdepartmentId
     *
     * @return integer
     */
    public function getObjectdepartmentId()
    {
        return $this->objectdepartmentId;
    }

    /**
     * Set objectdepartmentScore
     *
     * @param integer $objectdepartmentScore
     *
     * @return Objectdepartment
     */
    public function setObjectdepartmentScore($objectdepartmentScore)
    {
        $this->objectdepartmentScore = $objectdepartmentScore;

        return $this;
    }

    /**
     * Get objectdepartmentScore
     *
     * @return integer
     */
    public function getObjectdepartmentScore()
    {
        return $this->objectdepartmentScore;
    }

    /**
     * Set objectdepartmentLastupdate
     *
     * @param \DateTime $objectdepartmentLastupdate
     *
     * @return Objectdepartment
     */
    public function setObjectdepartmentLastupdate($objectdepartmentLastupdate)
    {
        $this->objectdepartmentLastupdate = $objectdepartmentLastupdate;

        return $this;
    }

    /**
     * Get objectdepartmentLastupdate
     *
     * @return \DateTime
     */
    public function getObjectdepartmentLastupdate()
    {
        return $this->objectdepartmentLastupdate;
    }

    /**
     * Set objectdepartmentScoretendency
     *
     * @param integer $objectdepartmentScoretendency
     *
     * @return Objectdepartment
     */
    public function setObjectdepartmentScoretendency($objectdepartmentScoretendency)
    {
        $this->objectdepartmentScoretendency = $objectdepartmentScoretendency;

        return $this;
    }

    /**
     * Get objectdepartmentScoretendency
     *
     * @return integer
     */
    public function getObjectdepartmentScoretendency()
    {
        return $this->objectdepartmentScoretendency;
    }

    /**
     * Set objectdepartmentDatetendency
     *
     * @param \DateTime $objectdepartmentDatetendency
     *
     * @return Objectdepartment
     */
    public function setObjectdepartmentDatetendency($objectdepartmentDatetendency)
    {
        $this->objectdepartmentDatetendency = $objectdepartmentDatetendency;

        return $this;
    }

    /**
     * Get objectdepartmentDatetendency
     *
     * @return \DateTime
     */
    public function getObjectdepartmentDatetendency()
    {
        return $this->objectdepartmentDatetendency;
    }

    /**
     * Set object
     *
     * @param \HomeBundle\Entity\Object $object
     *
     * @return Objectdepartment
     */
    public function setObject(\HomeBundle\Entity\Object $object = null)
    {
        $this->object = $object;

        return $this;
    }

    /**
     * Get object
     *
     * @return \HomeBundle\Entity\Object
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * Set department
     *
     * @param \HomeBundle\Entity\Department $department
     *
     * @return Objectdepartment
     */
    public function setDepartment(\HomeBundle\Entity\Department $department = null)
    {
        $this->department = $department;

        return $this;
    }

    /**
     * Get department
     *
     * @return \HomeBundle\Entity\Department
     */
    public function getDepartment()
    {
        return $this->department;
    }
}
