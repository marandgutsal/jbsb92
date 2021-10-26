<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Shippinguser
 *
 * @ORM\Table(name="shippingUser", uniqueConstraints={@ORM\UniqueConstraint(name="shipping_id", columns={"trajectory_id", "user_id"})}, indexes={@ORM\Index(name="user_id", columns={"user_id"}), @ORM\Index(name="IDX_B830F5C34FE7F825", columns={"trajectory_id"})})
 * @ORM\Entity
 */
class Shippinguser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="shippingUser_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $shippinguserId;

    /**
     * @var \Trajectory2
     *
     * @ORM\ManyToOne(targetEntity="Trajectory2")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="trajectory_id", referencedColumnName="trajectory2_id")
     * })
     */
    private $trajectory;

    /**
     * @var \Branch
     *
     * @ORM\ManyToOne(targetEntity="Branch")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="branch_id")
     * })
     */
    private $user;



    /**
     * Get shippinguserId
     *
     * @return integer
     */
    public function getShippinguserId()
    {
        return $this->shippinguserId;
    }

    /**
     * Set trajectory
     *
     * @param \HomeBundle\Entity\Trajectory2 $trajectory
     *
     * @return Shippinguser
     */
    public function setTrajectory(\HomeBundle\Entity\Trajectory2 $trajectory = null)
    {
        $this->trajectory = $trajectory;

        return $this;
    }

    /**
     * Get trajectory
     *
     * @return \HomeBundle\Entity\Trajectory2
     */
    public function getTrajectory()
    {
        return $this->trajectory;
    }

    /**
     * Set user
     *
     * @param \HomeBundle\Entity\Branch $user
     *
     * @return Shippinguser
     */
    public function setUser(\HomeBundle\Entity\Branch $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \HomeBundle\Entity\Branch
     */
    public function getUser()
    {
        return $this->user;
    }
}
