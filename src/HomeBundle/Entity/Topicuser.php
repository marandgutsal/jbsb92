<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Topicuser
 *
 * @ORM\Table(name="topicUser", indexes={@ORM\Index(name="topic_id", columns={"topic_id"}), @ORM\Index(name="user_id", columns={"user_id"})})
 * @ORM\Entity
 */
class Topicuser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="topicUser_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $topicuserId;

    /**
     * @var integer
     *
     * @ORM\Column(name="topicUser_score", type="integer", nullable=false)
     */
    private $topicuserScore;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="topicUser_lastUpdate", type="datetime", nullable=false)
     */
    private $topicuserLastupdate;

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
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     * })
     */
    private $user;



    /**
     * Get topicuserId
     *
     * @return integer
     */
    public function getTopicuserId()
    {
        return $this->topicuserId;
    }

    /**
     * Set topicuserScore
     *
     * @param integer $topicuserScore
     *
     * @return Topicuser
     */
    public function setTopicuserScore($topicuserScore)
    {
        $this->topicuserScore = $topicuserScore;

        return $this;
    }

    /**
     * Get topicuserScore
     *
     * @return integer
     */
    public function getTopicuserScore()
    {
        return $this->topicuserScore;
    }

    /**
     * Set topicuserLastupdate
     *
     * @param \DateTime $topicuserLastupdate
     *
     * @return Topicuser
     */
    public function setTopicuserLastupdate($topicuserLastupdate)
    {
        $this->topicuserLastupdate = $topicuserLastupdate;

        return $this;
    }

    /**
     * Get topicuserLastupdate
     *
     * @return \DateTime
     */
    public function getTopicuserLastupdate()
    {
        return $this->topicuserLastupdate;
    }

    /**
     * Set topic
     *
     * @param \HomeBundle\Entity\Topic $topic
     *
     * @return Topicuser
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
     * Set user
     *
     * @param \HomeBundle\Entity\User $user
     *
     * @return Topicuser
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
