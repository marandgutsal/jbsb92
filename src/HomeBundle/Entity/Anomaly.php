<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Anomaly
 *
 * @ORM\Table(name="anomaly", indexes={@ORM\Index(name="reason_id", columns={"reason_id"}), @ORM\Index(name="solution_id", columns={"solution_id"}), @ORM\Index(name="anomaly_user", columns={"anomaly_user"}), @ORM\Index(name="anomalyOwner_id", columns={"commercial_id"}), @ORM\Index(name="trajectory_id", columns={"trajectory_id"}), @ORM\Index(name="supplying_id", columns={"supplying_id"})})
 * @ORM\Entity
 */
class Anomaly
{
    /**
     * @var integer
     *
     * @ORM\Column(name="anomaly_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $anomalyId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="anomaly_date", type="datetime", nullable=false)
     */
    private $anomalyDate;

    /**
     * @var string
     *
     * @ORM\Column(name="anomaly_description", type="text", length=65535, nullable=false)
     */
    private $anomalyDescription;

    /**
     * @var \Reason
     *
     * @ORM\ManyToOne(targetEntity="Reason")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="reason_id", referencedColumnName="reason_id")
     * })
     */
    private $reason;

    /**
     * @var \Solution
     *
     * @ORM\ManyToOne(targetEntity="Solution")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="solution_id", referencedColumnName="solution_id")
     * })
     */
    private $solution;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="anomaly_user", referencedColumnName="user_id")
     * })
     */
    private $anomalyUser;

    /**
     * @var \Trajectory
     *
     * @ORM\ManyToOne(targetEntity="Trajectory")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="trajectory_id", referencedColumnName="trajectory_id")
     * })
     */
    private $trajectory;

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
     * @var \Supplying
     *
     * @ORM\ManyToOne(targetEntity="Supplying")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="supplying_id", referencedColumnName="supplying_id")
     * })
     */
    private $supplying;



    /**
     * Get anomalyId
     *
     * @return integer
     */
    public function getAnomalyId()
    {
        return $this->anomalyId;
    }

    /**
     * Set anomalyDate
     *
     * @param \DateTime $anomalyDate
     *
     * @return Anomaly
     */
    public function setAnomalyDate($anomalyDate)
    {
        $this->anomalyDate = $anomalyDate;

        return $this;
    }

    /**
     * Get anomalyDate
     *
     * @return \DateTime
     */
    public function getAnomalyDate()
    {
        return $this->anomalyDate;
    }

    /**
     * Set anomalyDescription
     *
     * @param string $anomalyDescription
     *
     * @return Anomaly
     */
    public function setAnomalyDescription($anomalyDescription)
    {
        $this->anomalyDescription = $anomalyDescription;

        return $this;
    }

    /**
     * Get anomalyDescription
     *
     * @return string
     */
    public function getAnomalyDescription()
    {
        return $this->anomalyDescription;
    }

    /**
     * Set reason
     *
     * @param \HomeBundle\Entity\Reason $reason
     *
     * @return Anomaly
     */
    public function setReason(\HomeBundle\Entity\Reason $reason = null)
    {
        $this->reason = $reason;

        return $this;
    }

    /**
     * Get reason
     *
     * @return \HomeBundle\Entity\Reason
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * Set solution
     *
     * @param \HomeBundle\Entity\Solution $solution
     *
     * @return Anomaly
     */
    public function setSolution(\HomeBundle\Entity\Solution $solution = null)
    {
        $this->solution = $solution;

        return $this;
    }

    /**
     * Get solution
     *
     * @return \HomeBundle\Entity\Solution
     */
    public function getSolution()
    {
        return $this->solution;
    }

    /**
     * Set anomalyUser
     *
     * @param \HomeBundle\Entity\User $anomalyUser
     *
     * @return Anomaly
     */
    public function setAnomalyUser(\HomeBundle\Entity\User $anomalyUser = null)
    {
        $this->anomalyUser = $anomalyUser;

        return $this;
    }

    /**
     * Get anomalyUser
     *
     * @return \HomeBundle\Entity\User
     */
    public function getAnomalyUser()
    {
        return $this->anomalyUser;
    }

    /**
     * Set trajectory
     *
     * @param \HomeBundle\Entity\Trajectory $trajectory
     *
     * @return Anomaly
     */
    public function setTrajectory(\HomeBundle\Entity\Trajectory $trajectory = null)
    {
        $this->trajectory = $trajectory;

        return $this;
    }

    /**
     * Get trajectory
     *
     * @return \HomeBundle\Entity\Trajectory
     */
    public function getTrajectory()
    {
        return $this->trajectory;
    }

    /**
     * Set commercial
     *
     * @param \HomeBundle\Entity\Commercial $commercial
     *
     * @return Anomaly
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
     * Set supplying
     *
     * @param \HomeBundle\Entity\Supplying $supplying
     *
     * @return Anomaly
     */
    public function setSupplying(\HomeBundle\Entity\Supplying $supplying = null)
    {
        $this->supplying = $supplying;

        return $this;
    }

    /**
     * Get supplying
     *
     * @return \HomeBundle\Entity\Supplying
     */
    public function getSupplying()
    {
        return $this->supplying;
    }
}
