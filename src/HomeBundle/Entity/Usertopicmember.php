<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usertopicmember
 *
 * @ORM\Table(name="userTopicmember", indexes={@ORM\Index(name="user_id", columns={"user_id"}), @ORM\Index(name="topicMember_id", columns={"topicMember_id"})})
 * @ORM\Entity
 */
class Usertopicmember
{
    /**
     * @var integer
     *
     * @ORM\Column(name="userTopicmember_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $usertopicmemberId;

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
     * @var \Topicmember
     *
     * @ORM\ManyToOne(targetEntity="Topicmember")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="topicMember_id", referencedColumnName="topicMember_id")
     * })
     */
    private $topicmember;



    /**
     * Get usertopicmemberId
     *
     * @return integer
     */
    public function getUsertopicmemberId()
    {
        return $this->usertopicmemberId;
    }

    /**
     * Set user
     *
     * @param \HomeBundle\Entity\User $user
     *
     * @return Usertopicmember
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
     * Set topicmember
     *
     * @param \HomeBundle\Entity\Topicmember $topicmember
     *
     * @return Usertopicmember
     */
    public function setTopicmember(\HomeBundle\Entity\Topicmember $topicmember = null)
    {
        $this->topicmember = $topicmember;

        return $this;
    }

    /**
     * Get topicmember
     *
     * @return \HomeBundle\Entity\Topicmember
     */
    public function getTopicmember()
    {
        return $this->topicmember;
    }
}
