<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Topicmemberuser
 *
 * @ORM\Table(name="topicMemberUser", indexes={@ORM\Index(name="topic_id", columns={"topicMember_id"}), @ORM\Index(name="user_id", columns={"user_id"})})
 * @ORM\Entity
 */
class Topicmemberuser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="topicMemberUser_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $topicmemberuserId;

    /**
     * @var integer
     *
     * @ORM\Column(name="topicMemberUser_score", type="integer", nullable=false)
     */
    private $topicmemberuserScore;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="topicMemberUser_lastUpdate", type="datetime", nullable=false)
     */
    private $topicmemberuserLastupdate;

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
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     * })
     */
    private $user;



    /**
     * Get topicmemberuserId
     *
     * @return integer
     */
    public function getTopicmemberuserId()
    {
        return $this->topicmemberuserId;
    }

    /**
     * Set topicmemberuserScore
     *
     * @param integer $topicmemberuserScore
     *
     * @return Topicmemberuser
     */
    public function setTopicmemberuserScore($topicmemberuserScore)
    {
        $this->topicmemberuserScore = $topicmemberuserScore;

        return $this;
    }

    /**
     * Get topicmemberuserScore
     *
     * @return integer
     */
    public function getTopicmemberuserScore()
    {
        return $this->topicmemberuserScore;
    }

    /**
     * Set topicmemberuserLastupdate
     *
     * @param \DateTime $topicmemberuserLastupdate
     *
     * @return Topicmemberuser
     */
    public function setTopicmemberuserLastupdate($topicmemberuserLastupdate)
    {
        $this->topicmemberuserLastupdate = $topicmemberuserLastupdate;

        return $this;
    }

    /**
     * Get topicmemberuserLastupdate
     *
     * @return \DateTime
     */
    public function getTopicmemberuserLastupdate()
    {
        return $this->topicmemberuserLastupdate;
    }

    /**
     * Set topicmember
     *
     * @param \HomeBundle\Entity\Topicmember $topicmember
     *
     * @return Topicmemberuser
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

    /**
     * Set user
     *
     * @param \HomeBundle\Entity\User $user
     *
     * @return Topicmemberuser
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
