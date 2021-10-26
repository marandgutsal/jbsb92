<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Topicdepartment
 *
 * @ORM\Table(name="topicDepartment", indexes={@ORM\Index(name="topic_id", columns={"topic_id"}), @ORM\Index(name="department_id", columns={"department_id"})})
 * @ORM\Entity
 */
class Topicdepartment
{
    /**
     * @var integer
     *
     * @ORM\Column(name="topicDepartment_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $topicdepartmentId;

    /**
     * @var integer
     *
     * @ORM\Column(name="topicDepartment_score", type="integer", nullable=false)
     */
    private $topicdepartmentScore;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="topicDepartment_lastUpdate", type="datetime", nullable=false)
     */
    private $topicdepartmentLastupdate;

    /**
     * @var integer
     *
     * @ORM\Column(name="topicDepartment_scoreTendency", type="integer", nullable=false)
     */
    private $topicdepartmentScoretendency;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="topicDepartment_dateTendency", type="datetime", nullable=false)
     */
    private $topicdepartmentDatetendency;

    /**
     * @var \Topic
     *
     * @ORM\ManyToOne(targetEntity="Topic")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="topic_id", referencedColumnName="topic_id")
     * })
     */
    private $topic;

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
     * Get topicdepartmentId
     *
     * @return integer
     */
    public function getTopicdepartmentId()
    {
        return $this->topicdepartmentId;
    }

    /**
     * Set topicdepartmentScore
     *
     * @param integer $topicdepartmentScore
     *
     * @return Topicdepartment
     */
    public function setTopicdepartmentScore($topicdepartmentScore)
    {
        $this->topicdepartmentScore = $topicdepartmentScore;

        return $this;
    }

    /**
     * Get topicdepartmentScore
     *
     * @return integer
     */
    public function getTopicdepartmentScore()
    {
        return $this->topicdepartmentScore;
    }

    /**
     * Set topicdepartmentLastupdate
     *
     * @param \DateTime $topicdepartmentLastupdate
     *
     * @return Topicdepartment
     */
    public function setTopicdepartmentLastupdate($topicdepartmentLastupdate)
    {
        $this->topicdepartmentLastupdate = $topicdepartmentLastupdate;

        return $this;
    }

    /**
     * Get topicdepartmentLastupdate
     *
     * @return \DateTime
     */
    public function getTopicdepartmentLastupdate()
    {
        return $this->topicdepartmentLastupdate;
    }

    /**
     * Set topicdepartmentScoretendency
     *
     * @param integer $topicdepartmentScoretendency
     *
     * @return Topicdepartment
     */
    public function setTopicdepartmentScoretendency($topicdepartmentScoretendency)
    {
        $this->topicdepartmentScoretendency = $topicdepartmentScoretendency;

        return $this;
    }

    /**
     * Get topicdepartmentScoretendency
     *
     * @return integer
     */
    public function getTopicdepartmentScoretendency()
    {
        return $this->topicdepartmentScoretendency;
    }

    /**
     * Set topicdepartmentDatetendency
     *
     * @param \DateTime $topicdepartmentDatetendency
     *
     * @return Topicdepartment
     */
    public function setTopicdepartmentDatetendency($topicdepartmentDatetendency)
    {
        $this->topicdepartmentDatetendency = $topicdepartmentDatetendency;

        return $this;
    }

    /**
     * Get topicdepartmentDatetendency
     *
     * @return \DateTime
     */
    public function getTopicdepartmentDatetendency()
    {
        return $this->topicdepartmentDatetendency;
    }

    /**
     * Set topic
     *
     * @param \HomeBundle\Entity\Topic $topic
     *
     * @return Topicdepartment
     */
    public function setTopic(\HomeBundle\Entity\Topic $topic = null)
    {
        $this->topic = $topic;

        return $this;
    }

    /**
     * Get topic
     *
     * @return \HomeBundle\Entity\Topic
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * Set department
     *
     * @param \HomeBundle\Entity\Department $department
     *
     * @return Topicdepartment
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
