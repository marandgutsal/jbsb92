<?php

namespace HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Topicartist
 *
 * @ORM\Table(name="topicArtist", indexes={@ORM\Index(name="topic_id", columns={"topic_id"}), @ORM\Index(name="artist_id", columns={"artist_id"})})
 * @ORM\Entity
 */
class Topicartist
{
    /**
     * @var integer
     *
     * @ORM\Column(name="topicArtist_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $topicartistId;

    /**
     * @var integer
     *
     * @ORM\Column(name="topicArtist_sales", type="integer", nullable=false)
     */
    private $topicartistSales;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="topicArtist_salesDate", type="datetime", nullable=false)
     */
    private $topicartistSalesdate;

    /**
     * @var integer
     *
     * @ORM\Column(name="topicArtist_products", type="integer", nullable=false)
     */
    private $topicartistProducts;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="topicArtist_productsDate", type="datetime", nullable=false)
     */
    private $topicartistProductsdate;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="artist_id", referencedColumnName="user_id")
     * })
     */
    private $artist;

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
     * Get topicartistId
     *
     * @return integer
     */
    public function getTopicartistId()
    {
        return $this->topicartistId;
    }

    /**
     * Set topicartistSales
     *
     * @param integer $topicartistSales
     *
     * @return Topicartist
     */
    public function setTopicartistSales($topicartistSales)
    {
        $this->topicartistSales = $topicartistSales;

        return $this;
    }

    /**
     * Get topicartistSales
     *
     * @return integer
     */
    public function getTopicartistSales()
    {
        return $this->topicartistSales;
    }

    /**
     * Set topicartistSalesdate
     *
     * @param \DateTime $topicartistSalesdate
     *
     * @return Topicartist
     */
    public function setTopicartistSalesdate($topicartistSalesdate)
    {
        $this->topicartistSalesdate = $topicartistSalesdate;

        return $this;
    }

    /**
     * Get topicartistSalesdate
     *
     * @return \DateTime
     */
    public function getTopicartistSalesdate()
    {
        return $this->topicartistSalesdate;
    }

    /**
     * Set topicartistProducts
     *
     * @param integer $topicartistProducts
     *
     * @return Topicartist
     */
    public function setTopicartistProducts($topicartistProducts)
    {
        $this->topicartistProducts = $topicartistProducts;

        return $this;
    }

    /**
     * Get topicartistProducts
     *
     * @return integer
     */
    public function getTopicartistProducts()
    {
        return $this->topicartistProducts;
    }

    /**
     * Set topicartistProductsdate
     *
     * @param \DateTime $topicartistProductsdate
     *
     * @return Topicartist
     */
    public function setTopicartistProductsdate($topicartistProductsdate)
    {
        $this->topicartistProductsdate = $topicartistProductsdate;

        return $this;
    }

    /**
     * Get topicartistProductsdate
     *
     * @return \DateTime
     */
    public function getTopicartistProductsdate()
    {
        return $this->topicartistProductsdate;
    }

    /**
     * Set artist
     *
     * @param \HomeBundle\Entity\User $artist
     *
     * @return Topicartist
     */
    public function setArtist(\HomeBundle\Entity\User $artist = null)
    {
        $this->artist = $artist;

        return $this;
    }

    /**
     * Get artist
     *
     * @return \HomeBundle\Entity\User
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * Set topic
     *
     * @param \HomeBundle\Entity\Topic $topic
     *
     * @return Topicartist
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
