<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reachuser
 *
 * @ORM\Table(name="reachUser", indexes={@ORM\Index(name="reach_id", columns={"reach_id"}), @ORM\Index(name="user_id", columns={"user_id"})})
 * @ORM\Entity
 */
class Reachuser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="reachUser_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $reachuserId;

    /**
     * @var \Reach
     *
     * @ORM\ManyToOne(targetEntity="Reach")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="reach_id", referencedColumnName="reach_id")
     * })
     */
    private $reach;

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
     * Get reachuserId
     *
     * @return integer
     */
    public function getReachuserId()
    {
        return $this->reachuserId;
    }

    /**
     * Set reach
     *
     * @param \HomeBundle\Entity\Reach $reach
     *
     * @return Reachuser
     */
    public function setReach(\HomeBundle\Entity\Reach $reach = null)
    {
        $this->reach = $reach;

        return $this;
    }

    /**
     * Get reach
     *
     * @return \HomeBundle\Entity\Reach
     */
    public function getReach()
    {
        return $this->reach;
    }

    /**
     * Set user
     *
     * @param \HomeBundle\Entity\User $user
     *
     * @return Reachuser
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
}
