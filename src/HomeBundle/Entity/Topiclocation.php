<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Topiclocation
 *
 * @ORM\Table(name="topicLocation", indexes={@ORM\Index(name="topic_id", columns={"topic_id"}), @ORM\Index(name="location_id", columns={"location_id"})})
 * @ORM\Entity
 */
class Topiclocation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="topicLocation_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $topiclocationId;

    /**
     * @var integer
     *
     * @ORM\Column(name="topicLocation_score", type="integer", nullable=false)
     */
    private $topiclocationScore;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="topicLocation_lastUpdate", type="datetime", nullable=false)
     */
    private $topiclocationLastupdate;

    /**
     * @var integer
     *
     * @ORM\Column(name="topicLocation_scoreTendency", type="integer", nullable=false)
     */
    private $topiclocationScoretendency;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="topicLocation_dateTendency", type="datetime", nullable=false)
     */
    private $topiclocationDatetendency;

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
     * @var \Topic
     *
     * @ORM\ManyToOne(targetEntity="Topic")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="topic_id", referencedColumnName="topic_id")
     * })
     */
    private $topic;



    /**
     * Get topiclocationId
     *
     * @return integer
     */
    public function getTopiclocationId()
    {
        return $this->topiclocationId;
    }

    /**
     * Set topiclocationScore
     *
     * @param integer $topiclocationScore
     *
     * @return Topiclocation
     */
    public function setTopiclocationScore($topiclocationScore)
    {
        $this->topiclocationScore = $topiclocationScore;

        return $this;
    }

    /**
     * Get topiclocationScore
     *
     * @return integer
     */
    public function getTopiclocationScore()
    {
        return $this->topiclocationScore;
    }

    /**
     * Set topiclocationLastupdate
     *
     * @param \DateTime $topiclocationLastupdate
     *
     * @return Topiclocation
     */
    public function setTopiclocationLastupdate($topiclocationLastupdate)
    {
        $this->topiclocationLastupdate = $topiclocationLastupdate;

        return $this;
    }

    /**
     * Get topiclocationLastupdate
     *
     * @return \DateTime
     */
    public function getTopiclocationLastupdate()
    {
        return $this->topiclocationLastupdate;
    }

    /**
     * Set topiclocationScoretendency
     *
     * @param integer $topiclocationScoretendency
     *
     * @return Topiclocation
     */
    public function setTopiclocationScoretendency($topiclocationScoretendency)
    {
        $this->topiclocationScoretendency = $topiclocationScoretendency;

        return $this;
    }

    /**
     * Get topiclocationScoretendency
     *
     * @return integer
     */
    public function getTopiclocationScoretendency()
    {
        return $this->topiclocationScoretendency;
    }

    /**
     * Set topiclocationDatetendency
     *
     * @param \DateTime $topiclocationDatetendency
     *
     * @return Topiclocation
     */
    public function setTopiclocationDatetendency($topiclocationDatetendency)
    {
        $this->topiclocationDatetendency = $topiclocationDatetendency;

        return $this;
    }

    /**
     * Get topiclocationDatetendency
     *
     * @return \DateTime
     */
    public function getTopiclocationDatetendency()
    {
        return $this->topiclocationDatetendency;
    }

    /**
     * Set location
     *
     * @param \HomeBundle\Entity\Location $location
     *
     * @return Topiclocation
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
     * Set topic
     *
     * @param \HomeBundle\Entity\Topic $topic
     *
     * @return Topiclocation
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
