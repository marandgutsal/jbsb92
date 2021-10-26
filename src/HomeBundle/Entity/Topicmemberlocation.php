<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Topicmemberlocation
 *
 * @ORM\Table(name="topicMemberLocation", indexes={@ORM\Index(name="topic_id", columns={"topicMember_id"}), @ORM\Index(name="location_id", columns={"location_id"})})
 * @ORM\Entity
 */
class Topicmemberlocation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="topicMemberLocation_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $topicmemberlocationId;

    /**
     * @var integer
     *
     * @ORM\Column(name="topicMemberLocation_score", type="integer", nullable=false)
     */
    private $topicmemberlocationScore;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="topicMemberLocation_lastUpdate", type="datetime", nullable=false)
     */
    private $topicmemberlocationLastupdate;

    /**
     * @var integer
     *
     * @ORM\Column(name="topicMemberLocation_scoreTendency", type="integer", nullable=false)
     */
    private $topicmemberlocationScoretendency;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="topicMemberLocation_dateTendency", type="datetime", nullable=false)
     */
    private $topicmemberlocationDatetendency;

    /**
     * @var \Location
     *
     * @ORM\ManyToOne(targetEntity="Location")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="location_id", referencedColumnName="location_id")
     * })
     */
    private $location;

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
     * Get topicmemberlocationId
     *
     * @return integer
     */
    public function getTopicmemberlocationId()
    {
        return $this->topicmemberlocationId;
    }

    /**
     * Set topicmemberlocationScore
     *
     * @param integer $topicmemberlocationScore
     *
     * @return Topicmemberlocation
     */
    public function setTopicmemberlocationScore($topicmemberlocationScore)
    {
        $this->topicmemberlocationScore = $topicmemberlocationScore;

        return $this;
    }

    /**
     * Get topicmemberlocationScore
     *
     * @return integer
     */
    public function getTopicmemberlocationScore()
    {
        return $this->topicmemberlocationScore;
    }

    /**
     * Set topicmemberlocationLastupdate
     *
     * @param \DateTime $topicmemberlocationLastupdate
     *
     * @return Topicmemberlocation
     */
    public function setTopicmemberlocationLastupdate($topicmemberlocationLastupdate)
    {
        $this->topicmemberlocationLastupdate = $topicmemberlocationLastupdate;

        return $this;
    }

    /**
     * Get topicmemberlocationLastupdate
     *
     * @return \DateTime
     */
    public function getTopicmemberlocationLastupdate()
    {
        return $this->topicmemberlocationLastupdate;
    }

    /**
     * Set topicmemberlocationScoretendency
     *
     * @param integer $topicmemberlocationScoretendency
     *
     * @return Topicmemberlocation
     */
    public function setTopicmemberlocationScoretendency($topicmemberlocationScoretendency)
    {
        $this->topicmemberlocationScoretendency = $topicmemberlocationScoretendency;

        return $this;
    }

    /**
     * Get topicmemberlocationScoretendency
     *
     * @return integer
     */
    public function getTopicmemberlocationScoretendency()
    {
        return $this->topicmemberlocationScoretendency;
    }

    /**
     * Set topicmemberlocationDatetendency
     *
     * @param \DateTime $topicmemberlocationDatetendency
     *
     * @return Topicmemberlocation
     */
    public function setTopicmemberlocationDatetendency($topicmemberlocationDatetendency)
    {
        $this->topicmemberlocationDatetendency = $topicmemberlocationDatetendency;

        return $this;
    }

    /**
     * Get topicmemberlocationDatetendency
     *
     * @return \DateTime
     */
    public function getTopicmemberlocationDatetendency()
    {
        return $this->topicmemberlocationDatetendency;
    }

    /**
     * Set location
     *
     * @param \HomeBundle\Entity\Location $location
     *
     * @return Topicmemberlocation
     */
    public function setLocation(\HomeBundle\Entity\Location $location = null)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return \HomeBundle\Entity\Location
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set topicmember
     *
     * @param \HomeBundle\Entity\Topicmember $topicmember
     *
     * @return Topicmemberlocation
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
