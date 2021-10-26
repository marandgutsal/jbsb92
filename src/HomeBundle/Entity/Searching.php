<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Searching
 *
 * @ORM\Table(name="searching", indexes={@ORM\Index(name="user_id", columns={"user_id"}), @ORM\Index(name="object_id", columns={"topic_id"})})
 * @ORM\Entity
 */
class Searching
{
    /**
     * @var integer
     *
     * @ORM\Column(name="searching_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $searchingId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="searching_date", type="datetime", nullable=false)
     */
    private $searchingDate;

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
     * @var \Topic
     *
     * @ORM\ManyToOne(targetEntity="Topic")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="topic_id", referencedColumnName="topic_id")
     * })
     */
    private $topic;



    /**
     * Get searchingId
     *
     * @return integer
     */
    public function getSearchingId()
    {
        return $this->searchingId;
    }

    /**
     * Set searchingDate
     *
     * @param \DateTime $searchingDate
     *
     * @return Searching
     */
    public function setSearchingDate($searchingDate)
    {
        $this->searchingDate = $searchingDate;

        return $this;
    }

    /**
     * Get searchingDate
     *
     * @return \DateTime
     */
    public function getSearchingDate()
    {
        return $this->searchingDate;
    }

    /**
     * Set user
     *
     * @param \HomeBundle\Entity\User $user
     *
     * @return Searching
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
     * Set topic
     *
     * @param \HomeBundle\Entity\Topic $topic
     *
     * @return Searching
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
}
