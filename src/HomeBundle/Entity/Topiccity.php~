<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Topiccity
 *
 * @ORM\Table(name="topicCity", indexes={@ORM\Index(name="topic_id", columns={"topic_id"}), @ORM\Index(name="city_id", columns={"city_id"})})
 * @ORM\Entity
 */
class Topiccity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="topicCity_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $topiccityId;

    /**
     * @var integer
     *
     * @ORM\Column(name="topicCity_score", type="integer", nullable=false)
     */
    private $topiccityScore;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="topicCity_lastUpdate", type="datetime", nullable=false)
     */
    private $topiccityLastupdate;

    /**
     * @var integer
     *
     * @ORM\Column(name="topicCity_scoreTendency", type="integer", nullable=false)
     */
    private $topiccityScoretendency;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="topicCity_dateTendency", type="datetime", nullable=false)
     */
    private $topiccityDatetendency;

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
     * @var \City
     *
     * @ORM\ManyToOne(targetEntity="City")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="city_id", referencedColumnName="city_id")
     * })
     */
    private $city;



    /**
     * Get topiccityId
     *
     * @return integer
     */
    public function getTopiccityId()
    {
        return $this->topiccityId;
    }

    /**
     * Set topiccityScore
     *
     * @param integer $topiccityScore
     *
     * @return Topiccity
     */
    public function setTopiccityScore($topiccityScore)
    {
        $this->topiccityScore = $topiccityScore;

        return $this;
    }

    /**
     * Get topiccityScore
     *
     * @return integer
     */
    public function getTopiccityScore()
    {
        return $this->topiccityScore;
    }

    /**
     * Set topiccityLastupdate
     *
     * @param \DateTime $topiccityLastupdate
     *
     * @return Topiccity
     */
    public function setTopiccityLastupdate($topiccityLastupdate)
    {
        $this->topiccityLastupdate = $topiccityLastupdate;

        return $this;
    }

    /**
     * Get topiccityLastupdate
     *
     * @return \DateTime
     */
    public function getTopiccityLastupdate()
    {
        return $this->topiccityLastupdate;
    }

    /**
     * Set topiccityScoretendency
     *
     * @param integer $topiccityScoretendency
     *
     * @return Topiccity
     */
    public function setTopiccityScoretendency($topiccityScoretendency)
    {
        $this->topiccityScoretendency = $topiccityScoretendency;

        return $this;
    }

    /**
     * Get topiccityScoretendency
     *
     * @return integer
     */
    public function getTopiccityScoretendency()
    {
        return $this->topiccityScoretendency;
    }

    /**
     * Set topiccityDatetendency
     *
     * @param \DateTime $topiccityDatetendency
     *
     * @return Topiccity
     */
    public function setTopiccityDatetendency($topiccityDatetendency)
    {
        $this->topiccityDatetendency = $topiccityDatetendency;

        return $this;
    }

    /**
     * Get topiccityDatetendency
     *
     * @return \DateTime
     */
    public function getTopiccityDatetendency()
    {
        return $this->topiccityDatetendency;
    }

    /**
     * Set topic
     *
     * @param \HomeBundle\Entity\Topic $topic
     *
     * @return Topiccity
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
     * Set city
     *
     * @param \HomeBundle\Entity\City $city
     *
     * @return Topiccity
     */
    public function setCity(\HomeBundle\Entity\City $city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return \HomeBundle\Entity\City
     */
    public function getCity()
    {
        return $this->city;
    }
}
