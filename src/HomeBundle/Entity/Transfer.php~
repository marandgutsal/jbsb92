<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Transfer
 *
 * @ORM\Table(name="transfer", indexes={@ORM\Index(name="userType_id", columns={"commercial_id"}), @ORM\Index(name="user_id", columns={"user_id"}), @ORM\Index(name="trajectory_id", columns={"trajectory_id"})})
 * @ORM\Entity
 */
class Transfer
{
    /**
     * @var integer
     *
     * @ORM\Column(name="transfer_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $transferId;

    /**
     * @var integer
     *
     * @ORM\Column(name="transfer_amount", type="integer", nullable=false)
     */
    private $transferAmount;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="transfer_date", type="datetime", nullable=false)
     */
    private $transferDate;

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
     * Get transferId
     *
     * @return integer
     */
    public function getTransferId()
    {
        return $this->transferId;
    }

    /**
     * Set transferAmount
     *
     * @param integer $transferAmount
     *
     * @return Transfer
     */
    public function setTransferAmount($transferAmount)
    {
        $this->transferAmount = $transferAmount;

        return $this;
    }

    /**
     * Get transferAmount
     *
     * @return integer
     */
    public function getTransferAmount()
    {
        return $this->transferAmount;
    }

    /**
     * Set transferDate
     *
     * @param \DateTime $transferDate
     *
     * @return Transfer
     */
    public function setTransferDate($transferDate)
    {
        $this->transferDate = $transferDate;

        return $this;
    }

    /**
     * Get transferDate
     *
     * @return \DateTime
     */
    public function getTransferDate()
    {
        return $this->transferDate;
    }

    /**
     * Set user
     *
     * @param \HomeBundle\Entity\User $user
     *
     * @return Transfer
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
     * Set trajectory
     *
     * @param \HomeBundle\Entity\Trajectory $trajectory
     *
     * @return Transfer
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
     * @return Transfer
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
}
