<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Topiccountry
 *
 * @ORM\Table(name="topicCountry", indexes={@ORM\Index(name="topic_id", columns={"topic_id"}), @ORM\Index(name="country_id", columns={"country_id"})})
 * @ORM\Entity
 */
class Topiccountry
{
    /**
     * @var integer
     *
     * @ORM\Column(name="topicCountry_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $topiccountryId;

    /**
     * @var integer
     *
     * @ORM\Column(name="topic_id", type="integer", nullable=false)
     */
    private $topicId;

    /**
     * @var integer
     *
     * @ORM\Column(name="country_id", type="integer", nullable=false)
     */
    private $countryId;

    /**
     * @var integer
     *
     * @ORM\Column(name="topicCountry_score", type="integer", nullable=false)
     */
    private $topiccountryScore;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="topicCountry_lastUpdate", type="datetime", nullable=false)
     */
    private $topiccountryLastupdate;

    /**
     * @var integer
     *
     * @ORM\Column(name="topicCountry_scoreTendency", type="integer", nullable=false)
     */
    private $topiccountryScoretendency;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="topicCountry_dateTendency", type="datetime", nullable=false)
     */
    private $topiccountryDatetendency;



    /**
     * Get topiccountryId
     *
     * @return integer
     */
    public function getTopiccountryId()
    {
        return $this->topiccountryId;
    }

    /**
     * Set topicId
     *
     * @param integer $topicId
     *
     * @return Topiccountry
     */
    public function setTopicId($topicId)
    {
        $this->topicId = $topicId;

        return $this;
    }

    /**
     * Get topicId
     *
     * @return integer
     */
    public function getTopicId()
    {
        return $this->topicId;
    }

    /**
     * Set countryId
     *
     * @param integer $countryId
     *
     * @return Topiccountry
     */
    public function setCountryId($countryId)
    {
        $this->countryId = $countryId;

        return $this;
    }

    /**
     * Get countryId
     *
     * @return integer
     */
    public function getCountryId()
    {
        return $this->countryId;
    }

    /**
     * Set topiccountryScore
     *
     * @param integer $topiccountryScore
     *
     * @return Topiccountry
     */
    public function setTopiccountryScore($topiccountryScore)
    {
        $this->topiccountryScore = $topiccountryScore;

        return $this;
    }

    /**
     * Get topiccountryScore
     *
     * @return integer
     */
    public function getTopiccountryScore()
    {
        return $this->topiccountryScore;
    }

    /**
     * Set topiccountryLastupdate
     *
     * @param \DateTime $topiccountryLastupdate
     *
     * @return Topiccountry
     */
    public function setTopiccountryLastupdate($topiccountryLastupdate)
    {
        $this->topiccountryLastupdate = $topiccountryLastupdate;

        return $this;
    }

    /**
     * Get topiccountryLastupdate
     *
     * @return \DateTime
     */
    public function getTopiccountryLastupdate()
    {
        return $this->topiccountryLastupdate;
    }

    /**
     * Set topiccountryScoretendency
     *
     * @param integer $topiccountryScoretendency
     *
     * @return Topiccountry
     */
    public function setTopiccountryScoretendency($topiccountryScoretendency)
    {
        $this->topiccountryScoretendency = $topiccountryScoretendency;

        return $this;
    }

    /**
     * Get topiccountryScoretendency
     *
     * @return integer
     */
    public function getTopiccountryScoretendency()
    {
        return $this->topiccountryScoretendency;
    }

    /**
     * Set topiccountryDatetendency
     *
     * @param \DateTime $topiccountryDatetendency
     *
     * @return Topiccountry
     */
    public function setTopiccountryDatetendency($topiccountryDatetendency)
    {
        $this->topiccountryDatetendency = $topiccountryDatetendency;

        return $this;
    }

    /**
     * Get topiccountryDatetendency
     *
     * @return \DateTime
     */
    public function getTopiccountryDatetendency()
    {
        return $this->topiccountryDatetendency;
    }
}
